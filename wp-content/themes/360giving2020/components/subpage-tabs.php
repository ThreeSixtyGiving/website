<?php 
    // $children = get_children(array(
    //     "post_parent"=>get_the_ID(),
    //     "post_type"=>'page',
    //     "post_status"=>'publish'
    // )); 
?>
<?php if($children): ?>
<div class="spacer-5"></div>
<nav aria-label="Pages in this section">
    <ul class="tabs">
        <?php if($top_level_post == get_the_id()): ?>
        <li class="tab tab--active" aria-current="page">
            <a class="tab__inner" href="<?php echo get_the_permalink($top_level_post); ?>">
                <?php echo get_the_title($top_level_post); ?>
            </a>
        </li>
        <?php else: ?>
        <li class="tab tab--inactive">
            <a class="tab__inner" href="<?php echo get_the_permalink($top_level_post); ?>">
                <?php echo get_the_title($top_level_post); ?>
            </a>
        </li>
        <?php endif; ?>
        <?php foreach( $children as $child ): ?>
        <?php if($child->ID == get_the_id()): ?>
        <li class="tab tab--active" aria-current="page">
            <a class="tab__inner"
                href="<?php echo get_the_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a>
        </li>
        <?php else: ?>
        <li class="tab tab--inactive">
            <a class="tab__inner"
                href="<?php echo get_the_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
        <li class="tabs-empty-bar"></li>
    </ul>
</nav>
<?php endif; ?>