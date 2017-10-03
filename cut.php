<?php
include 'config.php';

function generateCode($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) 
    {
      $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}

if (isset($_POST['short']) AND strlen($_POST['short']) > 0 ){
    $short = strip_tags(trim($_POST['short']));
}else{
    $short = generateCode(5);
}

if (isset($_POST['full']) AND strlen($_POST['full']) > 0 ){
    
    $full = strip_tags(trim($_POST['full']));
    $short = 'http://animadqu.bget.ru/' . $short;
    
    $sql = "SELECT * FROM url WHERE short ='$short'";
   
    $result = $connect->query($sql);
    if($result->num_rows>0){
        header('Location: index.php?error='.$short);
    }else{
        $sql = "INSERT INTO url (full, short) VALUES ('$full', '$short')";
        if($connect->query($sql)){
            header('Location: index.php?short='.$short);
        }
    }
}
?>