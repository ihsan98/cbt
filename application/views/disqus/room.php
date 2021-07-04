<style>
  .wrap-chat {
    background: #fefefe;
    margin: 0 auto;
    padding: 15px;
    position: relative;
    overflow-y: scroll;
    max-width: 600px;
    height: 500px;
  }

  .wrap-chat + form {
    margin: 15px auto;
    position: relative;
    max-width: 600px;
  }

  .wrap-chat ol {
    list-style: none;
    padding: 0 15px 0 0;
    margin: 0;
  }

  .wrap-chat ol li {
    border-radius: 4px;
    border: 1px solid #eaeaea;
    padding: 10px;
    box-shadow: 1px 3px 5px #eaeaea;
    margin-bottom: 10px;
    margin-left: 30px;
  }

  .wrap-chat ol li:before {
    color: #ecf0f1;
    display: block;
    content: '\25B2';
    position: absolute;
    font-size: 30px;
    transform: rotate(270deg);
    margin-top: -23px;
    margin-left: -36px;
  }
</style>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-12">
                          <?php if($action) { ?>
                          <div class="float-right">
                            <a href="<?php echo site_url('disqus/delete_room/' . $this->uri->segment(3)); ?>" class="btn btn-small btn-danger">Hapus</a>
                          </div>
                          <?php } ?>
                          <h4>Room: <?php echo $this->uri->segment(3); ?></h4>
                          <div class="wrap-chat">
                            <input type="hidden" id="kode_disqus" value="<?php echo $this->uri->segment(3); ?>">
                            <ol></ol>
                          </div>
                          <form id="kirim-pesan" action="<?php echo site_url('disqus/send_message'); ?>" method="POST" class="row g-3">
                            <div class="col-auto">
                              <input id="isi_pesan" type="text" class="form-control" name="isi_pesan" placeholder="Pesan">
                            </div>
                            <div class="col-auto">
                              <button type="submit" class="btn btn-primary mb-3">Kirim</button>
                            </div>
                          </form>
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