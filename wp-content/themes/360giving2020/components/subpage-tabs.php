<?php 
    // $children = get_children(array(
    //     "post_parent"=>get_the_ID(),
    //     "post_type"=>'page',
    //     "post_status"=>'publish'
    // )); 
?>
<?php if($children): ?>
<div class="spacer-5"></div>
<div class="tabs">
    <?php if($top_level_post == get_the_id()): ?>
    <span class="tab tab--active">
        <a class="tab__inner" href="<?php echo get_the_permalink($top_level_post); ?>">
            <?php echo get_the_title($top_level_post); ?>
        </a>
    </span>
    <?php else: ?>
    <span class="tab tab--inactive">
        <a class="tab__inner" href="<?php echo get_the_permalink($top_level_post); ?>">
            <?php echo get_the_title($top_level_post); ?>
        </a>
    </span>
    <?php endif; ?>
    <?php foreach( $children as $child ): ?>
    <?php if($child->ID == get_the_id()): ?>
    <span class="tab tab--active">
        <a class="tab__inner"
            href="<?php echo get_the_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a>
    </span>
    <?php else: ?>
    <span class="tab tab--inactive">
        <a class="tab__inner"
            href="<?php echo get_the_permalink($child->ID); ?>"><?php echo get_the_title($child->ID); ?></a>
    </span>
    <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>