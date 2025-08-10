<div class="site-info">
    <div class="footer-copyright">
        <h3 class="footer-copyright-title">
            <p><?php echo wp_kses_post(get_theme_mod('footer-copyright', 'Copyrights TMT Innovative Solutions Co., ltd')) ?></p>
        </h3>
    </div>
    <div>
        <a href="<?php echo esc_url(__('https://wordpress.org/', 'mybasic-theme')); ?>">
            <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf(esc_html__('Proudly powered by %s', 'mybasic-theme'), 'WordPress');
            ?>
        </a>
    </div>
    <div>
        <?php
        /* translators: 1: Theme name, 2: Theme author. */
        printf(esc_html__('Theme: %1$s by %2$s.', 'mybasic-theme'), 'mybasic-theme', '<a href="https://maytinhdian.com/tnhalk">Lê Thanh Nhã</a>');
        ?>
    </div>
</div><!-- .site-info -->