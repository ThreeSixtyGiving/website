<?php
    $obj = get_queried_object();
    $sidebars = array();

    $cats = get_categories( array(
        "orderby"=>"post_count",
        "order"=>"DESC",
    ) );
    foreach($cats as $category){
        if(!$category->parent){
            $categories = array(
                "url"=>get_category_link( $category->term_id ),
                "title"=>$category->name,
                "categories"=>array()
            );
            foreach($cats as $subcat){
                if($subcat->parent == $category->term_id){
                    $categories["categories"][] = array(
                        "url"=>get_category_link( $subcat->term_id ),
                        "title"=>$subcat->name,
                        "active"=>($subcat->term_id == $obj->term_id),
                    );
                }
            }
            $sidebars[] = $categories;
        }
    }

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

    <div class="sidebar-section sidebar-section--orange">
        <div class="layout__content-inner">
            <div class="sidebar-setcion__item">
                <div class="sidebar-blog">
                    <?php foreach( $sidebars as $sidebar ): ?>
                    <h2 class="sidebar-blog__heading">
                        <a href="<?php echo $sidebar['url']; ?>"><?php echo $sidebar["title"]; ?></a>
                    </h2>
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
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</aside>