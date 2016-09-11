<?php include('header.php') ?>
<div class="wrapper">
<section class="body gr-12">
    <section class="content-wrapper"></section>
    <section class="tracks-wrapper">
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
                   
                    if(!$track[artist_full]) $track[artist_full]=$track[artist];
                    array_push($tracks, $track);


                    echo "<li data-id='".$track[id]."' ><span>".$track[artist]."</span></li>";
                    $i++;
                endwhile;
            endif;

        ?>
        </ul>
        <div class="download-link gr-12">
        <?php
            $options = get_option( 'audioDH_theme_options' );
            if($options['download_all_link']) echo "<a href='".$options['download_all_link']."' target='_blank'>download all tracks</a>";
        ?>        
        </div>
    </section>
    
</section>
<script src="https://connect.soundcloud.com/sdk/sdk-3.1.2.js"></script>
<script>
    SC.initialize({
      client_id: 'd71d92737e650fa0a479ca7aaff8b652'
    });
            
    var tracks = <?php echo json_encode($tracks) ?>;
</script>

</div>
<?php include('footer.php') ?>
