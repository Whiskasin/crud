<?php
namespace App\Model;
use App\Core\Connection;
class TasksModel {
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM tasks';
        return $this->db->fetchAll($sql);
    }
    public function find($id)
    {
        $sql = 'SELECT * FROM tasks WHERE id = ?';
        return $this->db->fetch($sql, [$id]);
    }

    public function create($data)
    {
        $sql = 'INSERT INTO tasks SET title = :title, description = :description, status = :status';
        $params = [
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':status' => $data['status'],
        ];

        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id";
        $params = [
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':status' => $data['status'],
            ':id' => $id
        ];

        return $this->db->query($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tasks WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
}