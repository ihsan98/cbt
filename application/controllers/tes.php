<?php
// START video
    public function video()
    {
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_video'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];

        $data['video'] = $this->db->get_where('video', ['guru' => $this->session->userdata('id')])->result();
        $data['mapel'] = $this->db->get('mapel')->result();
        $data['kelas'] = $this->db->get('kelas')->result();

        $data['guru_kelas'] = $this->db->get_where('guru_kelas', ['guru' => $this->session->userdata('id')])->result();
        $data['guru_mapel'] = $this->db->get_where('guru_mapel', ['guru' => $this->session->userdata('id')])->result();

        $this->form_validation->set_rules('nama_video', 'Nama video', 'required');
        $this->form_validation->set_rules('mapel', 'Mapel', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('text_video', 'teks video', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar/guru', $data);
            $this->load->view('guru/video/list', $data);
            $this->load->view('templates/footer');
        } else {
            $data_video = [
                'kode_video' => $this->input->post('kode_video'),
                'nama_video' => $this->input->post('nama_video'),
                'guru' => $this->session->userdata('id'),
                'mapel' => $this->input->post('mapel'),
                'kelas' => $this->input->post('kelas'),
                'text_video' => htmlspecialchars($this->input->post('text_video', true)),
                'date_created' => time()
            ];
            $mapel = $this->db->get_where('mapel', ['id_mapel' => $this->input->post('mapel')])->row();

            $siswa = $this->db->get_where('siswa', ['kelas' => $this->input->post('kelas')])->result();

            // Kirim Email Ke siswa
            $email_app = $this->db->get('admin')->row();
            foreach ($siswa as $s) {
                $config = [
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_user' => "$email_app->email",
                    'smtp_pass' => "$email_app->pm",
                    'smtp_port' => 465,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
                ];
                $this->email->initialize($config);

                $this->email->set_newline("\r\n");

                $this->load->library('email', $config);

                $this->email->from("$email_app->email", 'SIRO');
                $this->email->to($s->email);

                $this->email->subject('video');
                $this->email->message('
                    <div style="color: #000; padding: 10px;">
                        <div
                            style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #1C3FAA; font-weight: bold;">
                            SIRO</div>
                        <small style="color: #000;">SIRO by Ihsan</small>
                        <br>
                        <p style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">Hallo ' . $s->nama_siswa . ' <br>
                            <span style="color: #000;">' . $this->session->userdata('nama') . ' memposting video baru</span></p>
                        <table style="font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif; color: #000;">
                            <tr>
                                <td>videoal</td>
                                <td> : ' . $this->input->post('nama_video') . '</td>
                            </tr>
                            <tr>
                                <td>Mata Pelajaran</td>
                                <td> : ' . $mapel->nama_mapel . '</td>
                            </tr>
                        </table>
                        <br>
                        <a href="' . base_url('auth') . '"
                            style="display: inline-block; width: 100px; height: 30px; background: #1C3FAA; color: #fff; text-decoration: none; border-radius: 5px; text-align: center; line-height: 30px; font-family: `Segoe UI`, Tahoma, Geneva, Verdana, sans-serif;">Sign
                            In
                            Now!</a>
                        </div>
                ');

                if (!$this->email->send()) {
                    echo $this->email->print_debugger();
                    die();
                }
            }
            $this->db->insert('video', $data_video);

            if ($_FILES['file_video']) {

                // Hitung Jumlah File/Gambar yang dipilih
                $jumlahData = count($_FILES['file_video']['name']);

                // Lakukan Perulangan dengan maksimal ulang Jumlah File yang dipilih
                for ($i = 0; $i < $jumlahData; $i++) :

                    // Inisialisasi Nama,Tipe,Dll.
                    $_FILES['file']['name']     = $_FILES['file_video']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['file_video']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['file_video']['tmp_name'][$i];
                    $_FILES['file']['size']     = $_FILES['file_video']['size'][$i];

                    // Konfigurasi Upload
                    $config['upload_path']          = './assets/app-assets/file/';
                    $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx|ppt|pptx|rar|zip|xlsx|php|js|html|css|txt|iso';

                    // Memanggil Library Upload dan Setting Konfigurasi
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) { // Jika Berhasil Upload

                        $fileData = $this->upload->data(); // Lakukan Upload Data

                        // Membuat Variable untuk dimasukkan ke Database
                        $uploadData[$i]['kode_file'] = $this->input->post('kode_video');
                        $uploadData[$i]['nama_file'] = $fileData['file_name'];
                    }

                endfor; // Penutup For

                if ($uploadData !== null) { // Jika Berhasil Upload
                    $this->db->insert_batch('file', $uploadData);
                }
            }

            if ($_FILES['video_video']) {
                // Hitung Jumlah File/Gambar yang dipilih
                $jumlahData_video = count($_FILES['video_video']['name']);

                // Lakukan Perulangan dengan maksimal ulang Jumlah File yang dipilih
                for ($i = 0; $i < $jumlahData_video; $i++) :

                    // Inisialisasi Nama,Tipe,Dll.
                    $_FILES['file']['name']     = $_FILES['video_video']['name'][$i];
                    $_FILES['file']['type']     = $_FILES['video_video']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['video_video']['tmp_name'][$i];
                    $_FILES['file']['size']     = $_FILES['video_video']['size'][$i];

                    // Konfigurasi Upload
                    $config_video['upload_path']          = './assets/app-assets/file/';
                    $config_video['allowed_types']        = 'mp4|MP4|3gp|3GP|avi|AVI|mkv|MKV|mpeg|MPEG|wmp|WMP';

                    // Memanggil Library Upload dan Setting Konfigurasi
                    $this->load->library('upload', $config_video);
                    $this->upload->initialize($config_video);

                    if ($this->upload->do_upload('file')) { // Jika Berhasil Upload

                        $fileData_video = $this->upload->data(); // Lakukan Upload Data

                        // Membuat Variable untuk dimasukkan ke Database
                        $uploadData_video[$i]['kode_file'] = $this->input->post('kode_video');
                        $uploadData_video[$i]['nama_file'] = $fileData_video['file_name'];
                    }

                endfor; // Penutup For

                if ($uploadData_video !== null) { // Jika Berhasil Upload
                    $this->db->insert_batch('file', $uploadData_video);
                }
            }

            $siswa_video = [];
            $index_siswa_video = 0;
            foreach ($siswa as $s2) {
                array_push($siswa_video, array(
                    'video' => $this->input->post('kode_video'),
                    'kelas' => $this->input->post('kelas'),
                    'mapel' => $this->input->post('mapel'),
                    'siswa' => $s2->id_siswa,
                    'dilihat' => 0
                ));
            }

            $this->db->insert_batch('video_siswa', $siswa_video);

            $this->session->set_flashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'video telah dibuat',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
            redirect('guru/video?pesan=success');
        }
    }

    public function lihat_video($data_id_video, $data_id_guru)
    {
        // MENU DATA
        $data['dashboard'] = [
            'menu' => '',
            'expanded' => 'false'
        ];
        $data['menu_video'] = [
            'menu' => 'active',
            'expanded' => 'true',
        ];
        $data['menu_tugas'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_ujian'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $data['menu_profile'] = [
            'menu' => '',
            'expanded' => 'false',
        ];
        $video_where = [
            'id_video' => decrypt_url($data_id_video),
            'guru' => decrypt_url($data_id_guru)
        ];
        $data['video'] = $this->db->get_where('video', $video_where)->row();
        $data['mapel'] = $this->db->get_where('mapel', ['id_mapel' => $data['video']->mapel])->row();
        $data['kelas'] = $this->db->get_where('kelas', ['id_kelas' => $data['video']->kelas])->row();
        $data['guru'] = $this->db->get_where('guru', ['id_guru' => $data['video']->guru])->row();

        $data['file'] = $this->db->get_where('file', ['kode_file' => $data['video']->kode_video])->result();

        $data['guru_kelas'] = $this->db->get_where('guru_kelas', ['guru' => $this->session->userdata('id')])->result();
        $data['guru_mapel'] = $this->db->get_where('guru_mapel', ['guru' => $this->session->userdata('id')])->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar/guru', $data);
        $this->load->view('guru/video/lihat-video', $data);
        $this->load->view('templates/footer');
    }

    public function edit_video()
    {
        $kode_video = $this->input->post('e_kode_video');

        $data = [
            'nama_video' => $this->input->post('e_nama_video'),
            'mapel' => $this->input->post('e_mapel'),
            'kelas' => $this->input->post('e_kelas'),
            'text_video' => $this->input->post('e_text_video'),
        ];

        $this->db->where('kode_video', $kode_video);
        $this->db->update('video', $data);

        if ($_FILES['e_file_video']) {

            // Hitung Jumlah File/Gambar yang dipilih
            $jumlahData = count($_FILES['e_file_video']['name']);

            // Lakukan Perulangan dengan maksimal ulang Jumlah File yang dipilih
            for ($i = 0; $i < $jumlahData; $i++) :

                // Inisialisasi Nama,Tipe,Dll.
                $_FILES['file']['name']     = $_FILES['e_file_video']['name'][$i];
                $_FILES['file']['type']     = $_FILES['e_file_video']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['e_file_video']['tmp_name'][$i];
                $_FILES['file']['size']     = $_FILES['e_file_video']['size'][$i];

                // Konfigurasi Upload
                $config['upload_path']          = './assets/app-assets/file/';
                $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx|ppt|pptx|rar|zip|xlsx|php|js|html|css|txt|iso';

                // Memanggil Library Upload dan Setting Konfigurasi
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) { // Jika Berhasil Upload

                    $fileData = $this->upload->data(); // Lakukan Upload Data

                    // Membuat Variable untuk dimasukkan ke Database
                    $uploadData[$i]['kode_file'] = $kode_video;
                    $uploadData[$i]['nama_file'] = $fileData['file_name'];
                }

            endfor; // Penutup For

            if ($uploadData !== null) { // Jika Berhasil Upload
                $this->db->insert_batch('file', $uploadData);
            }
        }

        if ($_FILES['e_video_video']) {
            // Hitung Jumlah File/Gambar yang dipilih
            $jumlahData = count($_FILES['e_video_video']['name']);

            // Lakukan Perulangan dengan maksimal ulang Jumlah File yang dipilih
            for ($i = 0; $i < $jumlahData; $i++) :

                // Inisialisasi Nama,Tipe,Dll.
                $_FILES['file']['name']     = $_FILES['e_video_video']['name'][$i];
                $_FILES['file']['type']     = $_FILES['e_video_video']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['e_video_video']['tmp_name'][$i];
                $_FILES['file']['size']     = $_FILES['e_video_video']['size'][$i];

                // Konfigurasi Upload
                $config['upload_path']          = './assets/app-assets/file/';
                $config['allowed_types']        = 'mp4|MP4|3gp|3GP|avi|AVI|mkv|MKV|mpeg|MPEG|wmp|WMP';

                // Memanggil Library Upload dan Setting Konfigurasi
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) { // Jika Berhasil Upload

                    $fileData = $this->upload->data(); // Lakukan Upload Data

                    // Membuat Variable untuk dimasukkan ke Database
                    $uploadData[$i]['kode_file'] = $kode_video;
                    $uploadData[$i]['nama_file'] = $fileData['file_name'];
                }

            endfor; // Penutup For

            if ($uploadData !== null) { // Jika Berhasil Upload
                $this->db->insert_batch('file', $uploadData);
            }
        }

        $this->session->set_flashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'video telah diupdate',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        redirect('guru/video');
    }

    public function hapus_video($data_id_video, $data_id_guru)
    {
        $video_where = [
            'id_video' => decrypt_url($data_id_video),
            'guru' => decrypt_url($data_id_guru)
        ];
        $video = $this->db->get_where('video', $video_where)->row();

        $this->db->delete('video', $video_where);
        $this->db->delete('chat_video', ['video' => $video->kode_video]);

        $this->db->delete('video_siswa', ['video' => $video->kode_video]);

        $file = $this->db->get_where('file', ['kode_file' => $video->kode_video])->result();

        foreach ($file as $f) {
            if ($f->kode_file == $video->kode_video) {
                unlink(FCPATH . 'assets/app-assets/file/' . $f->nama_file);
                $this->db->delete('file', ['kode_file' => $video->kode_video]);
            }
        }

        $this->session->set_flashdata('pesan', "
                        swal({
                            title: 'Berhasil!',
                            text: 'video telah dihapus',
                            type: 'success',
                            padding: '2em'
                            });
                        ");
        redirect('guru/video');
    }

    // END video