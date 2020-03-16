<?php
/**
 * The field on the editing screens.
 *
 * @param $user WP_User user object
 */
function tsg_usermeta_form_field($user)
{
    ?>
    <h2>360Giving fields</h2>
    <table class="form-table">
        <tr>
            <th>
                <label for="jobtitle">Job title</label>
            </th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="jobtitle"
                       name="jobtitle"
                       value="<?= esc_attr(get_user_meta($user->ID, 'jobtitle', true)); ?>"
                       >
                <p class="description">
                    360Giving job title (for 360Giving staff only)
                </p>
            </td>
        </tr>
        <tr>
            <th>
                <label for="twitter">Twitter handle</label>
            </th>
            <td>
                <input type="text"
                       class="regular-text ltr"
                       id="twitter"
                       name="twitter"
                       value="<?= esc_attr(get_user_meta($user->ID, 'twitter', true)); ?>"
                       >
            </td>
        </tr>
    </table>
    <?php
}
 
/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function tsg_usermeta_form_field_update($user_id)
{
    // check that the current user have the capability to edit the $user_id
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
 
    // create/update user meta for the $user_id
    update_user_meta(
        $user_id,
        'twitter',
        $_POST['twitter']
    );
    update_user_meta(
        $user_id,
        'jobtitle',
        $_POST['jobtitle']
    );
}
 
// add the field to user's own profile editing screen
add_action(
    'edit_user_profile',
    'tsg_usermeta_form_field'
);
 
// add the field to user profile editing screen
add_action(
    'show_user_profile',
    'tsg_usermeta_form_field'
);
 
// add the save action to user's own profile editing screen update
add_action(
    'personal_options_update',
    'tsg_usermeta_form_field_update'
);
 
// add the save action to user profile editing screen update
add_action(
    'edit_user_profile_update',
    'tsg_usermeta_form_field_update'
);


function tsg_modify_user_table( $column ) {
    $column['jobtitle'] = '360Giving Job Title';
    return $column;
}
add_filter( 'manage_users_columns', 'tsg_modify_user_table' );

function tsg_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'jobtitle' :
            return get_the_author_meta( 'jobtitle', $user_id );
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'tsg_modify_user_table_row', 10, 3 );


function tsg_people_shortcode( $atts ){ 
    $users = get_users(array(
        'meta_key'     => 'jobtitle',
        'fields'       => 'all_with_meta',
    ));
    ob_start();
    ?>
        </section>
    </div>
    <section class="cards-section">
        <ul class="card-list">
            <?php foreach( (array) $users as $key => $user ): ?>
            <li class="card-list__item">
                <article class="media-card media-card--orange">
                    <div class="media-card__content">
                        <header class="media-card__header">
                            <h3 class="media-card__heading"><?php echo esc_html( $user->display_name ) ?></h3>
                            <span class="media-card__subtitle"><?php echo esc_html( $user->jobtitle ) ?></span>
                            <div class="media-card__links">
                                <a href="mailto:<?php echo esc_html( $user->user_email ) ?>" class="media-card__link email"><svg xmlns="http://www.w3.org/2000/svg"
                                        height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                        <path
                                            d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z" />
                                        </svg></a>
                                <?php if ($user->has_prop('twitter')): ?>
                                <a href="https://twitter.com/<?php echo esc_html( str_replace('@', '', $user->twitter) ) ?>" class="media-card__link twitter"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="32.92" height="26.778" viewBox="0 0 32.92 26.778">
                                        <path
                                            d="M173.92,190.536a13.013,13.013,0,0,1-3.365,3.488c.428,9.546-6.547,20.132-19.214,20.132A18.327,18.327,0,0,1,141,211.1a13.229,13.229,0,0,0,9.974-2.754,6.882,6.882,0,0,1-6.3-4.712,6.261,6.261,0,0,0,3.06-.122,6.8,6.8,0,0,1-5.446-6.731,6.6,6.6,0,0,0,3.06.857,6.873,6.873,0,0,1-2.08-9.056,19.214,19.214,0,0,0,13.951,7.1,6.764,6.764,0,0,1,11.5-6.18,13.664,13.664,0,0,0,4.344-1.652,6.84,6.84,0,0,1-3,3.733A13.148,13.148,0,0,0,173.92,190.536Z"
                                            transform="translate(-141 -187.377)" /></svg></a>
                                <?php endif; ?>
                            </div>
                        </header>
                        <p><?php echo esc_html( $user->user_description ) ?></p>
                    </div>

                    <div class="media-card__image-wrapper">
                        <div class="media-card__image"
                            style="background-image: url(<?php echo esc_url(get_avatar_url($user->ID)); ?>)">
                        </div>
                    </div>

                </article>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <div class="prose">
        <section class="prose__section">
<?php 
    return ob_get_clean();
}
add_shortcode( 'people', 'tsg_people_shortcode' );