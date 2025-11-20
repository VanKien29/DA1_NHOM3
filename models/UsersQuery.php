<?php
class UsersQuery extends BaseModel
{
    public $user_id;
    public $username;
    public $password;
    public $role;
    public $name;
    public $email;
    public $phone;

    // ====== Lấy toàn bộ người dùng ======
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY user_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== Tìm user theo ID ======
    public function findUser($id)
    {
        $sql = "SELECT * FROM users WHERE user_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function searchUsers($keyword)
    {
        $sql = "SELECT * FROM users 
        WHERE username LIKE :keyword
        OR name LIKE :keyword 
        OR email LIKE :keyword 
        ORDER BY user_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $likeKeyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $likeKeyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====== Thêm user ======
    public function createUser()
    {
        $sql = "INSERT INTO users (username, password, role, name, email, phone)
                VALUES (:username, :password, :role, :name, :email, :phone)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        return $stmt->execute();
    }

    // ====== Cập nhật user ======
    public function updateUser()
    {
        $sql = "UPDATE users SET 
                    username = :username,
                    password = :password,
                    role = :role,
                    name = :name,
                    email = :email,
                    phone = :phone
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        return $stmt->execute();
    }

    // ====== Xóa user ======
    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM users WHERE user_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            }
        }
    }

    public function checkLogin($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>