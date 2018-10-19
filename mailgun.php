<?php
include_once 'config.php';
$obj = [];
$values = json_decode(file_get_contents("php://input"),true);
$obj['timestamp'] = $values['signature']['timestamp'];
$obj['token'] = $values['signature']['token'];
$obj['signature'] = $values['signature']['signature'];
$obj['event'] = $values['event-data']['event'];
$obj['recipient'] = $values['event-data']['recipient'];
$obj['domain'] = $values['event-data']['recipient-domain'];
if($obj['domain']==""){$obj['domain']="None";}
$obj['message-headers'] = json_encode($values['event-data']['message']['headers']);
$obj['delivery-status'] = json_encode($values['event-data']['delivery-status']);
if($debug){
    $debugVars = "input: ". serialize ($values). " ; post: " . serialize ($_POST);
    $logfile = 'mailgun.log';
    $handle = fopen($logfile, 'a');
    $results = print_r($obj, true);
    fwrite($handle, $results);
}
$insert = "INSERT INTO EmailsReports(Type,Recipient,Domain,messageHeaders,moreData)values(?,?,?,?,?)";
if(isset($obj['timestamp']) && isset($obj['token']) && isset($obj['signature']) && hash_hmac('sha256', $obj['timestamp'] . $obj['token'], $key) === $obj['signature'])
{
    $inserted = $dbconn->prepare($insert);
    $inserted->bind_param("sssss", $obj['event'], $obj['recipient'], $obj['domain'], $obj['message-headers'], $obj['delivery-status']);
    $result =  $inserted->execute();
    if($debug){
        fwrite($handle, "insert : " . $inserted->error);
    }
    if(!$result){
        syslog(LOG_ERR, "Mailgun WebHook Fail " . serialize ($result) . " data " . $debugVars );
        if($debug){
            fwrite($handle, "Mailgun WebHook Fail \n" . serialize ($result) . " data \n" . $debugVars);
        }
    }
}else{
    if($debug){
        fwrite($handle, hash_hmac('sha256', $obj['timestamp'] . $obj['token'], $key));
        syslog(LOG_ERR, "Mailgun WebHook Something Different " . $debugVars);
    }
}
header('X-PHP-Response-Code: 200', true, 200);
?>