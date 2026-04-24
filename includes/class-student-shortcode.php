<?php
/**
 * Class StudentShortcode
 * Xử lý Shortcode hiển thị danh sách sinh viên
 */

if (!defined('ABSPATH')) {
    exit;
}

class StudentShortcode {
    
    public function __construct() {
        add_shortcode('danh_sach_sinh_vien', array($this, 'display_students_list'));
    }
    
    public function display_students_list($atts) {
        // Thiết lập thuộc tính mặc định
        $atts = shortcode_atts(array(
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ), $atts, 'danh_sach_sinh_vien');
        
        // Query để lấy danh sách sinh viên
        $args = array(
            'post_type' => 'student',
            'post_status' => 'publish',
            'posts_per_page' => intval($atts['posts_per_page']),
            'orderby' => sanitize_text_field($atts['orderby']),
            'order' => sanitize_text_field($atts['order']),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => '_student_mssv',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => '_student_mssv',
                    'compare' => 'NOT EXISTS'
                )
            )
        );
        
        $students_query = new WP_Query($args);
        
        if (!$students_query->have_posts()) {
            return '<p class="student-no-data">Chưa có sinh viên nào được thêm vào hệ thống.</p>';
        }
        
        // Bắt đầu output buffering
        ob_start();
        ?>
        
        <div class="student-manager-wrapper">
            <h3 class="student-list-title">Danh sách sinh viên</h3>
            
            <div class="student-table-wrapper">
                <table class="student-table">
                    <thead>
                        <tr>
                            <th class="student-stt">STT</th>
                            <th class="student-mssv">MSSV</th>
                            <th class="student-name">Họ tên</th>
                            <th class="student-class">Lớp</th>
                            <th class="student-birth-date">Ngày sinh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        while ($students_query->have_posts()) : 
                            $students_query->the_post();
                            
                            // Lấy meta data
                            $mssv = get_post_meta(get_the_ID(), '_student_mssv', true);
                            $class = get_post_meta(get_the_ID(), '_student_class', true);
                            $birth_date = get_post_meta(get_the_ID(), '_student_birth_date', true);
                            
                            // Chuyển đổi tên lớp
                            $class_names = array(
                                'cntt' => 'Công nghệ thông tin',
                                'kinh_te' => 'Kinh tế',
                                'marketing' => 'Marketing',
                                'ke_toan' => 'Kế toán',
                                'quan_tri' => 'Quản trị kinh doanh',
                                'ngoai_ngu' => 'Ngoại ngữ'
                            );
                            
                            $class_display = isset($class_names[$class]) ? $class_names[$class] : $class;
                            
                            // Format ngày sinh
                            $birth_date_display = '';
                            if ($birth_date) {
                                $date = DateTime::createFromFormat('Y-m-d', $birth_date);
                                if ($date) {
                                    $birth_date_display = $date->format('d/m/Y');
                                }
                            }
                        ?>
                        <tr>
                            <td class="student-stt"><?php echo $counter; ?></td>
                            <td class="student-mssv"><?php echo esc_html($mssv ? $mssv : 'Chưa có'); ?></td>
                            <td class="student-name"><?php echo esc_html(get_the_title()); ?></td>
                            <td class="student-class"><?php echo esc_html($class_display ? $class_display : 'Chưa có'); ?></td>
                            <td class="student-birth-date"><?php echo esc_html($birth_date_display ? $birth_date_display : 'Chưa có'); ?></td>
                        </tr>
                        <?php 
                        $counter++;
                        endwhile; 
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="student-summary">
                <p><strong>Tổng số sinh viên: <?php echo $students_query->found_posts; ?></strong></p>
            </div>
        </div>
        
        <?php
        
        // Reset post data
        wp_reset_postdata();
        
        // Trả về nội dung
        return ob_get_clean();
    }
}