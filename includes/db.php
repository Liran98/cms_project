<?php ob_start();
//db is an array


$db['db_host'] = "localhost:8889";
$db['db_user'] ='root';
$db['db_pass'] ='root';
$db['db_name'] = "cms";

//converting the keys to upperCase then putting them as constants
forEach($db as $key => $value){
    
$convert =  strtoupper($key);
       // key       value
    
// const $convert = $value; ERROR
    
    define($convert , $value); // CORRECT WAY
}


$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(!$conn){
    die("connection failed");
}


?>
