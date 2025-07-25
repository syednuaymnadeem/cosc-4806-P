<?php
//app/models/RatingModel.php

class RatingModel {
    private $db;

    public function __construct() {
        $host = 'cqeh8.h.filess.io';
        $port = 3305;
        $dbname = 'cosc4808_situation';
        $username = 'cosc4808_situation';
        $password = '56815672943e230cfe4f4bb25f5484c7e709cbdb';

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function addRating($imdb_id, $rating) {
        $stmt = $this->db->prepare("INSERT INTO ratings (imdb_id, rating) VALUES (?, ?)");
        $stmt->execute([$imdb_id, $rating]);
    }

    public function getAverageRating($imdb_id) {
        $stmt = $this->db->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE imdb_id = ?");
        $stmt->execute([$imdb_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result && $result['avg_rating'] !== null ? round($result['avg_rating'], 1) : null;
    }
}
