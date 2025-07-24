<?php
// app/models/RatingModel.php

class RatingModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('sqlite:../db.sqlite');
    }
}