<?php
/*
Plugin Name: My Custom LearnDash Plugin
Description: A custom plugin to extend LearnDash functionality.
Version: 1.0
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include additional files or libraries if needed

// Hook into LearnDash actions or filters
add_action('init', 'my_custom_learndash_function');

function my_custom_learndash_function() {
    // Your custom code here
}

// Example: Add a custom shortcode
add_shortcode('my_custom_shortcode', 'my_custom_shortcode_function');

function my_custom_shortcode_function() {
    // Your shortcode logic here
    return '<p>This is a custom shortcode output.</p>';
}

// Example: Modify LearnDash course title
add_filter('learndash_course_title', 'my_custom_course_title', 10, 2);

function my_custom_course_title($title, $course_id) {
    // Custom logic to modify course title
    return $title . ' - Custom Suffix';
}

add_action('admin_menu', 'my_custom_plugin_menu');

function my_custom_plugin_menu() {
    add_menu_page(
        'My Custom Plugin Settings',
        'Custom Plugin',
        'manage_options',
        'my-custom-plugin-settings',
        'my_custom_plugin_settings_page'
    );
}

function my_custom_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1>My Custom Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my_custom_plugin_options_group');
            do_settings_sections('my-custom-plugin-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'my_custom_plugin_settings_init');

function my_custom_plugin_settings_init() {
    register_setting('my_custom_plugin_options_group', 'my_custom_plugin_option');
    add_settings_section(
        'my_custom_plugin_section',
        'Custom Settings',
        null,
        'my-custom-plugin-settings'
    );
    add_settings_field(
        'my_custom_plugin_field',
        'Custom Option',
        'my_custom_plugin_field_callback',
        'my-custom-plugin-settings',
        'my_custom_plugin_section'
    );
}

function my_custom_plugin_field_callback() {
    $value = get_option('my_custom_plugin_option', '');
    echo '<input type="text" name="my_custom_plugin_option" value="' . esc_attr($value) . '">';
}
