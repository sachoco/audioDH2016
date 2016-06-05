<?php 
    require_once("include/Mobile_Detect.php");
    $detect = new Mobile_Detect;
    $is_mobile = false;
    if ( $detect->isMobile() && !$detect->isIpad() )  $is_mobile = ture;
?>  
<?php include('header.php') ?>
<div class="wrapper">
<section class="gr-12">
    <section class="content-wrapper"></section>
    <ul class="tracks">
    
    <?php
        
        $tracks = array();
        $args = array(
          'post_type' => 'tracks',
          'post_status' => 'publish',
          'orderby' => 'title',
          'order'   => 'ASC',
          'posts_per_page' => -1
        );

        $i = 0;

        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
                // var_dump($post);
                $track = array(
                    'id' => $i,
                    'artist' => $post->post_title,
                    'artist_full' => get_field('full_artist_name'),
                    'track_title' => get_field('track_title'),
                    'track_id' => get_field('soundcloud_id'),
                    'link' => get_field('artist_link'),
                    'description' => $post->post_content
                );
               

                array_push($tracks, $track);


                echo "<li data-id='".$track[id]."' >".$track[artist]."</li>";
                $i++;
            endwhile;
        endif;

        // for($i=0; $i<200; $i++){
        //     echo "<li data-title='Track Title ".$i."'>Firstname Lastname ".$i."</li>";

        // }

    ?>
    </ul>
    
</section>
<script src="https://connect.soundcloud.com/sdk/sdk-3.0.0.js"></script>
<script>
    SC.initialize({
      client_id: '098249c9bda43969033f485dc628827d'
    });

    var tracks = <?php echo json_encode($tracks) ?>;
</script>


<?php include('footer.php') ?>
