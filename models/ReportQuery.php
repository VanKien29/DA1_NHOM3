<?php
class ReportQuery extends BaseModel
{
    public $report_id;
    public $guide_id;
    public $tour_id;
    public $report_date;
    public $content;
    public $rating;
    public function getAllReports()
    {
        $sql = "SELECT 
                    r.*,
                    u.name AS guide_name,
                    t.tour_name
                FROM reports r
                JOIN users u ON r.guide_id = u.user_id
                JOIN tours t ON r.tour_id = t.tour_id
                ORDER BY r.report_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findReport($id)
    {
        $sql = "SELECT 
                    r.*,
                    u.name AS guide_name,
                    t.tour_name
                FROM reports r
                JOIN users u ON r.guide_id = u.user_id
                JOIN tours t ON r.tour_id = t.tour_id
                WHERE r.report_id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createReport()
    {
        $sql = "INSERT INTO reports (guide_id, tour_id, report_date, content, rating)
                VALUES (:guide_id, :tour_id, :report_date, :content, :rating)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':report_date', $this->report_date);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':rating', $this->rating);
        return $stmt->execute();
    }
    public function updateReport($id)
    {
        $sql = "UPDATE reports SET 
                    guide_id = :guide_id, 
                    tour_id = :tour_id, 
                    report_date = :report_date,
                    content = :content,
                    rating = :rating
                WHERE report_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':guide_id', $this->guide_id);
        $stmt->bindParam(':tour_id', $this->tour_id);
        $stmt->bindParam(':report_date', $this->report_date);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':rating', $this->rating);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function deleteReport($id)
    {
        $sql = "DELETE FROM reports WHERE report_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>