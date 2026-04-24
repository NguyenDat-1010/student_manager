<?php
/**
 * Plugin Name: Student Manager
 * Plugin URI: https://example.com/student-manager
 * Description: Plugin quản lý sinh viên với Custom Post Type và hiển thị danh sách qua shortcode
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: student-manager
 */

// Ngăn truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}

// Định nghĩa constants
define('STUDENT_MANAGER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('STUDENT_MANAGER_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Khởi tạo plugin
class StudentManager {
    
    public function __construct() {
        // Load file trước
        $this->load_includes();

        // Khởi tạo class luôn (QUAN TRỌNG)
        new StudentPostType();
        new StudentMetaBox();
        new StudentShortcode();

        // Load CSS
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        // Hook activate/deactivate
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    private function load_includes() {
        require_once STUDENT_MANAGER_PLUGIN_PATH . 'includes/class-student-post-type.php';
        require_once STUDENT_MANAGER_PLUGIN_PATH . 'includes/class-student-meta-box.php';
        require_once STUDENT_MANAGER_PLUGIN_PATH . 'includes/class-student-shortcode.php';
    }
    
    public function enqueue_scripts() {
        wp_enqueue_style('student-manager-style', STUDENT_MANAGER_PLUGIN_URL . 'assets/style.css', array(), '1.0.0');
    }
    
    public function activate() {
        flush_rewrite_rules();
    }
    
    public function deactivate() {
        flush_rewrite_rules();
    }
}

// Chạy plugin
new StudentManager();