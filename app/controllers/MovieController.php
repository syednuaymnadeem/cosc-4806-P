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
        $movie = $model->fetchMovie($title, $year);

        if (isset($movie['imdbID'])) {
            $ratingModel = $this->model('RatingModel');

          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating'])) {
              $userRating = intval($_POST['rating']);
              if ($userRating >= 1 && $userRating <= 5) {
                  $ratingModel->addRating($movie['imdbID'], $userRating);
                  $ratingSubmitted = true;
              }
          }
          $avgRating = $ratingModel->getAverageRating($movie['imdbID']);

          if (isset($_GET['review']) && $_GET['review'] == 1) {
              $aiReview = $model->getAIReview($movie['Title'], $movie['Year']);
          }
        } else {
          $avgRating = null;
      }

      $this->view('movie/details', [
          'movie' => $movie,
          'avgRating' => $avgRating,
          'ratingSubmitted' => $ratingSubmitted,
          'aiReview' => $aiReview
      ]);
      
    }
}