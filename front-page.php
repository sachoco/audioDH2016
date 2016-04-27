<?php 
    require_once("include/Mobile_Detect.php");
    $detect = new Mobile_Detect;
    $is_mobile = false;
    if ( $detect->isMobile() && !$detect->isIpad() )  $is_mobile = ture;
?>  
<?php include('header.php') ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="wrapper">
<section class="grid-12">
    <ul class="track grid-3">
    <?php

        for($i=0; $i<50; $i++){
            echo "<li>Artist ".$i."</li>";

        }

    ?>
    </ul>
    <ul class="track grid-3">
    <?php

        for($i=50; $i<100; $i++){
            echo "<li>Artist ".$i."</li>";

        }

    ?>
    </ul>
    <ul class="track grid-3">
    <?php

        for($i=100; $i<150; $i++){
            echo "<li>Artist ".$i."</li>";

        }

    ?>
    </ul>
    <ul class="track grid-3">
    <?php

        for($i=150; $i<200; $i++){
            echo "<li>Artist ".$i."</li>";

        }

    ?>
    </ul>
<!-- <h2>Tracks</h2>
 --><table class="table table-striped table-bordered" cellspacing="0" width="100%">
<!--         <thead>
            <tr>
                <th>Artist Name</th>
                <th>Track Name</th>
            </tr>
        </thead> -->
        <tbody id="tracks">

        </tbody>
    </table>
</section>
<section class="grid-4">
<script src="https://connect.soundcloud.com/sdk/sdk-3.0.0.js"></script>
<script>
SC.initialize({
  client_id: '098249c9bda43969033f485dc628827d'
});


jQuery(document).ready(function($){

  var timecode = function(ms) {
    var hms = function(ms) {
          return {
            h: Math.floor(ms/(60*60*1000)),
            m: Math.floor((ms/60000) % 60),
            s: Math.floor((ms/1000) % 60)
          };
        }(ms),
        tc = []; // Timecode array to be joined with '.'

    if (hms.h > 0) {
      tc.push(hms.h);
    }

    tc.push((hms.m < 10 && hms.h > 0 ? "0" + hms.m : hms.m));
    tc.push((hms.s < 10  ? "0" + hms.s : hms.s));

    return tc.join('.');
  };


    var myplayer;
    var mytracks;
    var nowplaying = 0;
    var isPlaying = false;

    SC.get('/users/1602737/tracks').then(function(tracks){
    // SC.get('/playlists/218873111').then(function(playlist){
        // var tracks = playlist.tracks;
        mytracks = tracks;

        for (index = 0; index < tracks.length; ++index) {
            // console.log(tracks[index]);
            // $("#tracks").append("<tr data-index='" + index + "' data-id='"+tracks[index].id+"'><td>"+tracks[index].title+"<span class='duration'>"+timecode(tracks[index].duration)+"</span></td></tr>");

                // "<tr data-id='" + tracks[index].id + "'>" + tracks[index].title + "</tr>");
        }




    });

    $("#tracks").on("click", "tr", function(){
        nowplaying = $(this).data("index");
        if(myplayer) myplayer.seek(0);       
        play();
    });

   var playPause = function(){
        if(isPlaying){
            pause();
        }else{
            play(nowplaying);

            // myplayer.play();

        }
    }

    var play = function(){
        var track = mytracks[nowplaying];
        var dur = track.duration;
        SC.stream('/tracks/'+track.id).then(function(player){
            player.play();
            myplayer = player;
            $(".trackinfo header").html(track.title);
            $(".trackinfo section").html(track.description);
            $(".controller .dur").html(timecode(track.duration));

            player.on("time", function(){
                $(".controller .cur").html(timecode(player.currentTime()));
                $(".controller progress").attr("value", player.currentTime()/dur*100);
                // console.log(time);
            });
            player.on("finish", function(){
                playNext();
            });
            $("button.playpause i").addClass("fa-pause").removeClass("fa-play");
            $("#tracks tr").removeClass("nowplaying");
            $("#tracks tr:nth-of-type("+(nowplaying+1)+")").addClass("nowplaying");
            isPlaying = true;
        });
    }

    var pause = function(){
        myplayer.pause();
        $("button.playpause i").removeClass("fa-pause").addClass("fa-play");
        isPlaying = false;
    }

    var playNext = function(){
        nowplaying++;
        if(nowplaying>=mytracks.length) nowplaying = 0;
        if(myplayer) myplayer.seek(0);       
        play();
    }

    var playPrev = function(){
        nowplaying--;
        if(nowplaying<0) nowplaying = mytracks.length;
        if(myplayer) myplayer.seek(0);       
        play();
    }

    $("button.playpause").on("click", function(){ playPause();});
    $("button.next").on("click", function(){ playNext();});
    $("button.prev").on("click", function(){ playPrev();});

$('progress').on('click', function (ev) {
    var $progressbar = $(ev.target);
    var offset = $progressbar.offset();
    var width = $progressbar.width();
    var x = ev.clientX - offset.left;
    var percentage = x / width;
    var track = mytracks[nowplaying];
    var dur = track.duration;

    var pos = dur * percentage;

    if(myplayer) myplayer.seek(pos);

    // $('.progress').width(x);
});


    $("#volume-scrubber").on('mousedown', startSlide);   
    $(document).on('mouseup', stopSlide);

function startSlide(ev){
    var $target = $("#volume-scrubber");//$(ev.target);
    var offset = $target.offset();
    var width = $target.width();
    var x = ev.clientX - offset.left;
    var percentage = x / width;

    $("#volume-scrubber").on('mousemove', moveSlide);    
    $("#volume-indicator").width((percentage * 100) + '%');  

    if(myplayer) myplayer.setVolume(percentage);
}
function moveSlide(ev){
    var $target = $("#volume-scrubber");//$(ev.target);
    var offset = $target.offset();
    var width = $target.width();
    var x = ev.clientX - offset.left;
    var percentage = x / width;

    $("#volume-indicator").width((percentage * 100) + '%');    
    if(myplayer) myplayer.setVolume(percentage);

}
function stopSlide(ev){
    $("#volume-scrubber").off('mousemove', moveSlide);
}


});

</script>




<?php endwhile; ?>
<?php endif; ?>


<?php include('footer.php') ?>
