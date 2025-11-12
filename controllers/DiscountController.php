<?php
class DiscountController
{
    private $discountModel;
    private $tourModel;

    public function __construct()
    {
        $this->discountModel = new DiscountQuery();
        $this->tourModel = new ToursQuery();
    }

    public function listDiscounts()
    {
        $discounts = $this->discountModel->getAllDiscounts();
        require './views/Discount/listDiscount.php';
    }

    public function createDiscount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['code']) || empty($_POST['start_date']) || empty($_POST['description']) || empty($_POST['discount_type']) || empty($_POST['end_date']) || empty($_POST['value']) || empty($_POST['tour_id']) || empty($_POST['status'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if ($_POST['start_date'] > $_POST['end_date']) {
                $err['date'] = "Ngày kết thúc phải sau ngày bắt đầu.";
            }
            if ($_POST['value'] > 0) {
                $err['value'] = "Giá trị phải là số dương.";
            }
            if (empty($err)) {
                $this->discountModel->code = $_POST['code'];
                $this->discountModel->description = $_POST['description'];
                $this->discountModel->discount_type = $_POST['discount_type'];
                $this->discountModel->value = $_POST['value'];
                $this->discountModel->start_date = $_POST['start_date'];
                $this->discountModel->end_date = $_POST['end_date'];
                $this->discountModel->tour_id = $_POST['tour_id'];
                $this->discountModel->status = $_POST['status'];
                if ($this->discountModel->createDiscount()) {
                    echo "<script>
                        alert('Thêm mã giảm giá thành công!');
                        window.location.href='?action=admin-listDiscount';
                    </script>";
                    exit;
                }
            }
        }
        $tours = $this->tourModel->getAllTours();
        require './views/Discount/createDiscount.php';
    }

    public function updateDiscount()
    {
        $id = $_GET['id'] ?? null;
        $discount = $this->discountModel->findDiscount($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];
            if (empty($_POST['code']) || empty($_POST['start_date']) || empty($_POST['description']) || empty($_POST['discount_type']) || empty($_POST['end_date']) || empty($_POST['value']) || empty($_POST['tour_id']) || empty($_POST['status'])) {
                $err['empty'] = "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
            }
            if ($_POST['start_date'] > $_POST['end_date']) {
                $err['date'] = "Ngày kết thúc phải sau ngày bắt đầu.";
            }
            if (empty($err)) {
                $this->discountModel->code = $_POST['code'];
                $this->discountModel->description = $_POST['description'];
                $this->discountModel->discount_type = $_POST['discount_type'];
                $this->discountModel->value = $_POST['value'];
                $this->discountModel->start_date = $_POST['start_date'];
                $this->discountModel->end_date = $_POST['end_date'];
                $this->discountModel->tour_id = $_POST['tour_id'];
                $this->discountModel->status = $_POST['status'];
                if ($this->discountModel->updateDiscount($id)) {
                    echo "<script>
                        alert('Sửa mã giảm giá thành công!');
                        window.location.href='?action=admin-listDiscount';
                    </script>";
                    exit;
                }
            }
        }

        $tours = $this->tourModel->getAllTours();
        require './views/Discount/updateDiscount.php';
    }

    public function deleteDiscount()
    {
        $id = $_GET['id'] ?? null;
        if ($id)
            $this->discountModel->deleteDiscount($id);
        header("Location: ?action=admin-listDiscount");
        exit;
    }
}
?>