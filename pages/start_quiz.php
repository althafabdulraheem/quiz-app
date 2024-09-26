<?php

include('../DbCon.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    if($conff)
    {
        $name = str_replace(" ","",$_POST['name']);
        $query="INSERT INTO users (name) VALUES ('$name')";
        $query_conff=mysqli_query($conff,$query);
        if($query_conff)
        {
           $id=mysqli_insert_id($conff);
           $_SESSION['user_id']=$id;
           $_SESSION['quest_count']=$id;
            $respose=['status'=>true,'message'=>'Success','id'=>$id];
            echo json_encode($respose);
        }
      
    }
    else{
        $respose=['status'=>false,'message'=>'Db connection error'];
        echo json_encode($respose);
    }
}
else{
    $respose=['status'=>false,'message'=>'Unsupported method'];
    return json_encode($respose);
}
?>
