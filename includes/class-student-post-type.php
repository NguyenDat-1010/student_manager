<?php
/**
 * Class StudentPostType
 * Xử lý Custom Post Type cho Sinh viên
 */

if (!defined('ABSPATH')) {
    exit;
}

class StudentPostType {
    
    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
    }
    
    public function register_post_type() {
        $labels = array(
            'name'                  => 'Sinh viên',
            'singular_name'         => 'Sinh viên',
            'menu_name'             => 'Sinh viên',
            'name_admin_bar'        => 'Sinh viên',
            'archives'              => 'Danh sách sinh viên',
            'attributes'            => 'Thuộc tính sinh viên',
            'parent_item_colon'     => 'Sinh viên cha:',
            'all_items'             => 'Tất cả sinh viên',
            'add_new_item'          => 'Thêm sinh viên mới',
            'add_new'               => 'Thêm mới',
            'new_item'              => 'Sinh viên mới',
            'edit_item'             => 'Sửa sinh viên',
            'update_item'           => 'Cập nhật sinh viên',
            'view_item'             => 'Xem sinh viên',
            'view_items'            => 'Xem sinh viên',
            'search_items'          => 'Tìm kiếm sinh viên',
            'not_found'             => 'Không tìm thấy',
            'not_found_in_trash'    => 'Không tìm thấy trong thùng rác',
            'featured_image'        => 'Ảnh đại diện',
            'set_featured_image'    => 'Đặt ảnh đại diện',
            'remove_featured_image' => 'Xóa ảnh đại diện',
            'use_featured_image'    => 'Sử dụng làm ảnh đại diện',
            'insert_into_item'      => 'Chèn vào sinh viên',
            'uploaded_to_this_item' => 'Tải lên cho sinh viên này',
            'items_list'            => 'Danh sách sinh viên',
            'items_list_navigation' => 'Điều hướng danh sách sinh viên',
            'filter_items_list'     => 'Lọc danh sách sinh viên',
        );
        
        $args = array(
            'label'                 => 'Sinh viên',
            'description'           => 'Quản lý thông tin sinh viên',
            'labels'                => $labels,
            'supports'              => array('title', 'editor'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 20,
            'menu_icon'             => 'dashicons-groups',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        
        register_post_type('student', $args);
    }
}