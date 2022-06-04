<?php

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/component/connection.php');

class Model {
    
    public function __construct() {
        $this->db = DataBase::getConnection();
    }

    public function getVendors() {
        $query = "SELECT id, `name` FROM vendors";
        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll();
    }

    public function getCategory() {
        $query = "SELECT id, `name` FROM category";
        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll();
    }

    public function getItemsByVendor($id) {
        $query = "SELECT i.`name` AS it_name, i.`price`, i.`quantity`, c.`name` AS cat_name FROM items AS i JOIN category AS c ON i.id_category = c.id WHERE i.id_vendor = :id";
        $result = $this->db->prepare($query);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemsByCategory($id) {
        $query = "SELECT i.`name` AS it_name, i.`price`, i.`quantity`, v.`name` AS ven_name FROM items AS i JOIN vendors AS v ON i.id_vendor = v.id WHERE i.id_category = :id";
        $result = $this->db->prepare($query);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRange($from, $to) {
        $query = "SELECT i.`name` AS it_name, i.`price`, i.`quantity`, v.`name` AS ven_name, c.`name` AS cat_name FROM items AS i JOIN vendors AS v ON i.id_vendor = v.id JOIN category AS c ON i.id_category = c.id WHERE price BETWEEN :f AND :t";
        $result = $this->db->prepare($query);
        $result->bindParam('f', $from, PDO::PARAM_INT);
        $result->bindParam('t', $to, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>