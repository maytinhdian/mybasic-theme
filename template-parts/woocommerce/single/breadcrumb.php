<?php if (! defined('ABSPATH')) exit; ?>
<div class="tmt-sp__breadcrumb">
    <?php
    woocommerce_breadcrumb([
        'delimiter'   => ' / ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb" aria-label="breadcrumb">',
        'wrap_after'  => '</nav>',
    ]);
    ?>
</div>