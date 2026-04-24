# Hướng dẫn cài đặt và sử dụng Student Manager Plugin

## 1. Cài đặt Plugin

### Cách 1: Upload qua WordPress Admin
1. Nén thư mục `student-manager` thành file `student-manager.zip`
2. Đăng nhập WordPress Admin
3. Vào **Plugins > Add New > Upload Plugin**
4. Chọn file `student-manager.zip` và click **Install Now**
5. Click **Activate Plugin**

### Cách 2: Upload qua FTP
1. Upload thư mục `student-manager` vào `/wp-content/plugins/`
2. Đăng nhập WordPress Admin
3. Vào **Plugins** và kích hoạt "Student Manager"

## 2. Sử dụng Plugin

### A. Thêm sinh viên mới

1. **Truy cập menu Sinh viên**
   - Sau khi kích hoạt plugin, bạn sẽ thấy menu "Sinh viên" trong WordPress Admin
   - Click vào **Sinh viên > Thêm mới**

2. **Nhập thông tin cơ bản**
   - **Tiêu đề**: Nhập họ tên đầy đủ của sinh viên
   - **Nội dung**: Thêm tiểu sử, ghi chú về sinh viên (tùy chọn)

3. **Điền thông tin trong Meta Box "Thông tin sinh viên"**
   - **Mã số sinh viên (MSSV)**: Nhập mã số duy nhất (ví dụ: SV001, 2021001)
   - **Lớp/Chuyên ngành**: Chọn từ dropdown:
     - Công nghệ thông tin
     - Kinh tế  
     - Marketing
     - Kế toán
     - Quản trị kinh doanh
     - Ngoại ngữ
   - **Ngày sinh**: Chọn ngày sinh từ date picker

4. **Xuất bản**
   - Click **Xuất bản** để lưu thông tin sinh viên

### B. Quản lý danh sách sinh viên

1. **Xem tất cả sinh viên**
   - Vào **Sinh viên > Tất cả sinh viên**
   - Xem danh sách với các cột: Tiêu đề, Tác giả, Ngày tạo

2. **Chỉnh sửa sinh viên**
   - Click vào tên sinh viên để chỉnh sửa
   - Hoặc hover và click **Chỉnh sửa**

3. **Xóa sinh viên**
   - Hover vào sinh viên và click **Xóa**
   - Hoặc sử dụng Bulk Actions để xóa nhiều sinh viên

### C. Hiển thị danh sách trên Frontend

1. **Sử dụng Shortcode cơ bản**
   ```
   [danh_sach_sinh_vien]
   ```
   - Thêm shortcode này vào bất kỳ Page hoặc Post nào
   - Sẽ hiển thị tất cả sinh viên theo thứ tự tên A-Z

2. **Shortcode với tùy chọn**
   ```
   [danh_sach_sinh_vien posts_per_page="10" orderby="date" order="DESC"]
   ```
   
   **Các tham số:**
   - `posts_per_page`: Số lượng sinh viên hiển thị
     - `-1`: Hiển thị tất cả
     - `10`: Hiển thị 10 sinh viên
   - `orderby`: Sắp xếp theo
     - `title`: Theo tên (mặc định)
     - `date`: Theo ngày tạo
     - `menu_order`: Theo thứ tự tùy chỉnh
   - `order`: Thứ tự
     - `ASC`: Tăng dần (mặc định)
     - `DESC`: Giảm dần

3. **Ví dụ sử dụng**
   ```
   [danh_sach_sinh_vien posts_per_page="20" orderby="title" order="ASC"]
   ```

## 3. Tùy chỉnh giao diện

### CSS Classes có sẵn
Plugin cung cấp các CSS classes để tùy chỉnh:

```css
.student-manager-wrapper    /* Container chính */
.student-list-title        /* Tiêu đề danh sách */
.student-table            /* Bảng chính */
.student-table thead      /* Header bảng */
.student-table tbody      /* Body bảng */
.student-stt             /* Cột STT */
.student-mssv            /* Cột MSSV */
.student-name            /* Cột Họ tên */
.student-class           /* Cột Lớp */
.student-birth-date      /* Cột Ngày sinh */
.student-summary         /* Phần tổng kết */
.student-no-data         /* Thông báo không có dữ liệu */
```

### Tùy chỉnh trong theme
Thêm CSS vào file `style.css` của theme:

```css
/* Tùy chỉnh màu header */
.student-table thead {
    background-color: #your-color !important;
}

/* Tùy chỉnh font chữ */
.student-table {
    font-family: 'Your Font', sans-serif;
}
```

## 4. Xử lý sự cố

### Plugin không hiển thị menu
- Kiểm tra plugin đã được kích hoạt
- Đảm bảo user có quyền quản trị
- Thử deactivate và activate lại plugin

### Shortcode không hoạt động
- Kiểm tra chính tả shortcode: `[danh_sach_sinh_vien]`
- Đảm bảo đã có sinh viên được tạo và xuất bản
- Kiểm tra theme có hỗ trợ shortcode

### Dữ liệu không lưu
- Kiểm tra quyền ghi file của server
- Đảm bảo không có plugin conflict
- Kiểm tra PHP error logs

### CSS không load
- Kiểm tra đường dẫn file CSS
- Clear cache nếu sử dụng caching plugin
- Kiểm tra theme có override CSS

## 5. Backup và Restore

### Backup dữ liệu
- Sử dụng WordPress export tool
- Hoặc backup database tables: `wp_posts`, `wp_postmeta`

### Restore dữ liệu
- Import WordPress XML file
- Hoặc restore database từ backup

## 6. Gỡ cài đặt

### Gỡ cài đặt an toàn
1. Backup dữ liệu trước khi gỡ
2. Deactivate plugin
3. Delete plugin từ WordPress Admin

**Lưu ý**: Plugin sẽ tự động xóa tất cả dữ liệu sinh viên khi gỡ cài đặt hoàn toàn.

## 7. Hỗ trợ

Nếu gặp vấn đề, hãy kiểm tra:
1. WordPress version compatibility
2. PHP version (khuyến nghị 7.4+)
3. Plugin conflicts
4. Theme compatibility
5. Server permissions