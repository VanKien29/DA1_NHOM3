<?php
class Categorys extends BaseModel {
    public $category_id;
    public $category_name;
    public function getAllCategories($limit = null, $offset = null) {
        $sql = "SELECT * 
                FROM categories ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>