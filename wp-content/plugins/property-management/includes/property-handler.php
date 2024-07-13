<?php
// Add property
function add_property() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['property_nonce']) && wp_verify_nonce($_POST['property_nonce'], 'property_action')) {
        global $wpdb;

        $name = sanitize_text_field($_POST['name']);
        $address = sanitize_textarea_field($_POST['address']);
        $city = sanitize_text_field($_POST['city']);
        $country = sanitize_text_field($_POST['country']);
        $pincode = sanitize_text_field($_POST['pincode']);
        $status = sanitize_text_field($_POST['status']);
        $user_id = get_current_user_id();

        $table_property = $wpdb->prefix . 'property';

        $wpdb->insert($table_property, [
            'name' => $name,
            'user_id' => $user_id,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'pincode' => $pincode,
            'status' => $status,
        ]);

        wp_redirect(home_url('/properties'));
        exit;
    }
}
add_action('init', 'add_property');

// Display properties
function display_properties() {
    global $wpdb;
    $table_property = $wpdb->prefix . 'property';
    $properties = $wpdb->get_results("SELECT * FROM $table_property");

    ob_start();
    ?>
    <div class="properties-list">
        <?php foreach ($properties as $property): ?>
            <div class="property">
                <h3><?php echo esc_html($property->name); ?></h3>
                <p><?php echo esc_html($property->address); ?></p>
                <p><?php echo esc_html($property->city); ?>, <?php echo esc_html($property->country); ?> - <?php echo esc_html($property->pincode); ?></p>
                <p>Status: <?php echo esc_html($property->status); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('display_properties', 'display_properties');
?>
