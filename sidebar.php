<h2 class="sidebar__heading">Archives</h2>
<?php wp_get_archives(); ?>
<hr />
<h2 class="sidebar__heading">Categories</h2>
<?php 

$categories = get_categories();

foreach( $categories as $cat ){
    echo '<li><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name . '</a></li>';
}
?>
<hr />
