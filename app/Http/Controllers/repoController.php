<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\repo;

class repoController extends Controller
{
    public function index(){
        $client = new Client();
        $url = "https://api.github.com/repositories";

        $params = [
            //If you have any Params Pass here
        ];

        $headers = [
            'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
        ];

        $response = $client->request('GET', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);

        // dd( $responseBody[1]['id']);
        for($i = 0; $i< count($responseBody); $i++){
            $data = new repo();
            $data->idApi = $responseBody[$i]['id'];
            $data->full_name = $responseBody[$i]['full_name'];
            $data->save();
        };

        return response()->json([
            'OUT_STAT' => true,
            'MESSAGE' => 'Success',
            'DATA' => $responseBody
        ]);
    }

    public function send(){

    }
}
