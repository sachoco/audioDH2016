<?php include('header.php') ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


	<section id="content">
        <section class="page__header"><h2 class="title"><?php the_title(); ?></h2></section>
        <section class="page__body">
            <?php the_content(); ?>

        </section>
	</section>


<?php endwhile; ?>
<?php endif; ?>


<?php include('footer.php') ?>
