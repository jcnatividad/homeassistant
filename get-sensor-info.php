<?php

function getHomeAssistant($id) { // HA ID
    $key = ''; // Access token
    $url = 'http://localhost:8123/'; // HA URL

    $info = [
        "http" => [
            "method" => "GET",
            "header" =>
                "Content-Type: application/json\r\n" .
                "Authorization: Bearer ".$key."\r\n"
        ]
    ];
	
    $has = stream_context_create($info);
    $data = @file_get_contents($url.'api/states/'.$id, false, $has);
    
	if (!$data) 
		return false;
    
	$data = json_decode($data);
    
	if(!$data) 
		return false;
    
	if(!isset($data->state)) 
		return false;
    
	return [$data->state, $data->last_updated];
}

?>