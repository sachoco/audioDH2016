<?php include('header.php') ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


	<section id="content" class="wrapper">
        <!-- <section class="page__header"><h2 class="title"><?php the_title(); ?></h2></section> -->
        <section class="body gr-12">
            <?php the_content(); ?>

        </section>
	</section>


<?php endwhile; ?>
<?php endif; ?>


<?php include('footer.php') ?>
