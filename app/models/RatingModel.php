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
}