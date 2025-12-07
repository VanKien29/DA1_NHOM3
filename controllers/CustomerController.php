<?php
class CustomerController
{
    private $customerModel;

    public function __construct() {
        $this->customerModel = new CustomerQuery();
    }

    public function listCustomers() {
        $customers = $this->customerModel->getAllCustomers();
        require './views/Customer/listCustomer.php';
    }

    public function searchCustomer() {
        $keyword = $_GET['keyword'] ?? '';
        $customers = $this->customerModel->searchCustomers($keyword);
        require './views/Customer/listCustomer.php';
    }

    public function createCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];

            if (strpbrk($_POST['full_name'], '0123456789') || strlen($_POST['full_name']) <= 6) {
                $err['full_name'] = "Tên phải trên 6 kí tự và không có số.";
            }

            if (!preg_match("/^\+?\d{9,12}$/", $_POST['phone'])) {
                $err['phone'] = "Số điện thoại không hợp lệ.";
            }

            if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $_POST['email'])) {
                $err['email'] = "Email không đúng định dạng.";
            }

            if (empty($_POST['address'])) {
                $err['address'] = "Vui lòng nhập địa chỉ.";
            }

            if (!is_numeric($_POST['age']) || $_POST['age'] <= 0) {
                $err['age'] = "Tuổi không hợp lệ.";
            }

            if (empty($err)) {
                $age = (int)$_POST['age'];
                $role = $age >= 12 ? 'adult' : 'child';

                $this->customerModel->full_name = $_POST['full_name'];
                $this->customerModel->email = $_POST['email'];
                $this->customerModel->phone = $_POST['phone'];
                $this->customerModel->address = $_POST['address'];
                $this->customerModel->age = $age;
                $this->customerModel->role = $role;

                if ($this->customerModel->createCustomer()) {
                    echo "<script>
                        alert('Thêm khách hàng thành công!');
                        window.location.href='?action=admin-listCustomer';
                    </script>";
                    exit;
                }
            }
        }

        require './views/Customer/createCustomer.php';
    }

    public function updateCustomer($id)
    {
        $customer = $this->customerModel->findCustomer($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $err = [];

            if (strpbrk($_POST['full_name'], '0123456789') || strlen($_POST['full_name']) <= 6) {
                $err['full_name'] = "Tên phải trên 6 kí tự và không có số.";
            }

            if (!preg_match("/^\+?\d{9,12}$/", $_POST['phone'])) {
                $err['phone'] = "Số điện thoại không hợp lệ.";
            }

            if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $_POST['email'])) {
                $err['email'] = "Email không đúng định dạng.";
            }

            if (empty($_POST['address'])) {
                $err['address'] = "Vui lòng nhập địa chỉ.";
            }

            if (!is_numeric($_POST['age']) || $_POST['age'] <= 0) {
                $err['age'] = "Tuổi không hợp lệ.";
            }

            if (empty($err)) {
                $age = (int)$_POST['age'];
                $role = $age >= 12 ? 'adult' : 'child';

                $this->customerModel->customer_id = $id;
                $this->customerModel->full_name = $_POST['full_name'];
                $this->customerModel->email = $_POST['email'];
                $this->customerModel->phone = $_POST['phone'];
                $this->customerModel->address = $_POST['address'];
                $this->customerModel->age = $age;
                $this->customerModel->role = $role;

                if ($this->customerModel->updateCustomer()) {
                    echo "<script>
                        alert('Cập nhật khách hàng thành công!');
                        window.location.href='?action=admin-listCustomer';
                    </script>";
                    exit;
                }
            }
        }

        require './views/Customer/updateCustomer.php';
    }

    public function deleteCustomer($id)
    {
        if ($id) {
            if ($this->customerModel->deleteCustomer($id)) {
                echo "<script>
                    alert('Xóa khách hàng thành công!');
                    window.location.href='?action=admin-listCustomer';
                </script>";
            } else {
                echo "<script>
                    alert('Không thể xoá vì khách hàng này đang trong một tour!');
                    window.location.href='?action=admin-listCustomer';
                </script>";
            }
            exit;
        }
    }
}
?>