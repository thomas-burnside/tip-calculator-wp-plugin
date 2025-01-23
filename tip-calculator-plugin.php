<?php
/**
 * Plugin Name: TB #2 Tip Calculator 
 * Description: A simple tip calculator plugin for WordPress.
 * Version: 1.0.0
 * Author: Thomas Burnside
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue styles and scripts
function tip_calculator_enqueue_assets() {
    if (is_singular() && has_shortcode(get_post()->post_content, 'tip_calculator')) {
        wp_enqueue_style(
            'tip-calculator-style',
            plugin_dir_url(__FILE__) . 'assets/css/style.css'
        );

        wp_enqueue_script(
            'tip-calculator-script',
            plugin_dir_url(__FILE__) . 'assets/js/script.js',
            [],
            null,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'tip_calculator_enqueue_assets');

// Add shortcode for the tip calculator
function tip_calculator_shortcode() {
    ob_start();
    ?>
    <div class="tip-calculator">
    <div id="container"> 
        <h1>Tip Calculator</h1>
        <p>Enter the bill amount and tip percentage</p>
        <label for="bill">Bill amount:</label>
        <input type="number" id="bill">
        <br/>
        <label for="tip">Tip percentage</label>
        <input type="number" id="tip">
        <br/>
        <button id="calculate">Calculate</button>
        <br/>
        <label for="total">Total:</label>
        <span id="total"></span>
    </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('tip_calculator', 'tip_calculator_shortcode');
