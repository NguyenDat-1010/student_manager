<?php
/**
 * Uninstall Student Manager Plugin
 * Xóa dữ liệu khi gỡ cài đặt plugin
 */

// Ngăn truy cập trực tiếp
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Xóa tất cả posts thuộc post type 'student'
$students = get_posts(array(
    'post_type' => 'student',
    'numberposts' => -1,
    'post_status' => 'any'
));

foreach ($students as $student) {
    // Xóa meta data
    delete_post_meta($student->ID, '_student_mssv');
    delete_post_meta($student->ID, '_student_class');
    delete_post_meta($student->ID, '_student_birth_date');
    
    // Xóa post
    wp_delete_post($student->ID, true);
}

// Xóa options nếu có
delete_option('student_manager_version');

// Flush rewrite rules
flush_rewrite_rules();