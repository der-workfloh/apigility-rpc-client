<?php

require_once './ApigilityRpcClient.php';

$rpcClient = new ApigilityRpcClient('http://localhost:8080/apirpc');

$result = $rpcClient->post(array(
    'firstvalue' => 1,
    'secondvalue' => 5
));

print('Sum of 1 and 5: '.$result->result."\n");


