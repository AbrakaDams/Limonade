<?php
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Controller\Connection;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new WsServer(
        new List()
    )
    , 8080
);

$server->run();
