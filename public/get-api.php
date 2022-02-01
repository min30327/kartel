<?php 
$req = rtrim($_SERVER['REQUEST_URI'],"\/");
$title = "";
$desc = "";
$img = "";
$prtcl =  "https";

if(preg_match('/[0-9]$/', $req)){
    
    $result = file_get_contents( $prtcl ."://". $_SERVER['SERVER_NAME'] ."/api/Ogp?url=" . $req);
    $array = json_decode($result, true);
    $title = $array["title"] . "｜". $title;
    $desc = $array["description"];
    $img = (!empty($array["image"])) ? $array["image"] : $img ;
}
define('OG_TITLE', $title);
define('OG_DESC', $desc);
define('OG_IMG', $img);

define("OG_URL",$_SERVER['REQUEST_URI']);
