<?php
class TourGuideQuery extends BaseModel {
    public $guide_id;
    public $user_id;
    public $experience_years;
    public $specialization;
    public $note;

    public function getAllTourGuides() {
        $sql = "SELECT tg.*, u.name AS user_name, t.tour_name AS tour_name, b.booking_id
                FROM tour_guides tg
                INNER JOIN guides g ON tg.guide_id = g.guide_id
                INNER JOIN users u ON g.user_id = u.user_id
                INNER JOIN tours t ON tg.tour_id = t.tour_id
                LEFT JOIN bookings b ON b.tour_id = tg.tour_id
                ORDER BY tg.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findTourGuide($id) {
        $sql = "SELECT tg.*, u.name AS user_name, t.tour_name AS tour_name, b.booking_id
                FROM tour_guides tg
                INNER JOIN guides g ON tg.guide_id = g.guide_id
                INNER JOIN users u ON g.user_id = u.user_id
                INNER JOIN tours t ON tg.tour_id = t.tour_id
                LEFT JOIN bookings b ON b.tour_id = tg.tour_id
                WHERE tg.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTourGuide() {
        $sql = "INSERT INTO tour_guides (tour_id, guide_id, assigned_date, start_date, end_date, status)
                VALUES (:tour_id, :guide_id, :assigned_date, :start_date, :end_date, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':assigned_date', $this->assigned_date);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':status', $this->status);
        return $stmt->execute();
    }

    public function updateGuide() {
        $sql = "UPDATE tour_guides SET
                tour_id = :tour_id,
                guide_id = :guide_id,
                assigned_date = :assigned_date,
                start_date = :start_date,
                end_date = :end_date,
                status = :status
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':assigned_date', $this->assigned_date);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function deleteTourGuide($id) {
        try {
            $sql = "DELETE FROM tour_guides WHERE id = :id";
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

    public function isDateConflict($tour_id, $guide_id, $start_date, $end_date, $ignore_id = null) {
        $sql = "SELECT * FROM tour_guides 
                WHERE tour_id = :tour_id 
                AND guide_id = :guide_id
                AND (
                        (start_date <= :end_date AND end_date >= :start_date)
                    )";
        if ($ignore_id) {
            $sql .= " AND id != :ignore_id";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':tour_id', $tour_id);
        $stmt->bindParam(':guide_id', $guide_id);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);

        if ($ignore_id) {
            $stmt->bindParam(':ignore_id', $ignore_id);
        }

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}