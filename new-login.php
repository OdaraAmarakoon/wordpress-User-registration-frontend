<?php 
/* 
Template Name: Login page
*/ 
?>
<?php get_header();


if($_POST) 
{  
   
    global $wpdb;  
   
    //We shall SQL escape all inputs  
    $username = $wpdb->escape($_REQUEST['username']);  
    $password = $wpdb->escape($_REQUEST['password']);  
   
    
   
    $login_data = array();  
    $login_data['user_login'] = $username;  
    $login_data['user_password'] = $password;  
   
    $user_verify = wp_signon( $login_data, false );   
   
    if ( is_wp_error($user_verify) )   
    {  
        echo "Invalid login details";  
       // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.  
     } else
    {    
        echo "valid login details";  
       exit();  
     }  
   
} else 
{
    // No login details entered - you should probably add some more user feedback here, but this does the bare minimum  
   
    //echo "Invalid login details";  
   
}  
 ?>  
<section>
    <div class="container">
        <form id="login1" name="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">     
            <input id="username" type="text" placeholder="Username" name="username"><br>  
            <input id="password" type="password" placeholder="Password" name="password">  
            <input id="submit" type="submit" name="submit" value="Submit">  
        </form> 
    </div>
</section>
   
<?php get_footer(); ?> 