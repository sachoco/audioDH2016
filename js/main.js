(function() {
  var base, downloadURL, dur, isPlaying, myplayer, nowplaying, timecode;

  myplayer = null;

  nowplaying = 0;

  isPlaying = false;

  dur = null;

  downloadURL = null;

  timecode = function(ms) {
    var hms, tc;
    hms = function(ms) {
      return {
        h: Math.floor(ms / (60 * 60 * 1000)),
        m: Math.floor((ms / 60000) % 60),
        s: Math.floor((ms / 1000) % 60)
      };
    };
    hms = hms(ms);
    tc = [];
    if (hms.h > 0) {
      tc.push(hms.h);
    }
    tc.push("0" + hms.m);
    tc.push(hms.s < 10 ? "0" + hms.s : hms.s);
    return tc.join('.');
  };

  if ((base = Array.prototype).shuffle == null) {
    base.shuffle = function() {
      var i, j, k, ref, ref1;
      if (this.length > 1) {
        for (i = k = ref = this.length - 1; ref <= 1 ? k <= 1 : k >= 1; i = ref <= 1 ? ++k : --k) {
          j = Math.floor(Math.random() * (i + 1));
          ref1 = [this[j], this[i]], this[i] = ref1[0], this[j] = ref1[1];
        }
      }
      return this;
    };
  }

  jQuery(function($) {
    var isAnimating, isAnimating2, moveProgressSlide, moveVolumeSlide, pause, play, playNext, playPause, playPrev, showCurtrackDesc, startProgressSlide, startVolumeSlide, stopProgressSlide, stopVolumeSlide;
    playPause = function() {
      if (isPlaying) {
        return pause();
      } else {
        return play(tracks[nowplaying]);
      }
    };
    play = function(track) {
      SC.get('/tracks/' + track.track_id).then(function(track) {
        dur = track.duration;
        downloadURL = track.download_url;
        return $("button.download").addClass('active').removeAttr('disabled');
      });
      return SC.stream('/tracks/' + track.track_id).then(function(player) {
        var artist_name;
        player.play();
        myplayer = player;
        artist_name = track.artist_full ? track.artist_full : track.artist;
        $(".trackinfo-cur .title").html(track.track_title);
        $(".trackinfo-cur .artist").html(artist_name);
        $(".curtrack-description header").html("<h3>" + track.artist_full + "</h3><h4>" + track.track_title + "</h4>");
        $(".curtrack-description section").html(track.description);
        $(".curtrack-description footer").html("<a href='" + track.link + "' target='_blank'>" + track.link + "</a>");
        $(".curtrack-description").show();
        $(".controller .dur").html(timecode(dur));
        $(".trackinfo").hide();
        player.on("time", function() {
          $(".controller .cur").html(timecode(player.currentTime()));
          return $("#progress-indicator").width((player.currentTime() / dur * 100) + '%');
        });
        player.on("finish", function() {
          return playNext();
        });
        $("button.playpause i").addClass("fa-pause").removeClass("fa-play");
        $("ul.tracks li").removeClass("nowplaying");
        $("ul.tracks li[data-id='" + track.id + "']").addClass("nowplaying");
        return isPlaying = true;
      });
    };
    pause = function() {
      myplayer.pause();
      $("button.playpause i").removeClass("fa-pause").addClass("fa-play");
      return isPlaying = false;
    };
    playNext = function() {
      nowplaying++;
      if (nowplaying >= tracks.length) {
        nowplaying = 0;
      }
      if (myplayer) {
        myplayer.seek(0);
      }
      return play(tracks[nowplaying]);
    };
    playPrev = function() {
      nowplaying--;
      if (nowplaying < 0) {
        nowplaying = mytracks.length;
      }
      if (myplayer) {
        myplayer.seek(0);
      }
      return play(tracks[nowplaying]);
    };
    $("button.playpause").on("click", function() {
      return playPause();
    });
    $("button.next").on("click", function() {
      return playNext();
    });
    $("button.prev").on("click", function() {
      return playPrev();
    });
    $("button.shuffle").on("click", function() {
      var cur_track;
      $(this).toggleClass("active");
      cur_track = tracks[nowplaying];
      if ($(this).hasClass("active")) {
        tracks.shuffle();
      } else {
        tracks.sort(function(a, b) {
          return parseFloat(a.id) - parseFloat(b.id);
        });
      }
      if (myplayer) {
        return nowplaying = $.inArray(cur_track, tracks);
      }
    });
    $("button.download").on("click", function() {
      return window.location.href = downloadURL + '?client_id=098249c9bda43969033f485dc628827d';
    });
    moveProgressSlide = function(e) {
      var $target, offset, percentage, width, x;
      $target = $("#progress-scrubber");
      offset = $target.offset();
      width = $target.width();
      x = e.clientX - offset.left;
      percentage = x / width;
      $("#progress-indicator").width((percentage * 100) + '%');
      if (myplayer) {
        return myplayer.seek(percentage * dur);
      }
    };
    startProgressSlide = function(e) {
      var $target, offset, percentage, width, x;
      $target = $("#progress-scrubber");
      offset = $target.offset();
      width = $target.width();
      x = e.clientX - offset.left;
      percentage = x / width;
      $("#progress-scrubber").on('mousemove', moveProgressSlide);
      $("#progress-indicator").width((percentage * 100) + '%');
      if (myplayer) {
        return myplayer.seek(percentage * dur);
      }
    };
    stopProgressSlide = function(e) {
      return $("#progress-scrubber").off('mousemove', moveProgressSlide);
    };
    $("#progress-scrubber").on('mousedown', startProgressSlide);
    $(document).on('mouseup', stopProgressSlide);
    moveVolumeSlide = function(e) {
      var $target, offset, percentage, width, x;
      $target = $("#volume-scrubber");
      offset = $target.offset();
      width = $target.width();
      x = e.clientX - offset.left;
      percentage = x / width;
      $("#volume-indicator").width((percentage * 100) + '%');
      if (myplayer) {
        return myplayer.setVolume(percentage);
      }
    };
    startVolumeSlide = function(e) {
      var $target, offset, percentage, width, x;
      $target = $("#volume-scrubber");
      offset = $target.offset();
      width = $target.width();
      x = e.clientX - offset.left;
      percentage = x / width;
      $("#volume-scrubber").on('mousemove', moveVolumeSlide);
      $("#volume-indicator").width((percentage * 100) + '%');
      if (myplayer) {
        return myplayer.setVolume(percentage);
      }
    };
    stopVolumeSlide = function(e) {
      return $("#volume-scrubber").off('mousemove', moveVolumeSlide);
    };
    $("#volume-scrubber").on('mousedown', startVolumeSlide);
    $(document).on('mouseup', stopVolumeSlide);
    isAnimating = false;
    isAnimating2 = false;
    $("ul.tracks li").on("mouseenter", function() {
      var id, track;
      if (!$(this).hasClass("nowplaying")) {
        if (!isAnimating) {
          id = $(this).data('id');
          track = $.grep(tracks, function(track) {
            return track.id === id;
          });
          track = track[0];
          $(".curtrack-description").hide();
          $(".trackinfo header").html("<h3>" + track.artist_full + "</h3><h4>" + track.track_title + "</h4>");
          $(".trackinfo section").html(track.description);
          $(".trackinfo footer").html("<a href='" + track.link + "' target='_blank'>" + track.link + "</a>");
          $(".trackinfo").show();
          $(".info-area").addClass('grey');
          $(".footer").velocity({
            height: Math.max($(".trackinfo").outerHeight(), $(".controller").height() + 40)
          }, {
            duration: 500,
            queue: false
          });
        }
      } else {
        showCurtrackDesc();
      }
      return this;
    });
    $("ul.tracks li").click(function() {
      var id, index, track;
      id = $(this).data('id');
      track = $.grep(tracks, function(track, i) {
        return track.id === id;
      });
      track = track[0];
      index = $.inArray(track, tracks);
      nowplaying = index;
      $(".tracks li").removeClass("nowplaying");
      $(this).addClass("nowplaying");
      return play(track);
    });
    $("nav.nav li:not('.home-btn') a").on("click", function(e) {
      e.preventDefault();
      return $(".content-wrapper").load($(this).attr('href') + " #content", function() {
        $(".content-wrapper").show();
        return $(".tracks-wrapper").hide();
      });
    });
    $("section.header header, nav.nav li.home-btn a").on("click", function(e) {
      e.preventDefault();
      $(".content-wrapper").hide();
      return $(".tracks-wrapper").show();
    });
    showCurtrackDesc = function() {
      if (!isAnimating2) {
        $(".curtrack-description").show();
        $(".trackinfo").hide();
        $(".footer").velocity({
          height: Math.max($(".curtrack-description").outerHeight(), $(".controller-wrapper").height() + 40)
        }, {
          duration: 500,
          queue: false,
          begin: function() {
            return isAnimating = true;
          },
          complete: function() {
            return isAnimating = false;
          }
        });
        return $(".info-area").removeClass('grey');
      }
    };
    $(".header").hover(function() {
      return showCurtrackDesc();
    });
    $(".footer").on("mouseenter", function() {
      return showCurtrackDesc();
    });
    $(window).resize(function() {
      var h, top;
      h = $(window).height();
      top = $("section.footer").offset().top;
      if (h < 550) {
        return $("section.footer").addClass("mini");
      } else {
        return $("section.footer").removeClass("mini");
      }
    });
    return this;
  });

}).call(this);
