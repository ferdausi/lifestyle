
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
    <div class="input-field">
        <input placeholder="Search" class="form-control" id="blog-search" type="text" value="<?php esc_attr( get_search_query() ) ?>"
               name="s"/>
        <button class="search-submit" type="submit"><i class="fa fa-search"></i></button>
        <input type="hidden" value="post" name="post_type"/>
    </div>

</form>

