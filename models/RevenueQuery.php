<?php
class RevenueQuery extends BaseModel
{
    public $revenue_id;
    public $booking_id;
    public $tour_id;
    public $customer_id;
    public $discount_id;
    public $original_price;
    public $discount_amount;
    public $final_price;
    public $payment_date;
    public $payment_method;

    public function getAllRevenues()
    {
        $sql = "SELECT * FROM revenues ORDER BY revenue_id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>