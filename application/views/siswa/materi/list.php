<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget-heading">
                                <h5 class="">Materi</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="datatable-table" class="table text-center text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Materi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($materi as $m) : ?>
                                            <tr>
                                                <td><?= $m->nama_materi; ?></td>
                                                <td>
                                                    <?php foreach ($mapel as $mpl) : ?>
                                                        <?php if ($mpl->id_mapel == $m->mapel) {
                                                            echo $mpl->nama_mapel;
                                                        } ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('siswa/lihat_materi/') . encrypt_url($m->id_materi); ?>" class="btn btn-primary">Lihat</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="<?= base_url('assets/app-assets/img/'); ?>materi.svg" class="align-middle" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div style="position: absolute; right: 10px; bottom: -10px; width: 400px;">
        <img src="<?= base_url('assets/app-assets/img/'); ?>kelas.svg" alt="">
    </div> -->
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © 2021 <a target="_blank" href="http://www.instagram.com/ikhsa.an" class="text-primary">Ihsan</a></p>
        </div>
        <div class="footer-section f-section-2">
            <p class="">SIRO</p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->
<script>
    <?= $this->session->flashdata('pesan'); ?>
</script>