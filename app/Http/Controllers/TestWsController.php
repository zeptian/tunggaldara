<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ratchet\Client;

class TestWsController extends Controller
{
    //
    public function test()
    {
        # code...
        $connection = \Ratchet\Client\connect('ws://127.0.0.1:8090')->then(function ($conn) {
            $conn->on('message', function ($msg) use ($conn) {
                echo "Received: {$msg}\n";
                $conn->close();
            });
            $conn->send('tunggaldara');
            $conn->send('{"user_id":"bayu","content":"Halo sdsdfgfgfgfhg"}');
            $conn->close();
        }, function ($e) {
            echo "Could not connect: {$e->getMessage()}\n";
        });
    }
}