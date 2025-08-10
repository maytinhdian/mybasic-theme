  </main><!-- .site-main -->

  <footer class="site-footer">
    <div class="container">

      <?php
      if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
        get_template_part('template-parts/footer/footer', 'shop');
      } else {
        get_template_part('template-parts/footer/footer', 'main');
      }

      ?>

    </div>
  </footer>

  <?php wp_footer(); ?>
  </body>

  </html>