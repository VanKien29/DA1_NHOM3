<?php
class GuideQuery extends BaseModel
{
    public $guide_id;
    public $user_id;
    public $experience_years;
    public $specialization;
    public $note;

    public function getAllGuides()
    {
        $sql = "SELECT g.*, u.name, u.email, u.phone
            FROM guides g
            INNER JOIN users u ON g.user_id = u.user_id 
            ORDER BY g.guide_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findGuide($id)
    {
        $sql = "SELECT guides.*, users.name, users.email, users.phone, users.user_id
                FROM guides
                INNER JOIN users ON guides.user_id = users.user_id
                WHERE guide_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function searchGuide($keyword)
    {
        $sql = "SELECT g.*, u.name, u.email, u.phone
                FROM guides g
                INNER JOIN users u ON g.user_id = u.user_id
                WHERE u.name LIKE :keyword
                OR u.email LIKE :keyword
                OR u.phone LIKE :keyword
                ORDER BY g.guide_id DESC";
        $stmt = $this->pdo->prepare($sql);
        $likeKeyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $likeKeyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createGuide()
    {
        $sql = "INSERT INTO guides (user_id, experience_years, specialization, note, avatar)
                VALUES (:user_id, :experience_years, :specialization, :note, :avatar)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':experience_years', $this->experience_years);
        $stmt->bindParam(':specialization', $this->specialization);
        $stmt->bindParam(':note', $this->note);
        $stmt->bindParam(':avatar', $this->avatar);
        return $stmt->execute();
    }

    public function updateGuide()
    {
        $sql = "UPDATE guides SET
                user_id = :user_id,
                experience_years = :experience_years,
                specialization = :specialization,
                note = :note,
                avatar = :avatar
                WHERE guide_id = :guide_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':experience_years', $this->experience_years);
        $stmt->bindParam(':specialization', $this->specialization);
        $stmt->bindParam(':note', $this->note);
        $stmt->bindParam(':avatar', $this->avatar);
        return $stmt->execute();
    }

    public function deleteGuide($id)
    {
        try {
            $sql = "DELETE FROM guides WHERE guide_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                return false;
            }
        }
    }

    public function getAllGuideUsers()
    {
        $sql = "SELECT * FROM users WHERE role = 'guide'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkUserGuide($user_id)
    {
        $sql = "SELECT * FROM guides WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCurrentBookings($id)
    {
        $sql = "SELECT gt.id, gt.guide_id, gt.booking_id, t.tour_name, b.start_date, b.end_date, b.status AS booking_status
                FROM guide_tours gt
                JOIN bookings b ON gt.booking_id = b.booking_id
                JOIN tours t ON b.tour_id = t.tour_id
                WHERE gt.guide_id = :id
                AND gt.status = 'current'
                ORDER BY b.start_date ASC ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHistoryBookings($id)
    {
        $sql = "SELECT gt.id, gt.guide_id, gt.booking_id, t.tour_name, b.start_date, b.end_date, b.status AS booking_status
                FROM guide_tours gt
                JOIN bookings b ON gt.booking_id = b.booking_id
                JOIN tours t ON b.tour_id = t.tour_id
                WHERE gt.guide_id = :id
                AND gt.status = 'history'
                ORDER BY b.end_date DESC ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}