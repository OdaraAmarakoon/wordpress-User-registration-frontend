<?php
      /* Template Name: Ajex Registration form Page */
?>

<div class="container" >
    <form method="post" id="myform">
        <div class="form-group">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="validationTooltip02" name="last_name" value="" required>
        </div>
        <div class="form-group">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="validationTooltip02" name="last_name" value="" required>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="validationTooltip02" name="last_name" value="" required>
        </div>
        <div class="form-group">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" id="validationTooltip02" name="last_name" value="" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" id="validationTooltip02" name="last_name" value="" required>
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

<script>
    jQuery(function () {
        jQuery('$myform').submit(function (event) {
            event.preventDefault()

            jQuery.ajax({
                dataType: "json",
                type: "POST",
                data: jQuery("$myform").serialize(),
                url: "../admin-ajex.php",
                success: function   (data) {
                    alert('Form Success');
                }
            });
        });
    });
</script>