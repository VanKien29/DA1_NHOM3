<?php
class RevenueController
{
    private $revenueModel;

    public function __construct()
    {
        $this->revenueModel = new RevenueQuery();
    }
    public function listRevenues()
    {
        $revenues = $this->revenueModel->getAllRevenues();
        require './views/Revenue/listRevenue.php';
    }
}
?>