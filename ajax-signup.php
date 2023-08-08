<?php
require_once('../../../wp-config.php');
global $wpdb;
if( isset($_POST) && !empty($_POST) ) {    
    $data = array_map( 'trim',$_POST );
    $fullName = explode(" ", $_POST['name']);
    $last_name = array();
    $i = 0;
    foreach ( $fullName as $name ) :
        if($i==0) :
            $first_name = $name;
        else :
            $last_name[] = $name;
        endif; //endif condition.
        $i++;
    endforeach; // end foreach loop.
    $last_name = implode(" ", $last_name);
    $first_user = mt_rand(7, 7131);
    $last_user     = mt_rand(3, 2648);
    $user_name = $first_user.''.$last_user;
    $user_id = username_exists( $user_name );
     if( empty($user_id) ) {
        $user_email = email_exists( $data['user_email'] ); 
         if( $user_email == false ) { 
                $user_id = wp_create_user( $user_name, $data['user_password'], $data['user_email'] );
                wp_update_user( array( 'ID' => $user_id, 'first_name' => $first_name ) );
                wp_update_user( array( 'ID' => $user_id, 'last_name' => $last_name ) );
                if( !empty($user_id) ) {
                    $user = new WP_User( $user_id );
                    $userRole = get_user_by( 'id', $user_id );
                    $user->set_role( 'author' );
                    wp_new_user_notification( $user_id, $data['user_password'] );
                    $logindata = array();
                    $logindata['user_login']       = $user_name;
                    $logindata['user_password']    = $data['user_password'];
                    $logindata['remember']             = true;
                    $user_verify = wp_signon( $logindata, false ); 
                    if( !is_wp_error( $user_verify ) ) {
                        $message = true;
                        wp_mail( $data['user_email'],'Confirm of registration', 'Welcome! You have registered successfully..' );
                    } else {
                        $message = strip_tags($user_verify->get_error_message());
                    }
                } else {
                    $message = 'Unable to create new user, please try again';
                }
        } else {
            $message = '<b>'.$data['user_email'].'</b> is already exists, please enter another email id.';
        }
    } else {
        $message = '<b>"'.$data['user_name'].'"</b> username already exists, please try another username.';
    }
    echo $message;
}