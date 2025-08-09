<?php get_header(); ?>

<main class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_title('<h2>', '</h2>');
            the_content();
        endwhile;
    else :
        echo '<p>No content found.</p>';
    endif;

    ?>
  
    <i class="fa-solid fa-user"></i>
    <h1 id="test" class="test">Test font size</h1>
    <!-- <div id="test" style="font-size: clamp(1.5rem, 1.5rem + 1.5 * (100vw - 320px) / 880, 3rem);">Hello</div> -->

    
    <?php get_footer(); ?>