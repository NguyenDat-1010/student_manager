<?php
/**
 * Class StudentMetaBox
 * Xử lý Meta Box cho Custom Post Type Student
 */

if (!defined('ABSPATH')) {
    exit;
}

class StudentMetaBox {
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_box'));
    }
    
    public function add_meta_boxes() {
        add_meta_box(
            'student_info',
            'Thông tin sinh viên',
            array($this, 'meta_box_callback'),
            'student',
            'normal',
            'high'
        );
    }
    
    public function meta_box_callback($post) {
        // Thêm nonce field để bảo mật
        wp_nonce_field('student_meta_box_nonce', 'student_meta_box_nonce');
        
        // Lấy giá trị hiện tại
        $mssv = get_post_meta($post->ID, '_student_mssv', true);
        $class = get_post_meta($post->ID, '_student_class', true);
        $birth_date = get_post_meta($post->ID, '_student_birth_date', true);
        
        // Danh sách lớp/chuyên ngành
        $classes = array(
            '' => 'Chọn lớp/chuyên ngành',
            'cntt' => 'Công nghệ thông tin',
            'kinh_te' => 'Kinh tế',
            'marketing' => 'Marketing',
            'ke_toan' => 'Kế toán',
            'quan_tri' => 'Quản trị kinh doanh',
            'ngoai_ngu' => 'Ngoại ngữ'
        );
        ?>
        
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="student_mssv">Mã số sinh viên (MSSV)</label>
                </th>
                <td>
                    <input type="text" 
                           id="student_mssv" 
                           name="student_mssv" 
                           value="<?php echo esc_attr($mssv); ?>" 
                           class="regular-text" 
                           placeholder="Ví dụ: SV001" />
                    <p class="description">Nhập mã số sinh viên</p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="student_class">Lớp/Chuyên ngành</label>
                </th>
                <td>
                    <select id="student_class" name="student_class" class="regular-text">
                        <?php foreach ($classes as $value => $label) : ?>
                            <option value="<?php echo esc_attr($value); ?>" 
                                    <?php selected($class, $value); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="description">Chọn lớp hoặc chuyên ngành của sinh viên</p>
                </td>
            </tr>
            
            <tr>
                <th scope="row">
                    <label for="student_birth_date">Ngày sinh</label>
                </th>
                <td>
                    <input type="date" 
                           id="student_birth_date" 
                           name="student_birth_date" 
                           value="<?php echo esc_attr($birth_date); ?>" 
                           class="regular-text" />
                    <p class="description">Chọn ngày sinh của sinh viên</p>
                </td>
            </tr>
        </table>
        
        <?php
    }
    
    public function save_meta_box($post_id) {
        // Kiểm tra nonce để bảo mật
        if (!isset($_POST['student_meta_box_nonce']) || 
            !wp_verify_nonce($_POST['student_meta_box_nonce'], 'student_meta_box_nonce')) {
            return;
        }
        
        // Kiểm tra quyền chỉnh sửa
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Kiểm tra autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        // Kiểm tra post type
        if (get_post_type($post_id) !== 'student') {
            return;
        }
        
        // Sanitize và lưu dữ liệu
        if (isset($_POST['student_mssv'])) {
            $mssv = sanitize_text_field($_POST['student_mssv']);
            update_post_meta($post_id, '_student_mssv', $mssv);
        }
        
        if (isset($_POST['student_class'])) {
            $class = sanitize_text_field($_POST['student_class']);
            update_post_meta($post_id, '_student_class', $class);
        }
        
        if (isset($_POST['student_birth_date'])) {
            $birth_date = sanitize_text_field($_POST['student_birth_date']);
            update_post_meta($post_id, '_student_birth_date', $birth_date);
        }
    }
}