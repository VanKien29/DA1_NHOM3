<?php
class CustomerQuery extends BaseModel
{
    public $customer_id;
    public $full_name;
    public $email;
    public $phone;
    public $address;
    public $age;
    public $role;

    public function getAllCustomers()
    {
        $sql = "SELECT * FROM customers ORDER BY customer_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findCustomer($id)
    {
        $sql = "SELECT * FROM customers WHERE customer_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchCustomers($keyword)
    {
        $sql = "SELECT * FROM customers 
                WHERE full_name LIKE :keyword
                OR email LIKE :keyword
                OR phone LIKE :keyword
                ORDER BY customer_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $key = "%$keyword%";
        $stmt->bindParam(':keyword', $key);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCustomer()
    {
        $sql = "INSERT INTO customers (full_name, email, phone, address, age, role)
                VALUES (:full_name, :email, :phone, :address, :age, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':role', $this->role);
        return $stmt->execute();
    }

    public function updateCustomer()
    {
        $sql = "UPDATE customers SET
                    full_name = :full_name,
                    email = :email,
                    phone = :phone,
                    address = :address,
                    age = :age,
                    role = :role
                WHERE customer_id = :customer_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':customer_id', $this->customer_id);
        return $stmt->execute();
    }

    public function deleteCustomer($id)
    {
        try {
            $sql = "DELETE FROM customers WHERE customer_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>