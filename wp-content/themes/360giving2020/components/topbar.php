<?php 

$tb_menu_name = 'top-bar-menu';
$tb_menu_items = array();
$oc_menu_name = 'off-canvas-menu';
$oc_menu_items = array();
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $tb_menu_name ] ) ) {
    $tb_menu = wp_get_nav_menu_object( $locations[ $tb_menu_name ] );
    $tb_menu_items = wp_get_nav_menu_items($tb_menu->term_id);
}
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $oc_menu_name ] ) ) {
    $oc_menu = wp_get_nav_menu_object( $locations[ $oc_menu_name ] );
    $oc_menu_items = wp_get_nav_menu_items($oc_menu->term_id);
}
?>

<div class="top-bar">
    <button class="top-bar__menu-trigger"><i class="material-icons">menu</i></button>

    <nav class="top-bar__menu contextual-menu">
        <ul>
        <?php foreach ( (array) $tb_menu_items as $key => $menu_item ): ?>
            <?php if($menu_item->menu_item_parent == 0): ?>
            <li class="contextual-menu__item submenu">
                <a href="<?php echo $menu_item->url; ?>" class="contextual-menu__button"><?php echo $menu_item->title; ?></a>
                <ul class="submenu__list">
                <?php foreach ( (array) $tb_menu_items as $jey => $menu_item_child ): ?>
                    <?php if($menu_item->ID == $menu_item_child->menu_item_parent): ?>
                    <li class="submenu__item">
                        <a href="<?php echo $menu_item_child->url; ?>" class="submenu__button"><?php echo $menu_item_child->title; ?></a>
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </nav>

        <div class="off-canvas-menu" <?php if ( is_admin_bar_showing() ): ?>style="top: 32px;"<?php endif; ?> aria-hidden>
        <button class="off-canvas-menu__trigger"><i class="material-icons">close</i></button>
        <nav>
            <ul class="off-canvas-menu__list">
                <?php foreach ( (array) $oc_menu_items as $key => $menu_item ): ?>
                <?php if($menu_item->menu_item_parent == 0): ?>
                <li class="off-canvas-menu__item">
                    <a href="<?php echo $menu_item->url; ?>"><strong><?php echo $menu_item->title; ?></strong></a>
                    <p><?php echo $menu_item->description; ?></p>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>