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
        require_once './views/admin.php';
    }
}