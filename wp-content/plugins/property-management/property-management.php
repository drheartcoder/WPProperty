<?php
/*
Plugin Name: Property Management
Description: A plugin to manage user registration, login, and property details.
Version: 1.0
Author: Deepak Salunke
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Create custom tables on plugin activation
register_activation_hook(__FILE__, 'create_custom_tables');

function create_custom_tables() {
    global $wpdb;

    $table_users = $wpdb->prefix . 'users_custom';
    $table_property = $wpdb->prefix . 'property';
    $charset_collate = $wpdb->get_charset_collate();

    $sql_users = "CREATE TABLE $table_users (
        user_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        password VARCHAR(255) NOT NULL,
        verify_email TINYINT(1) DEFAULT 0,
        verify_phone TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (user_id)
    ) $charset_collate;";

    $sql_property = "CREATE TABLE $table_property (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        address TEXT NOT NULL,
        city VARCHAR(255) NOT NULL,
        country VARCHAR(255) NOT NULL,
        pincode VARCHAR(20) NOT NULL,
        status ENUM('buy', 'sell', 'rent') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        FOREIGN KEY (user_id) REFERENCES $table_users(user_id) ON DELETE CASCADE
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_users);
    dbDelta($sql_property);
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/form-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'includes/property-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/property-shortcodes.php';
?>
