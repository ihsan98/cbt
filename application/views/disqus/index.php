<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 layout-spacing">
                <div class="widget shadow p-3">
                    <div class="row">
                        <div class="col-12">
                          <form action="<?php echo site_url('disqus/check_room'); ?>" method="POST" class="row g-3">
                            <div class="col-auto">
                              <label">Masuk Disqus</label>
                            </div>
                            <div class="col-auto">
                              <input type="text" maxlength="6" class="form-control" name="kode_disqus" placeholder="Kode Disqus">
                            </div>
                            <div class="col-auto">
                              <button type="submit" class="btn btn-primary mb-3">Masuk / Buat</button>
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