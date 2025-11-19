<?php
class CategoryQuery extends BaseModel {
    public $category_id;
    public $category_name;
    public function getAllCategories() {
        $sql = "SELECT * 
                FROM categories ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createCategory() {
        $sql = "INSERT INTO categories (category_name) 
                VALUES (:category_name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category_name', $this->category_name);
        return $stmt->execute();
    }
    public function findCategory($id) {
        $sql = "SELECT * 
                FROM categories 
                WHERE category_id = :category_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category_id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateCategory() {
        $sql = "UPDATE categories 
                SET category_name = :category_name 
                WHERE category_id = :category_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category_name', $this->category_name);
        $stmt->bindParam(':category_id', $this->category_id);
        return $stmt->execute();
    }
    public function deleteCategory($id){
    try {
        $sql = "DELETE FROM categories WHERE category_id = :id";
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

    
}
?>