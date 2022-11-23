<?php
require_once("../kafe_back_end/conn.php");

$fileName = basename($_FILES['file']['name']); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
$fileType = strtolower($fileType);
$file = $_FILES['file']['tmp_name'];
$path = "/img/".$fileName;

$date = date('Y-m-d H:i:s');

try{

    move_uploaded_file($file,$_SERVER['DOCUMENT_ROOT']."/img/".$fileName);

    $mysql = "INSERT INTO img (path,date) VALUES (?,?)";
    $stmt = $conn ->prepare($mysql);
    if($stmt === false){
        throw new Exception("Něco se nepovedlo u nás na serveru... DB");
    }
    $stmt->bind_param("ss", $path,$date);
    $stmt -> execute();

}catch(Exception $e){
    echo "Něco se nepovedlo...\n". $e->getMessage();
    //throw new Exception($e->getMessage());
}

echo "ok";




