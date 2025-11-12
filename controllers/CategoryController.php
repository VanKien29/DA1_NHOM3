<?php 
class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryQuery();
    }

    // ===== Danh sách danh mục =====
    public function listCategories() {
        $categories = $this->categoryModel->getAllCategories();
        require './views/Category/listCategory.php';
    }

    // ===== Tạo danh mục =====
    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoryModel->category_name = $_POST['category_name'];
            $this->categoryModel->createCategory();
            header("Location: ?action=admin-listCategory");
            exit;
        }
        require './views/Category/createCategory.php';
    }

    // ===== Cập nhật danh mục =====
    public function updateCategory($id) {
        $category = $this->categoryModel->findCategory($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoryModel->category_id = $id;
            $this->categoryModel->category_name = $_POST['category_name'];
            $this->categoryModel->updateCategory();
            header("Location: ?action=admin-listCategory");
            exit;
        }
        require './views/Category/updateCategory.php';
    }

    // ===== Xóa danh mục =====
    public function deleteCategory($id) {
        if ($id) {
            $this->categoryModel->deleteCategory($id);
        }
        header("Location: ?action=admin-listCategory");
        exit;
    }
}

?>