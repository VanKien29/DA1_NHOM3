<?php
class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryQuery();
    }

    // ===== Danh sách danh mục =====
    public function listCategories()
    {
        $categories = $this->categoryModel->getAllCategories();
        require './views/Category/listCategory.php';
    }

    // ===== Tạo danh mục =====
    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            $category_name = trim($_POST['category_name'] ?? '');
            if (empty($_POST['category_name'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (strpbrk($_POST['category_name'], '0123456789') || strlen($_POST['category_name']) <= 10) {
                $err['name'] = "Tên phải trên 10 kí tự và không chứa số.";
            }
            if (empty($err)) {
                $this->categoryModel->category_name = $_POST['category_name'];
                if ($this->categoryModel->createCategory()) {
                    echo "<script>
                        alert('Thêm danh mục thành công!');
                        window.location.href='?action=admin-listCategory';
                    </script>";
                    exit;
                }
            }
        }
        require './views/Category/createCategory.php';
    }

    // ===== Cập nhật danh mục =====
    public function updateCategory($id)
    {
        $category = $this->categoryModel->findCategory($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            $category_name = trim($_POST['category_name'] ?? '');
            if (empty($_POST['category_name'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if (strpbrk($_POST['category_name'], '0123456789') || strlen($_POST['category_name']) <= 10) {
                $err['name'] = "Tên phải trên 10 kí tự và không chứa số.";
            }
            if (empty($err)) {
                $this->categoryModel->category_id = $id;
                $this->categoryModel->category_name = $_POST['category_name'];
                if ($this->categoryModel->updateCategory()) {
                    echo "<script>
                        alert('Sửa danh mục thành công!');
                        window.location.href='?action=admin-listCategory';
                    </script>";
                    exit;
                }
            }
        }
        require './views/Category/updateCategory.php';
    }

    // ===== Xóa danh mục =====
    public function deleteCategory($id)
    {
        if ($id) {
            $this->categoryModel->deleteCategory($id);
        }
        header("Location: ?action=admin-listCategory");
        exit;
    }
}

?>