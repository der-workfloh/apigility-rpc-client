<?php


require_once './ApigilityRpcClient.php';

$rpcClient = new ApigilityRpcClient('http://localhost:8080/apirpc');

$result = $rpcClient->post(array(
    'firstvalue' => 1,
    'secondvalue' => 5
));

// result: 6
print('[RPC::firstRPCServiceAction] Result: '.$result->result."\n");


