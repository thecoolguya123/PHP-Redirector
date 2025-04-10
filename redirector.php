<?php
$url = isset($_GET['url']) ? $_GET['url'] : null; 
if($url == null){
   echo "<h1>400 Bad Request: URL was not specified.<br> Specify the URL by adding `?url=http://[url]/` as an extension on the current URL.</h1>";
} // Preventing it from redirecting to blank URL
else{
    if(filter_var($url, FILTER_VALIDATE_URL)) { 
    $parsed_url = parse_url($url);
    if (isset($parsed_url['scheme']) && in_array($parsed_url['scheme'], ['http', 'https'])) {  // Checking if it is HTTP
    echo "<h3><code>Redirecting you to `$url` ...</code></h3>"; 
    ob_flush();
    flush(); // Making sure redirection message gets sent to the browser
    sleep(3); 
    echo "<script>
       window.location.href = "$url";
    </script>"  // Redirection part
    } else{
    echo "<h1>400 Bad Request: Only HTTP URLs allowed.</h1>";  
    }
    } else{
    echo "400 Bad Request: HTTP header not included";
    }
}
?>
