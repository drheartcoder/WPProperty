<?php
// Handle user registration
function handle_user_registration() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_nonce']) && wp_verify_nonce($_POST['register_nonce'], 'register_action')) {
        global $wpdb;

        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $password = wp_hash_password($_POST['password']);

        $table_users = $wpdb->prefix . 'users_custom';

        $wpdb->insert($table_users, [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
        ]);

        wp_redirect(home_url('/login'));
        exit;
    }
}
add_action('init', 'handle_user_registration');

// Handle user login
function handle_user_login() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_nonce']) && wp_verify_nonce($_POST['login_nonce'], 'login_action')) {
        global $wpdb;

        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        $table_users = $wpdb->prefix . 'users_custom';
        $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_users WHERE email = %s", $email));

        if ($user && wp_check_password($password, $user->password, $user->user_id)) {
            wp_set_current_user($user->user_id);
            wp_set_auth_cookie($user->user_id);
            wp_redirect(home_url('/properties'));
            exit;
        } else {
            wp_redirect(home_url('/login?error=invalid_credentials'));
            exit;
        }
    }
}
add_action('init', 'handle_user_login');
?>
