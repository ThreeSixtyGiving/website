<?php 
    // $children = get_children(array(
    //     "post_parent"=>get_the_ID(),
    //     "post_type"=>'page',
    //     "post_status"=>'publish'
    // )); 
?>
<?php if($children): ?>
<aside class="layout__sidebar">
    <div class="sidebar-section sidebar-section--orange">
        <div class="layout__content-inner">
            <div class="sidebar-setcion__item">
                <div class="sidebar-blog">
                    <h2 class="sidebar-blog__heading">
                        <a href="<?php echo get_the_permalink($top_level_post); ?>">
                            <?php echo get_the_title($top_level_post); ?>
                        </a>
                    </h2>
                    <ul class="sidebar-blog__content categories-list">
                        <?php foreach( $children as $child ): ?>
                        <li class="categories-list__item">
                            <?php if($child->ID == get_the_id()): ?>
                            <a class="category category--active" href="<?php echo get_the_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a>
                            <?php else: ?>
                            <a class="category" href="<?php echo get_the_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>
<?php endif; ?>