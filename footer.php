        <section class="footer clear">
            <nav class="nav" role="navigation">
                <?php wp_nav_menu(array(
                    'container' => false,                           // remove nav container
                    'container_class' => 'menu cf',                 // class of container (should you choose to use it)
                    'menu' => __( 'Main Menu', 'iii' ),  // nav name
                    'menu_class' => 'nav',               // adding custom nav class
                    'theme_location' => 'main-menu',                 // where it's located in the theme
                    'before' => '',                                 // before the menu
                    'after' => '',                                  // after the menu
                    'link_before' => '',                            // before each link
                    'link_after' => '',                             // after each link
                    'depth' => 2,                                   // limit the depth of the nav
                    'fallback_cb' => ''                             // fallback function (if there is one)
                )); ?>

<!--                 <div class="mobile-menu"><i class="fa fa-bars fa-2x fa-border"></i></div>
 -->            </nav>
        </section>
    <?php wp_footer(); ?>

  </body>

</html>

