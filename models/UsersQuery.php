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
    public $cccd;

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
        $sql = "INSERT INTO users (username, password, role, name, email, phone, cccd)
                VALUES (:username, :password, :role, :name, :email, :phone , :cccd)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':cccd', $this->cccd);
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
                    phone = :phone,
                    cccd = :cccd
                WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':cccd', $this->cccd);
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
    public function getGuideByUserId($uid)
    {
        $sql = "SELECT * FROM guides WHERE user_id = :uid";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([':uid' => $uid]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function getToursByGuideStatus($guide_id, $status)
    {
        $sql = "SELECT b.*, t.tour_name
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            WHERE b.guide_id = :gid
            AND b.status = :stt
            ORDER BY b.start_date DESC";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([
            ':gid' => $guide_id,
            ':stt' => $status
        ]);

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $name, $email, $phone, $cccd, $avatar = null)
    {
        $sql = "UPDATE users SET 
                name = :name,
                email = :email,
                phone = :phone,
                cccd = :cccd"
            . ($avatar ? ", avatar = :avatar" : "") .
            " WHERE user_id = :id";

        $stm = $this->pdo->prepare($sql);

        $stm->bindParam(':name', $name);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':phone', $phone);
        $stm->bindParam(':cccd', $cccd);
        $stm->bindParam(':id', $id);

        if ($avatar) {
            $stm->bindParam(':avatar', $avatar);
        }

        return $stm->execute();

    }

    public function getGuideTours($user_id, $status = null)
    {
        $sql = "
        SELECT 
            b.*, t.tour_name
        FROM bookings b
        JOIN tours t ON b.tour_id = t.tour_id
        JOIN guides g ON b.guide_id = g.guide_id
        WHERE g.user_id = :uid
    ";

        if ($status !== null) {
            $sql .= " AND b.status = :status ";
        }

        $stm = $this->pdo->prepare($sql);
        $stm->bindParam(':uid', $user_id);

        if ($status !== null) {
            $stm->bindParam(':status', $status);
        }

        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>