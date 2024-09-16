<?php

class Menu {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function createMenu($name, $parent_id = null) {
        $sql = "INSERT INTO menus (name, parent_id) VALUES (?, ?)";
        return $this->db->execute($sql, [$name, $parent_id]);
    }

    public function getAllMenus() {
        $sql = "SELECT id, name, parent_id FROM menus";
        return $this->db->fetchAll($sql);
    }
}
