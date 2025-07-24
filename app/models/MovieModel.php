<?php
// app/models/MovieModel.php

class MovieModel {
    private $apiKey = "33879f52"; // OMDb API Key
    
    private $geminiApiKey = "AIzaSyB_gPJk7PWvZ-Il4idlkEJw_zwsAIOO6Io"; // My Gemini API Key
    

    public function fetchMovie($title, $year = '') {
        $title = urlencode($title);
        $query_url = "http://www.omdbapi.com/?apikey={$this->apiKey}&t={$title}";

        if ($year !== '') {
            $query_url .= "&y={$year}";
        }

        $json = @file_get_contents($query_url);
        if ($json === FALSE) {
            error_log("OMDb Error: Could not retrieve data for '{$title}' from OMDb API.");
            return ["error" => "Could not retrieve data from OMDb API."];
        }

        $data = json_decode($json);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("OMDb JSON Decode Error: " . json_last_error_msg() . " for response: " . $json);
            return ["error" => "Invalid data received from OMDb API."];
        }

        if (isset($data->Response) && $data->Response === "False") {
            return ["error" => htmlspecialchars($data->Error)];
        }

        return (array)$data;
    }
}