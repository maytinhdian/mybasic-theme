<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>

  <header class="site-header">
    <div class="container flex-row">
      <div class=" flex-row top-bar__wrapper">
        <?php get_template_part('template-parts/header/header', 'top', array()); ?>
      </div>

      <div class="site-header__branding">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__title">
            <?php bloginfo('name'); ?>
          </a>
        <?php endif; ?>
      </div>

      <nav class="site-nav" role="navigation" aria-label="<?php esc_attr_e('Main Menu', 'mybasic_theme'); ?>">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'site-nav__menu',
          'fallback_cb'    => false
        ));
        ?>
      </nav>
    </div>
  </header>