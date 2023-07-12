<?php

namespace App\Controllers;

class Controller
{
    protected function jsonResponse(array $data, int $statusCode): string
    {
        header('Content-Type: application/json');

        http_response_code($statusCode);

        return json_encode($data);
    }

    protected function handleResponse($response, $status = 200): string
    {
        
        if ($response instanceof \Throwable || $response instanceof \Exception) {
            $statusCode = $response->getCode() ?: 500; // Internal Server Error
            $data = [
                'status' => "false",
                'msg' => $response->getMessage()
            ];
        } else {
            $statusCode = $status; // OK
            $data = $response;
        }
        return print_r($this->jsonResponse($data, $statusCode));
    }

    function getBody(): array
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === 'application/json') {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            if (!is_array($decoded)) {
                throw new \Exception('Error decoding JSON request body.');
            }

            return $decoded;
        } else {
            throw new \Exception('Unsupported content type. Expected application/json.');
        }
    }


}