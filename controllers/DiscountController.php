<?php
class DiscountController {
    private $discountModel;
    private $tourModel;

    public function __construct() {
        $this->discountModel = new DiscountQuery();
        $this->tourModel = new ToursQuery();
    }

    public function listDiscounts() {
        $discounts = $this->discountModel->getAllDiscounts();
        require './views/Discount/listDiscount.php';
    }

    public function createDiscount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->discountModel->code = $_POST['code'];
            $this->discountModel->description = $_POST['description'];
            $this->discountModel->discount_type = $_POST['discount_type'];
            $this->discountModel->value = $_POST['value'];
            $this->discountModel->start_date = $_POST['start_date'];
            $this->discountModel->end_date = $_POST['end_date'];
            $this->discountModel->tour_id = $_POST['tour_id'];
            $this->discountModel->status = $_POST['status'];
            $this->discountModel->createDiscount();
            header("Location: ?action=admin-listDiscount");
            exit;
        }
        $tours = $this->tourModel->getAllTours();
        require './views/Discount/createDiscount.php';
    }

    public function updateDiscount() {
        $id = $_GET['id'] ?? null;
        $discount = $this->discountModel->findDiscount($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->discountModel->code = $_POST['code'];
            $this->discountModel->description = $_POST['description'];
            $this->discountModel->discount_type = $_POST['discount_type'];
            $this->discountModel->value = $_POST['value'];
            $this->discountModel->start_date = $_POST['start_date'];
            $this->discountModel->end_date = $_POST['end_date'];
            $this->discountModel->tour_id = $_POST['tour_id'];
            $this->discountModel->status = $_POST['status'];
            $this->discountModel->updateDiscount($id);
            header("Location: ?action=admin-listDiscount");
            exit;
        }

        $tours = $this->tourModel->getAllTours();
        require './views/Discount/updateDiscount.php';
    }

    public function deleteDiscount() {
        $id = $_GET['id'] ?? null;
        if ($id) $this->discountModel->deleteDiscount($id);
        header("Location: ?action=admin-listDiscount");
        exit;
    }
}
?>