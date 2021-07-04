<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disqus extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index() {
    $data = array();

    if($this->session->userdata('role') == '2') {
      // MENU DATA
      $data['dashboard'] = [
          'menu' => '',
          'expanded' => 'false'
      ];
      $data['menu_materi'] = [
          'menu' => '',
          'expanded' => 'false',
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
    } else if($this->session->userdata('role') == '3') {
      $data['dashboard'] = [
          'menu' => '',
          'expanded' => 'false'
      ];
      $data['menu_penilaian'] = [
          'menu' => '',
          'expanded' => 'false',
      ];
      $data['menu_materi'] = [
          'menu' => '',
          'expanded' => 'false',
      ];
      $data['menu_video'] = [
          'menu' => 'false',
          'expanded' => '',
      ];
      $data['menu_pertanyaan'] = [
          'menu' => '',
          'expanded' => 'false',
      ];
      $data['menu_jawaban'] = [
          'menu' => '',
          'expanded' => 'false',
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
    }
    
    $this->load->view('templates/header', $data);

    if($this->session->userdata('role') == '2') {
      $this->load->view('templates/sidebar/siswa', $data);
    } else if($this->session->userdata('role') == '3') {
      $this->load->view('templates/sidebar/guru', $data);
    }

    $this->load->view('disqus/index');
    $this->load->view('templates/footer');
  }

  public function generateRandomString($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function room($kode='') {
    $data = array();
    
    if($kode == '') {
      redirect('disqus');
    }

    if($this->session->userdata('role') == '2') {
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));

      if($cek->num_rows() > 0) {
        $data['action'] = false;
      } else {
        redirect('disqus');
      }
    } else {
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));
      
      if($cek->num_rows() > 0) {
        $data['action'] = true;
      } else {
        redirect('disqus');
      }
    }

    if($this->session->userdata('role') == '2') {
      // MENU DATA
      $data['dashboard'] = [
          'menu' => '',
          'expanded' => 'false'
      ];
      $data['menu_materi'] = [
          'menu' => '',
          'expanded' => 'false',
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
    } else if($this->session->userdata('role') == '3') {
      $data['dashboard'] = [
          'menu' => '',
          'expanded' => 'false'
      ];
      $data['menu_penilaian'] = [
          'menu' => '',
          'expanded' => 'false',
      ];
      $data['menu_materi'] = [
          'menu' => '',
          'expanded' => 'false',
      ];
      $data['menu_video'] = [
          'menu' => 'false',
          'expanded' => '',
      ];
      $data['menu_pertanyaan'] = [
          'menu' => '',
          'expanded' => 'false',
      ];
      $data['menu_jawaban'] = [
          'menu' => '',
          'expanded' => 'false',
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
    }
    
    $this->load->view('templates/header', $data);

    if($this->session->userdata('role') == '2') {
      $this->load->view('templates/sidebar/siswa', $data);
    } else if($this->session->userdata('role') == '3') {
      $this->load->view('templates/sidebar/guru', $data);
    }

    $this->load->view('disqus/room');
    $this->load->view('templates/footer');
  }

  public function check_room() {
    $kode = $this->input->post('kode_disqus');

    if($this->session->userdata('role') == '2') {
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));

      if($cek->num_rows() > 0) {
        redirect('disqus/room/' . $kode);
      } else {
        redirect('disqus');
      }
    } else {
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));

      if($cek->num_rows() > 0) {
        redirect('disqus/room/' . $kode);
      } else {
        $kode = $this->generateRandomString(6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        
        $this->db->insert('disqus', array('kode_disqus' => $kode));
        
        redirect('disqus/room/' . $kode);
      }
    }
  }

  public function get_chat() {
    $id = "";
    $valid = false;
    $response = array();
    $html_chat = "";

    $kode = $this->input->post('kode_disqus');

    if($this->session->userdata('role') == '2') {
      $id = "s" . $this->session->userdata('id');
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));

      if($cek->num_rows() > 0) {
        // echo "1";
        $valid = true;
      } else {
        // echo "2";
        $valid = false;
      }
    } else {
      $id = "g" . $this->session->userdata('id');
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));
      
      if($cek->num_rows() > 0) {
        // echo "3";
        $valid = true;
      } else {
        // echo "4";
        $valid = false;
      }
    }

    $cek_disqus = $this->db->get_where('disqus', array('kode_disqus' => $kode));

    if($cek_disqus->num_rows() > 0) {
      $disqus = $this->db->get_where('disqus', array('kode_disqus' => $kode))->row();

      $start = strtotime($disqus->tanggal_dibuat);
      $end = time();
      $mins = ($end - $start) / 60;
      
      if($mins > 5) {
        $this->db->delete('disqus', array('kode_disqus' => $kode));
        $valid = false;
      } else {
        $semua_chat = $this->db->get_where('disqus_chat', array('id_disqus' => $disqus->id_disqus))->result();

        foreach($semua_chat as $chat) {
          $check = $this->db->get_where('disqus_chat_temp', array('id' => $id, 'id_chat' => $chat->id_chat));

          if($check->num_rows() > 0) {
            // No action
          } else {
            $html_chat .= '<li>';
            $html_chat .= '<h5>' . $chat->nama_pengirim . '</h5>';
            $html_chat .= '<p>' . $chat->isi_pesan . '</p>';
            $html_chat .= '</li>';

            $this->db->insert('disqus_chat_temp', array('id_chat' => $chat->id_chat, 'id' => $id));
          }
        }

        $response['chat'] = $html_chat;
      }

    } else {
      $valid = false;
    }

    if($valid === true) {
      echo $html_chat;
    } else {
      echo "false";
    }
  }

  public function send_message() {
    $id = "";
    $valid = false;
    $response = array();
    $html_chat = "";
    $nama_pengirim = "";

    $kode = $this->input->post('kode_disqus');
    $isi_pesan = $this->input->post('isi_pesan');

    if($this->session->userdata('role') == '2') {
      $siswa = $this->db->get_where('siswa', array('id_siswa' => $this->session->userdata('id')))->row();
      $nama_pengirim = $siswa->nama_siswa;

      $id = "s" . $this->session->userdata('id');
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));

      if($cek->num_rows() > 0) {
        // echo "1";
        $valid = true;
      } else {
        // echo "2";
        $valid = false;
      }
    } else {
      $guru = $this->db->get_where('guru', array('id_guru' => $this->session->userdata('id')))->row();
      $nama_pengirim = $guru->nama_guru;

      $id = "g" . $this->session->userdata('id');
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));
      
      if($cek->num_rows() > 0) {
        // echo "3";
        $valid = true;
      } else {
        // echo "4";
        $valid = false;
      }
    }

    if($valid === true) {
      $disqus = $this->db->get_where('disqus', array('kode_disqus' => $kode))->row();

      $this->db->insert('disqus_chat', array('id_disqus' => $disqus->id_disqus, 'nama_pengirim' => $nama_pengirim, 'isi_pesan' => $isi_pesan));
    }
  }

  public function delete_room($kode='') {
    $data = array();
    
    if($kode == '') {
      redirect('disqus');
    }

    if($this->session->userdata('role') == '2') {
      $valid = false;
    } else {
      $cek = $this->db->get_where('disqus', array('kode_disqus' => $kode));
      
      if($cek->num_rows() > 0) {
        $valid = true;
      } else {
        $valid = false;
      }
    }

    if($valid === true) {
      $this->db->delete('disqus', array('kode_disqus' => $kode));
    }

    redirect('disqus');
  }
}