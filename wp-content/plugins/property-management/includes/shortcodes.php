<?php
// Registration form shortcode
function registration_form_shortcode() {
    ob_start();
    ?>
    <form method="POST">
        <?php wp_nonce_field('register_action', 'register_nonce'); ?>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('registration_form', 'registration_form_shortcode');

// Login form shortcode
function login_form_shortcode() {
    ob_start();
    ?>
    <form method="POST">
        <?php wp_nonce_field('login_action', 'login_nonce'); ?>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('login_form', 'login_form_shortcode');
?>
