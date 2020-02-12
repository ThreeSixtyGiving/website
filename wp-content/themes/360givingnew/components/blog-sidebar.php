<?php
    $obj = get_queried_object();
    $categories = get_categories( array(
        // 'orderby' => 'name',
        // 'order'   => 'ASC'
    ) );
?>
<aside class="layout__sidebar">

    <div class="sidebar-section sidebar-section--orange">
        <div class="layout__content-inner">
            <div class="sidebar-setcion__item">
                <div class="sidebar-blog">
                    <h2 class="sidebar-blog__heading">Categories</h2>
                    <ul class="sidebar-blog__content categories-list">
                        <?php foreach( $categories as $category ): ?>
                        <li class="categories-list__item">
                            <?php if($obj->term_id == $category->term_id): ?>
                            <a class="category category--active" href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
                            <?php else: ?>
                            <a class="category" href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>


            </div>
        </div>
    </div>

</aside>