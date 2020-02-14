<?php
    $obj = get_queried_object();
    $sidebars = array();

    $categories = array(
        "title"=>"Categories",
        "categories"=>array()
    );
    $cats = get_categories( array(
        "orderby"=>"post_count",
        "order"=>"DESC",
    ) );
    foreach($cats as $category){
        $categories["categories"][] = array(
            "url"=>get_category_link( $category->term_id ),
            "title"=>$category->name,
            "active"=>($category->term_id == $obj->term_id),
        );
    }
    $sidebars[] = $categories;

    if(is_author()){
        $categories = array();
        $users = get_users(array(
            "orderby"=>"post_count",
            "order"=>"DESC",
            'count_total'  => true,
            'has_published_posts' => array('post'),
            'number'=>20,
        ));
        foreach($users as $user){
            $categories[] = array(
                "url"=>get_author_posts_url($user->ID),
                "title"=>$user->display_name,
                "active"=>($user->ID == $obj->ID),
            );
        }
        $sidebars[] = array(
            "title"=>"Authors",
            "categories"=>$categories
        );
    }
?>
<aside class="layout__sidebar">

    <?php foreach( $sidebars as $sidebar ): ?>
    <div class="sidebar-section sidebar-section--orange">
        <div class="layout__content-inner">
            <div class="sidebar-setcion__item">
                <div class="sidebar-blog">
                    <h2 class="sidebar-blog__heading"><?php echo $sidebar["title"]; ?></h2>
                    <ul class="sidebar-blog__content categories-list">
                        <?php foreach( $sidebar["categories"] as $category ): ?>
                        <li class="categories-list__item">
                            <?php if($category['active']): ?>
                            <a class="category category--active" href="<?php echo $category['url']; ?>"><?php echo $category['title']; ?></a>
                            <?php else: ?>
                            <a class="category" href="<?php echo $category['url']; ?>"><?php echo $category['title']; ?></a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</aside>