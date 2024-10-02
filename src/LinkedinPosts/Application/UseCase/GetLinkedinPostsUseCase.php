<?php

namespace App\LinkedinPosts\Application\UseCase;

use Symfony\Component\HttpFoundation\JsonResponse;

class GetLinkedinPostsUseCase
{
    public function __construct() {

    }

    public function execute()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://linkedin-data-api.p.rapidapi.com/posts/reposts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'urn' => '7245786832909557760'
            ]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-rapidapi-host: linkedin-data-api.p.rapidapi.com",
                "x-rapidapi-key: 6fb8bc5fb1mshe53cf22b0cd3394p1b6d18jsn6b10e14d1d2f"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        return json_decode($response);
    }
}