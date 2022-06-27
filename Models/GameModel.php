<?php

namespace App\Models;
use CodeIgniter\Model;

class GameModel extends Model
{
    public function getGames()
    {
        $sql = "SELECT * FROM games";
        $data = $this->db->query($sql);
        return $data->getResult();
    }

    public function getGame($id)
    {
        $sql = "SELECT * FROM games WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id
        ]);
        return $data->getRow();
    }

    public function getUserGames($user_id)
    {
        $sql = "SELECT * FROM games";
        $data = $this->db->query($sql);
        return $data->getResult();
    }

    public function addGame($title, $save_location)
    {
        $sql = "INSERT INTO games (title, save_location) VALUES (:title:, :save_location:)";
        $data = $this->db->query($sql, [
            'title' => $title,
            'save_location' => $save_location
        ]);
        return $data->getRow();
    }

    public function updateGame($id, $title, $save_location, $image_path, $description)
    {
        $sql = "UPDATE games SET title = :title:, save_location = :save_location:, image_path = :image_path:, description = :description: WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id,
            'title' => $title,
            'save_location' => $save_location,
            'image_path' => $image_path,
            'description' => $description
        ]);
        return $data->getRow();
    }

    public function addGameImage($id, $image_path)
    {
        $sql = "UPDATE games SET image_path = :image_path: WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id,
            'image_path' => $image_path
        ]);
        return $data->getRow();
    }

    public function gameHoursUpdate($id, $hours)
    {
        $sql = "UPDATE games SET hours_played = :hours: WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id,
            'hours_played' => $hours
        ]);
        return $data->getRow();
    }

    public function deleteGame($id)
    {
        $sql = "DELETE FROM games WHERE id = :id:";
        $data = $this->db->query($sql, [
            'id' => $id
        ]);
        return $data->getRow();
    }

}