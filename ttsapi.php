<?php
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if (isset($_POST['txt'])) {
    $txt=$_POST['txt'];
    $txt=htmlspecialchars($txt);
    $txt=rawurldecode($txt);
    $result = preg_replace('/[ ]+/', '%20', trim($txt));
    $url= 'https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$result.'&tl=en';
    $response = url_get_contents($url);
    $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($response)."'></audio>";
    echo $player;
}
?>