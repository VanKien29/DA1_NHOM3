<?php
class GuideQuery extends BaseModel {
    public $guide_id;
    public $user_id;
    public $experience_years;
    public $specialization;
    public $note;

    public function getAllGuides() {
    $sql = "SELECT g.*, u.name, u.email, u.phone, tg.status AS tour_status
            FROM guides g
            INNER JOIN users u ON g.user_id = u.user_id
            LEFT JOIN tour_guides tg ON g.guide_id = tg.guide_id
            ORDER BY g.guide_id DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function findGuide($id) {
        $sql = "SELECT guides.*, users.name, users.email, users.phone, users.user_id
                FROM guides
                INNER JOIN users ON guides.user_id = users.user_id
                WHERE guide_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createGuide() {
        $sql = "INSERT INTO guides (user_id, experience_years, specialization, note)
                VALUES (:user_id, :experience_years, :specialization, :note)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':experience_years', $this->experience_years);
        $stmt->bindParam(':specialization', $this->specialization);
        $stmt->bindParam(':note', $this->note);
        return $stmt->execute();
    }

    public function updateGuide() {
        $sql = "UPDATE guides SET
                user_id = :user_id,
                experience_years = :experience_years,
                specialization = :specialization,
                note = :note
                WHERE guide_id = :guide_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':experience_years', $this->experience_years);
        $stmt->bindParam(':specialization', $this->specialization);
        $stmt->bindParam(':note', $this->note);
        return $stmt->execute();
    }

    public function deleteGuide($id) {
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

    public function getAllGuideUsers() {
        $sql = "SELECT * FROM users WHERE role = 'guide'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkUserGuide($user_id) {
        $sql = "SELECT * FROM guides WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}