<?php 

namespace App\response;

use App\DTO\MovieDTO;

class HTTPResponse {

    public static function json(int $code, $data){
        
        $response = array();
        switch(gettype($data)){
            case "array":
                foreach($data as $value){
                    $response[] = $value->jsonSerialize();
                }
            break;

            case "object": 
                $response = $data->jsonSerialize();
                break;

            case "string":
                $response = [
                    "code" => $code,
                    "mensaje" => $data
                ];
                break;

        }

        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($response);

    }
}