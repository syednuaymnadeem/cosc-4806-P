<?php
// public/index.php

require_once '../core/Router.php';
require_once '../core/Controller.php';

require_once '../app/controllers/MovieController.php';
require_once '../app/models/MovieModel.php';

// If no route given → show search
$controller = new MovieController();
if (!isset($_GET['action']))
