<?php
/*
Plugin Name: Property CSS
Description: Adds Property CSS to the site.
Version: 1.0
Author: Deepak Salunke
*/

function property_css() {
    echo '<style>
    .property {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        background-color: #f8f9fa;
    }
    .property h3 {
        margin-top: 0;
        margin-bottom: 0.75rem;
    }
    .property p {
        margin: 0.25rem 0;
    }
    </style>';
}
add_action('wp_head', 'property_css');
