<?php
    $conff=mysqli_connect('localhost','root','','quiz-app');
    if(!$conff)
    {
        $respose=['status'=>false,'message'=>'Db connection error'];
        echo json_encode($respose);
    }
?>