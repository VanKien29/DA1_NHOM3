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

if (empty($_POST['code'])) {
    $err['code'] = "Mã giảm giá không được để trống.";
}
if (empty($_POST['start_date'])) {
    $err['start_date'] = "Ngày bắt đầu không được để trống.";
}

if (empty($_POST['end_date'])) {
    $err['end_date'] = "Ngày kết thúc không được để trống.";
}

if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
    if ($_POST['start_date'] > $_POST['end_date']) {
        $err['date'] = "Ngày kết thúc phải sau ngày bắt đầu.";
    }
}
if (empty($_POST['value'])) {
    $err['value'] = "Giá trị không được để trống.";
} elseif ($_POST['value'] <= 0) {
    $err['value'] = "Giá trị phải lớn hơn 0.";
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
if (empty($_POST['code'])) {
    $err['code'] = "Mã giảm giá không được để trống.";
}
if (empty($_POST['start_date'])) {
    $err['start_date'] = "Vui lòng chọn ngày bắt đầu.";
}
if (empty($_POST['end_date'])) {
    $err['end_date'] = "Vui lòng chọn ngày kết thúc.";
} else {
    if (!empty($_POST['start_date']) && $_POST['start_date'] > $_POST['end_date']) {
        $err['date'] = "Ngày kết thúc phải sau ngày bắt đầu.";
    }
}
if (empty($_POST['value'])) {
    $err['value'] = "Giá trị không được để trống.";
} elseif ($_POST['value'] <= 0) {
    $err['value'] = "Giá trị phải lớn hơn 0.";
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

    public function deleteDiscount($id)
    {
        if ($id) {
            if($this->discountModel->deleteDiscount($id)) {
            echo "<script>
                    alert('Xóa mã giảm giá thành công!');
                    window.location.href='?action=admin-listDiscount';
            </script>";
            exit; 
            } else {
                echo "<script>
                    alert('Không thể xoá mã giảm giá vì đang có tour thuộc mã giảm giá này!');
                    window.location.href='?action=admin-listDiscount';
            </script>";
                exit;
            }
        }
    }
}
?>