<?php
get_header();
while (have_posts()) : the_post();
    the_content(); // BẮT BUỘC có dòng này
endwhile;
get_footer();
