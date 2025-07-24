<?php
// app/models/MovieModel.php

class MovieModel {
    private $apiKey = "33879f52"; // OMDb API Key
    private $geminiApiKey = "AIzaSyB_gPJk7PWvZ-Il4idlkEJw_zwsAIOO6Io"; // Your Gemini API Key

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

    /**
     * Generates an AI-powered movie review using the Google Gemini API (gemini-2.0-flash model) via cURL.
     * @param string $title The title of the movie.
     * @param string $year The release year of the movie.
     * @return string The AI-generated review text, or an error message.
     */
    public function getAIReview($title, $year) {
        $prompt = "Write a short, engaging movie review for the film \"$title\" released in $year. Keep it under 100 words, without spoilers.";

        // --- Changes Start Here ---

        // 1. Updated API URL to use 'gemini-2.0-flash' model
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

        $payload = json_encode([
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ]
        ]);

        // 2. Initialize cURL
        $ch = curl_init($url);

        // 3. Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string
        curl_setopt($ch, CURLOPT_POST, true);           // Set request method to POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); // Set the JSON payload

        // Set HTTP headers: Content-Type and X-goog-api-key
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-goog-api-key: ' . $this->geminiApiKey // Use the X-goog-api-key header
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, 15); // Timeout in seconds

        // 4. Execute cURL request
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        $curl_error = curl_error($ch);                     // Get cURL error message
        curl_close($ch); 

        // 5. Handle cURL errors and HTTP response codes
        if ($result === FALSE) {
            error_log("Gemini API cURL Error for '{$title}' ({$year}): " . $curl_error);
            return "Error: Failed to connect to Gemini AI (cURL error). Please try again later.";
        }

        // Check for non-200 HTTP responses
        if ($http_code !== 200) {
            // Attempt to decode even on error to get API's error message
            $response = json_decode($result, true);
            $errorMessage = isset($response['error']['message']) ? htmlspecialchars($response['error']['message']) : 'Unknown error';
            error_log("Gemini API HTTP Error ({$http_code}) for '{$title}' ({$year}): " . $result);
            return "Error from AI (HTTP {$http_code}): {$errorMessage}";
        }
    }
}