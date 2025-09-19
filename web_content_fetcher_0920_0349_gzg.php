<?php
// 代码生成时间: 2025-09-20 03:49:34
require 'vendor/autoload.php';

use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Uri\Uri;

class WebContentFetcher {
    /**
     * Fetches the content of a webpage.
     *
     * @param string $url The URL of the webpage to fetch.
     *
     * @return string The content of the webpage.
     *
     * @throws Exception If an error occurs during the fetch process.
     */
    public function fetchContent($url) {
        // Check if the URL is valid
        $uri = new Uri($url);
        if (!$uri->isValid()) {
            throw new Exception("Invalid URL: {$url}");
        }

        // Set up the HTTP client
        $client = new Client();
        $client->setUri($url);
        $client->setMethod(Request::METHOD_GET);

        // Send the request
        try {
            $response = $client->send();
            if (!$response->isSuccess()) {
                throw new Exception("Failed to fetch content: {$response->getStatusCode()}");
            }

            // Return the content of the response
            return $response->getBody();
        } catch (Exception $e) {
            // Handle any exceptions that occur during the fetch process
            throw new Exception("Error fetching content: {$e->getMessage()}");
        }
    }
}

// Example usage
try {
    $fetcher = new WebContentFetcher();
    $url = 'http://example.com';
    $content = $fetcher->fetchContent($url);
    echo "Fetched content: 
";
    echo $content;
} catch (Exception $e) {
    echo "Error: 
";
    echo $e->getMessage();
}