<?php
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new BaseModel();
    }

    public function Home()
    {
        require_once './views/home.php';
    }
    public function admin()
    {
        require_once './views/admin/dashBoard/dashBoard.php';
    }
}