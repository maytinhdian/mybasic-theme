<form role="search" method="get" class="search-bar" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="search-input" placeholder="Tìm kiếm..." value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-button">
        <i class="fa fa-search"></i>
    </button>
</form>