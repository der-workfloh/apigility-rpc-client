<?php

require_once './ApigilityRpcClient.php';

$rpcClient = new ApigilityRpcClient('http://localhost:8080/apirpc');

try {
    $result = $rpcClient->post(array(
        'firstvalue' => 1,
        'secondvalue' => 5
    ));
}
catch (Exception $e) {
    print($e->getMessage()."\n");
    exit();
}

print('Sum of 1 and 5: '.$result->result."\n");


