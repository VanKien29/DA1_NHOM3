<?php
class TourScheduleQuery extends BaseModel
{
    public $tour_schedule_id;
    public $tour_id;
    public $day_number;
    public $title;
    public $description;

    public function getSchedulesByTourId($tour_id)
    {
        $sql = "SELECT * FROM tour_schedules 
                WHERE tour_id = :tour_id
                ORDER BY day_number ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':tour_id', $tour_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>