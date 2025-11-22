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
            if (strlen($_POST['category_name']) <= 6) {
                $err['name'] = "Tên danh mục phải trên 6 kí tự.";
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
             if (strlen($_POST['category_name']) <= 6 || strpbrk($_POST['category_name'], '0123456789')) {
                $err['name'] = "Tên phải trên 6 kí tự và không chứa số.";
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
    public function deleteCategory($id){
        if ($id) {
            if($this->categoryModel->deleteCategory($id)) {
            echo "<script>
                    alert('Xóa danh mục thành công!');
                    window.location.href='?action=admin-listCategory';
            </script>";
            exit; 
            } else {
                echo "<script>
                    alert('Không thể xoá danh mục vì đang có tour thuộc danh mục này!');
                    window.location.href='?action=admin-listCategory';
            </script>";
                exit;
            }
        }
    }
}

?>