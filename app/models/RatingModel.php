<?php
// app/models/RatingModel.php

class RatingModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('sqlite:../db.sqlite');
    }

    public function addRating($imdb_id, $rating) {
        $stmt = $this->db->prepare("INSERT INTO ratings (imdb_id, rating) VALUES (?, ?)");
        $stmt->execute([$imdb_id, $rating]);
    }

    public function getAverageRating($imdb_id) {
        $stmt = $this->db->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE imdb_id = ?");
        $stmt->execute([$imdb_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return round($result['avg_rating'], 1);
    }
    
}