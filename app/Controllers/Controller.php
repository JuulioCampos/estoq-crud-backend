<?php

namespace App\Controllers;

class Controller
{ 
    protected function jsonResponse(array $data, int $statusCode): string {
        header('Content-Type: application/json');
        
        http_response_code($statusCode);
        
        return json_encode($data);
    }
    
    protected function handleResponse($response, $status = 200): string {
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
}
