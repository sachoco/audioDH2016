<?php include('header.php') ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


    <section id="content">
<!--         <section class="page__header"><h2 class="title"><?php the_title(); ?></h2></section>
 -->        <section class="page__body">
            <ul class="news">
            
            <?php
                $args = array(
                  'post_type' => 'post',
                  'post_status' => 'publish',
                  'orderby' => 'date',
                  'order'   => 'DESC',
                  'posts_per_page' => -1
                );

                $i = 0;

                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        // var_dump($post);
                        
                        $categories = get_the_category();
                        $permalink = get_the_permalink();
 
                        if ( ! empty( $categories ) ) {
                            $cat = esc_html( $categories[0]->name );   
                        }

                        echo "<li class='gr-4' data-id='".$post->ID."' ><div>";
                        the_post_thumbnail('medium');
                        echo "<h3>".$post->post_title."</h3><date>".mysql2date('j F Y', $post->post_date)."</date> | <span class='category'>".$cat."</span><div class='devider'>--------</div><div class='excerpt'>";
                        the_excerpt();
                        echo "<a href='".$permalink."' class='readmore'>Read More</a></div></div></li>";
                        $i++;
                    endwhile;
                endif;

                // for($i=0; $i<200; $i++){
                //     echo "<li data-title='Track Title ".$i."'>Firstname Lastname ".$i."</li>";

                // }

            ?>
            </ul>
        </section>
    </section>


<?php endwhile; ?>
<?php endif; ?>


<?php include('footer.php') ?>
