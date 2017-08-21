<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'lib/class.websocket_client.php';

$clients = array();
$testClients = 1;
$testMessages = 1;
for($i = 0; $i < $testClients; $i++)
{
	$clients[$i] = new WebsocketClient;
	$clients[$i]->connect('0.0.0.0', 9007, '', 'test');
}
usleep(500);

$payload = json_encode(array(
	'message' => 'stats'
));

for($i = 0; $i < $testMessages; $i++)
{
	$clientId = rand(0, $testClients-1);
	$clients[$clientId]->sendData($payload);
	usleep(500);
}
usleep(500);