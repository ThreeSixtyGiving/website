<?php

function tsg_kicker_blurb_metabox()
{
    add_meta_box(
        'tsg_kicker_blurb_box',       // Unique ID
        'Kicker and Blurb',           // Box title
        'tsg_kicker_blurb_box_html',  // Content callback, must be of type callable
        'page',                       // Post type
        'side',
        'normal',
        array(
            '__block_editor_compatible_meta_box' => true,
        )
    );
}
add_action('add_meta_boxes', 'tsg_kicker_blurb_metabox');

function tsg_kicker_blurb_box_html($post)
{
    $tsg_page_kicker = get_post_meta($post->ID, 'tsg_page_kicker', true);
    $tsg_page_blurb  = get_post_meta($post->ID, 'tsg_page_blurb',  true);
    ?>
    <p class="post-attributes-label-wrapper">
        <label for="tsg_page_kicker">Page kicker</label>
    </p>
    <input name="tsg_page_kicker" id="tsg_page_kicker" class="postbox" type='text' value="<?php echo $tsg_page_kicker; ?>" />
    <p class="post-attributes-label-wrapper">
        <label for="tsg_page_blurb">Page blurb</label>
    </p>
    <input name="tsg_page_blurb" id="tsg_page_blurb" class="postbox" type='text' value="<?php echo $tsg_page_blurb; ?>" />
    <?php
}

function tsg_kicker_blurb_save_postdata($post_id)
{
    if (array_key_exists('tsg_page_kicker', $_POST)) {
        update_post_meta(
            $post_id,
            'tsg_page_kicker',
            $_POST['tsg_page_kicker']
        );
    }
    if (array_key_exists('tsg_page_blurb', $_POST)) {
        update_post_meta(
            $post_id,
            'tsg_page_blurb',
            $_POST['tsg_page_blurb']
        );
    }
}
add_action('save_post', 'tsg_kicker_blurb_save_postdata');