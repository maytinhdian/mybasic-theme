<?php
// Mở shell + head
?>
<div class="tmt-archive">
  <div class="tmt-archive__head container">
    <?php if (function_exists('woocommerce_breadcrumb')): ?>
      <nav class="tmt-breadcrumb" aria-label="breadcrumb">
        <?php woocommerce_breadcrumb([
          'wrap_before' => '',
          'wrap_after'  => '',
        ]); ?>
      </nav>
    <?php endif; ?>

    <header class="tmt-archive__titlebar">
      <h1 class="tmt-archive__title"><?php woocommerce_page_title(); ?></h1>
      <div class="tmt-archive__tools">
        <?php if (function_exists('woocommerce_result_count')) woocommerce_result_count(); ?>
        <form class="woocommerce-ordering" method="get">
          <?php if (function_exists('woocommerce_catalog_ordering')) woocommerce_catalog_ordering(); ?>
        </form>
      </div>

      <div class="tmt-archive__desc">
        <?php do_action('woocommerce_archive_description'); ?>
      </div>
    </header>
  </div>
