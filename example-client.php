<?php
/*
 * Preparations
 */
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

function assertHandler($file, $line, $code)
{
    print('[ERR]: In line '.$line.' with code '.$code.' in '.$file.'.'."\n");
}

assert_options(ASSERT_CALLBACK, 'assertHandler');



/*
 * RPC
 */
require_once './ApigilityRpcClient.php';

$rpcClient = new ApigilityRpcClient('http://localhost:8080/apirpc');



/*
 * Assertions
 * If all assertions are successful, no output will be made
 */
// --- Validation test on non-numeric parameter
$err = false;
try {
    $result = $rpcClient->post(array(
        'firstvalue' => 1,
        'secondvalue' => 'a'
    ));
}
catch (Exception $e) {
    $err = true;
}
assert($err === true);


// --- Validation test on negative integer parameter
$err = false;
try {
    $result = $rpcClient->post(array(
        'firstvalue' => -1,
        'secondvalue' => 2
    ));
}
catch (Exception $e) {
    $err = true;
}
assert($err === true);


// --- Validation test on float parameter
$err = false;
try {
    $result = $rpcClient->post(array(
        'firstvalue' => 1.23,
        'secondvalue' => 2.34
    ));
}
catch (Exception $e) {
    $err = true;
}
assert($err === true);


// --- Success test
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
assert($result->result === 6);
