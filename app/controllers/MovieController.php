<?php
// app/controllers/MovieController.php

class MovieController extends Controller {
  public function search() {
      $this->view('movie/search');
  }
  public function details() {
  $title = isset($_GET['title']) ? trim($_GET['title']) : '';
  $year = isset($_GET['year']) ? trim($_GET['year']) : '';
  $ratingSubmitted = false;
  $aiReview = null;

  if ($title === '') {
      echo "No title provided.";
      return;
  }
    $model = $this->model('MovieModel');
    $movie = $model->fetchMovie($title, $year)
  
}
}