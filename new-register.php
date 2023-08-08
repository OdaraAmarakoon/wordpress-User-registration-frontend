 <?php
      /* Template Name: Custom Registration Page */
      ?>

<?php
if (isset($_POST['signup'])) {
  require_once(ABSPATH . 'wp-load.php');

  // Sanitize and retrieve the submitted form data
  $user_login = sanitize_user($_POST['username']);
  $user_email = sanitize_email($_POST['email']);
  $user_pass = $_POST['password'];
  $first_name = sanitize_text_field($_POST['first_name']);
  $last_name = sanitize_text_field($_POST['last_name']);
  $user_role = $_POST['user_role'];

  // Create a new user data array
  $user_data = array(
    'user_login' => $user_login,
    'user_email' => $user_email,
    'user_pass' => $user_pass,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'role' => $user_role,
  );

  // Insert the user into the database
  $user_id = wp_insert_user($user_data);

  // Check if the user creation was successful
  if (!is_wp_error($user_id)) {
    echo "User registered successfully!";
  } else {
    echo "User registration failed. Please try again.";
  }
}
?>

<?php get_header();
?>



<section class="section-signin">
  <div class="container" >
    <form name="" action="" method="post" class="row g-3 needs-validation" novalidate>
      <div class="col-lg-6 ">
        <label for="validationTooltip01" class="form-label">First name</label>
        <input type="text" class="form-control" id="validationTooltip01" name="first_name" value="" required>
        
      </div>

      <div class="col-lg-6 ">
        <label for="validationTooltip02" class="form-label">Last name</label>
        <input type="text" class="form-control" id="validationTooltip02" name="last_name" value="" required>
        <div class="valid-tooltip">
          Looks good!
        </div>
      </div>

      <div class="col-lg-6 position-relative">
        <label for="validationTooltip03" class="form-label">Email</label>
        <input type="email" class="form-control" id="validationTooltip03" name="email" required data-bs-toggle="tooltip" data-bs-placement="top" />
        <div class="invalid-tooltip">
          Please provide a valid email.
        </div>
      </div>

      <div>
        <label for="pwdId" class="form-label">Password</label>
        <input type="text" id="pwdId" class="form-control" pattern="^[a-z]{2,6}$" name="password" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">a to z only (2 to 6 long)</div>
      </div>

      <div >
        <label for="validationTooltipUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
          <input type="text" class="form-control" id="validationTooltipUsername" name="username" aria-describedby="validationTooltipUsernamePrepend" required data-bs-toggle="tooltip" data-bs-placement="top">
          <div class="invalid-tooltip">
            Please choose a unique and valid username.
          </div>
        </div>
      </div>

      <div >
        <label for="user_role">User Role:</label>
        <select name="user_role" required>
          <option selected disabled value="">- No user role selected yet -</option>
          <option value="subscriber">Subscriber</option>
          <option value="contributor">Contributor</option>
          <option value="author">Author</option>
          <option value="editor">Editor</option>
          <option value="administrator">Administrator</option>
        </select>
      </div>

      <div class="col-12">
        <input type="submit" name="signup" value="Signup" class="btn btn-primary" />
      </div>
    </form>
  </div>
</section>

<?php get_footer(); ?>