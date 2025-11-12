<?php 
class CustomerController {
    private $customerModel;

    public function __construct() {
        $this->customerModel = new CustomerQuery();
    }

    public function listCustomers() {
        $customers = $this->customerModel->getAllCustomers();
        require './views/Customer/listCustomer.php';
    }

    public function createCustomer() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->customerModel->full_name = $_POST['full_name'];
            $this->customerModel->email = $_POST['email'];
            $this->customerModel->phone = $_POST['phone'];
            $this->customerModel->address = $_POST['address'];

            if (!empty($this->customerModel->full_name) && !empty($this->customerModel->email)) {
                $this->customerModel->createCustomer();
                header("Location: ?action=admin-listCustomer");
                exit;
            }
        }
        require './views/Customer/createCustomer.php';
    }

    public function updateCustomer($id) {
        $customer = $this->customerModel->findCustomer($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->customerModel->customer_id = $id;
            $this->customerModel->full_name = $_POST['full_name'];
            $this->customerModel->email = $_POST['email'];
            $this->customerModel->phone = $_POST['phone'];
            $this->customerModel->address = $_POST['address'];
                $this->customerModel->updateCustomer();
                header("Location: ?action=admin-listCustomer");
                exit;
        }

        require './views/Customer/updateCustomer.php';
    }

    public function deleteCustomer($id) {
        if ($id) {
            $this->customerModel->deleteCustomer($id);
        }
        header("Location: ?action=admin-listCustomer");
        exit;
    }
}
?>