<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;

require 'vendor/autoload.php';

class Chat implements MessageComponentInterface {

	public function onOpen(ConnectionInterface $conn) {
		        echo "New connection! ({$conn->resourceId})\n";

	}

	public function onMessage(ConnectionInterface $from, $msg) {
		echo $msg;
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}

	$server = IoServer::factory(
	        new Chat(),
			        8080
					    );

    $server->run();
