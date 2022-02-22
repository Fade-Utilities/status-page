<?php
// Get server data for overview
$servers = [
    'luigi.s.will-dev.live',
    '206.189.20.118'
];

function serverInformation($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);
    $output = curl_exec($ch);
    #$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $info = curl_getinfo($ch);
    curl_close($ch);
    return $info;
    //return $output;
}
$mario = serverInformation($servers[1]);

var_dump($mario);