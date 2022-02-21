<?php

$urls = [
    'www.wclarke.me',
    'cdn.wclarke.me',
    'blog.wclarke.me',
    'view.wclarke.me',
    'staging.wclarke.dev'
];
$res = array();
foreach ($urls as $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $status = "offline";
    if ($httpcode == 200 || $httpcode == 301) $status = "online";
//    echo json_encode(array('url' => $url,'status' => $status, 'code' => $httpcode));
    array_push($res, array('url'=>$url, 'status'=>$status, 'code'=>$httpcode));
}
echo json_encode($res);
//echo json_encode(array('url' => $url,'status' => $status, 'code' => $httpcode));