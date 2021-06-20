<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
      <div class="row layout-top-spacing">
        <div class="col-lg-12 layout-spacing">
          <div class="widget shadow p-3">
            <div class="widget-heading">
              <div class="row">
                <div class="col-md-8">
                  <input type="hidden" id="idMateri" value="<?php echo $materi->id_materi; ?>">
                  <input type="hidden" id="idVideo" value="<?php echo $video->id_video; ?>">
                  <input type="hidden" id="idSiswa" value="<?php echo $siswa->id_siswa; ?>">
                  <h4>Materi</h4>
                  <hr>
                  <h5><?php echo $video->judul_video; ?></h5>
                  <p class="text-muted"><?php echo "Terakhir diperbarui " . date('M d, Y H:i A', strtotime($video->terakhir_diperbarui)); ?></p>
                  <div class="wrap-question">
                    <?php $semua_pertanyaan = $this->db->get_where('pertanyaan', array('id_video' => $video->id_video))->result(); ?>
                    <?php shuffle($semua_pertanyaan); ?>
                    <?php $i=0; ?>
                    <?php foreach($semua_pertanyaan as $pertanyaan) { ?>
                    <div id="<?php echo "q" . $pertanyaan->id_pertanyaan; ?>" class="question <?php echo ($i === 0 ? 'show' : ''); ?>">
                      <p><?php echo $pertanyaan->judul_pertanyaan; ?></p>
                      <?php $semua_jawaban = $this->db->get_where('jawaban', array('id_pertanyaan' => $pertanyaan->id_pertanyaan))->result(); ?>
                      <?php shuffle($semua_jawaban); ?>
                      <?php foreach($semua_jawaban as $jawaban) { ?>
                      <p><input type="radio" name="<?php echo "q" . $pertanyaan->id_pertanyaan; ?>" value="<?php echo $jawaban->id_jawaban; ?>">&nbsp;&nbsp;<?php echo $jawaban->judul_jawaban; ?></p>
                      <?php } ?>
                    </div>
                    <?php $i++; ?>
                    <?php } ?>

                    <div class="nav-question">
                      <ul>
                        <?php $i=1; ?>
                        <?php foreach($semua_pertanyaan as $pertanyaan) { ?>
                        <li data-q="<?php echo "q" . $pertanyaan->id_pertanyaan; ?>"><?php echo $i; ?></li>
                        <?php $i++; ?>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                  <div style="width: 100%; height: 400px;" id="player" data-kode="<?php echo $video->kode_video; ?>" data-waktu="<?php echo $video->waktu_kuis; ?>"></div>
                  <p><?php echo $video->deskripsi_video; ?></p>
                  <!-- <iframe style="margin-bottom: 15px; width: 100%; height: 450px;"src="https://www.youtube.com/embed/<?php echo $video->kode_video; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>
                <div class="col-md-4">
                  <?php if(count($semua_materi) > 0) { ?>
                  <div class="accordion" id="accordionExample">
                    <?php $i=0; ?>
                    <?php foreach($semua_materi as $row) { ?>
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#<?php echo "collapse" . $i; ?>" aria-expanded="true" aria-controls="<?php echo "collapse" . $i; ?>">
                            <?php echo $row->nama_materi; ?>
                          </button>
                        </h2>
                      </div>

                      <div id="<?php echo "collapse" . $i; ?>" class="collapse <?php echo ($i === 0 ? 'show' : ''); ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <?php
                          $semua_video = $this->db->get_where('video', array('id_materi' => $row->id_materi))->result();
                        ?>
                        <div class="card-body">
                          <?php if(count($semua_video) > 0) { ?>
                          <div class="list-group">
                            <?php foreach($semua_video as $row2) { ?>
                            <a href="<?php echo site_url('siswa/lihat_video/' . encrypt_url($row2->id_video)); ?>" class="list-group-item list-group-item-action <?php echo (decrypt_url($this->uri->segment(3)) == $row2->id_video ? 'active' : ''); ?>" <?php echo (decrypt_url($this->uri->segment(3)) === $row2->id_video ? 'aria-current="true"' : ''); ?>><?php echo $row2->judul_video; ?></a>
                            <?php } ?>
                          </div>
                          <?php } else { ?>
                          <p>Tidak ada video.</p>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <?php $i++; ?>
                    <?php } ?>
                  </div>
                  <?php } else { ?>
                  <p>Tidak ada materi.</p>
                  <?php } ?>
                </div>
              </div>
              <a href="javascript:vod(0)" class="btn btn-primary mt-3" onclick="history.back(-1)">Kembali</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  // 2. This code loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');

  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // 3. This function creates an <iframe> (and YouTube player)
  //    after the API code downloads.
  var player;
  function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '390',
      width: '640',
      videoId: document.getElementById('player').getAttribute('data-kode'),
      playerVars: {
        'playsinline': 1
      },
      events: {
        'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
    });
  }

  // 4. The API will call this function when the video player is ready.
  function onPlayerReady(event) {
    event.target.playVideo();
  }

  // 5. The API calls this function when the player's state changes.
  //    The function indicates that when playing a video (state=1),
  //    the player should play for six seconds and then stop.
  var done = false;
  var _show = false;
  function onPlayerStateChange(event) {
    // if (event.data == YT.PlayerState.PLAYING && !done) {
    //   setTimeout(stopVideo, 6000);
    //   done = true;
    // }

    if (event.data == YT.PlayerState.PLAYING && !_show) {
      var _waktu = document.getElementById('player').getAttribute('data-waktu');

      checkKuis = setInterval(function() {
        console.log(Math.round(player.getCurrentTime()) + ":" + _waktu);

        if(Math.round(player.getCurrentTime()) == _waktu) {
          _show  = true;
          pauseVideo();
          clearInterval(checkKuis);

          showKuis();
        }
      }, 1000)
    }
  }

  function stopVideo() {
    player.stopVideo();
  }

  function pauseVideo() {
    player.pauseVideo();
  }

  $(document).ready(function() {
    showKuis = function() {
      var _width_player = $('#player').width();
      var _height_player = $('#player').height();

      $('.wrap-question').css({
        'width': _width_player,
        'height': _height_player
      })

      $('.wrap-question').addClass('show');
    }

    setInterval(function() {
      var _i = 0;
      var _iqs = 0;

      $('.question').each(function() {
        if($(this).hasClass('show')) {
          _iqs = _i; 
        }

        _i++;
      })

      var _j = 0;

      $('.nav-question ul li').each(function() {
        if(_j === _iqs) {
          $('.nav-question ul li').removeClass('current');
          $(this).addClass('current');
        }

        _j++;
      })
    })

    $('.nav-question ul li').on('click', (function() {
      var _q = $(this).data('q');

      $('.nav-question ul li').removeClass('current');
      $(this).addClass('current');

      $('.question').removeClass('show');
      $('#' + _q).addClass('show');
    }))
  })
</script>
<!--  END CONTENT AREA  -->