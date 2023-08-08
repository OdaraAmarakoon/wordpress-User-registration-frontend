<div class="login-from">
    <form autocomplete="off" method="post" id="signupForm" role="signupForm" novalidate="novalidate">
        <h3>SIGN UP FORM</h3>
        <div class="form-group">
            <label>Your Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Your Email ID</label>
            <input type="text" name="user_email" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="user_password" id="user_password" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="user_repassword" name="user_repassword">
        </div>
        <div class="checkbox form-group">
            <label><input type="checkbox" name="user_terms"><i>I agree to <a href="#">Terms of Service</a> and  <a href="#">Privacy Policy</a></i></label>
        </div>
        <div class="form-group">
            <button class="btn" type="submit">REGISTER</button>
            <label class="error-msg"></label>
        </div>
    </form>
</div>