<?php

$wsWorker = new Workerman\Worker('websocket://0.0.0.0:9000');

$connections = []; 
$userId = '';

$wsWorker->onConnect = function ($connection) use (&$connections): void {
    $connection->onWebSocketConnect = function ($connection) use (&$connections) {   
    };
};

$wsWorker->onClose = function ($connection) use (&$connections): void {
    if (!isset($connections[$connection->userId])) {
        return;
    }
    unset($connections[$connection->userId]);
};

$wsWorker->onMessage = function ($connection, $message) use (&$connections): void {
    $messageData = json_decode($message, true);
    var_dump($messageData);
    $messageData['nickname'] = $connection->nickname;
    $messageData['text'] = htmlspecialchars($messageData['text']);  
};

Workerman\Worker::runAll();
