<?php

    include('../DbCon.php');
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        if(!isset($_POST['user_id']) && $_POST['user_id'] ==null)
        {
            $response=['status'=>false,'message'=>'Missing required parameter'];
            echo json_encode($response);
        }

        if(!isset($_POST['quest_count']) && $_POST['quest_count'] ==null)
        {
            $response=['status'=>false,'message'=>'Missing required parameter'];
            echo json_encode($response);
        }

        if(!isset($_POST['answer']))
        {
            $response=['status'=>false,'message'=>'Missing required parameter'];
            echo json_encode($response);
        }

        $count=$_POST['quest_count'];
        if($count <=5)
        {
            
            if($_POST['answer']==null)
            {
               
                $Question_query="SELECT question,id FROM questions WHERE id=$count";
                $Question_query_conff=mysqli_query($conff,$Question_query);
                $Question=mysqli_fetch_assoc($Question_query_conff);
                if($Question)
                {
                    $user_id=$_POST['user_id'];
                    $checkUser_query="SELECT * FROM user_answers WHERE user_id=$user_id AND quest_id=$Question[id]";
                    $checkUser_query_conff=mysqli_query($conff,$checkUser_query);
                    $checkUser=mysqli_fetch_assoc($checkUser_query_conff);
                    $sel_option=null;
                    if($checkUser)
                    {
                        $sel_option=$checkUser['answer_id'];
                        
                    }

                    $Option_query="SELECT id,option_name FROM options WHERE quest_id=$Question[id]";
                    $Option_query_conff=mysqli_query($conff,$Option_query);
                   $inputs="";
                    while($Option=mysqli_fetch_assoc($Option_query_conff))  
                    {
                        $selected = ($sel_option == $Option['id']) ? 'checked' : '';
                        $inputs.="<input type='radio' class='quest_options' name='quest_options' value=$Option[id] $selected>$Option[option_name]<br>";
                    }
                  

                    $response=['status'=>true,'question'=>$Question['question'],'input'=>$inputs,'cur_quest'=>$count];
                    echo json_encode($response);
                }

            }
            else{
               
                if($_POST['answer'] ==null && $_POST['user_id'])
                {
                    $response=['status'=>false,'message'=>'Missing required parameter'];
                    echo json_encode($response);
                }
                $user_id=$_POST['user_id'];
                $answer=$_POST['answer'];
                $checkUser_query="SELECT * FROM user_answers WHERE user_id=$user_id AND quest_id=$count";
                $checkUser_query_conff=mysqli_query($conff,$checkUser_query);
                $checkUser=mysqli_fetch_assoc($checkUser_query_conff);
                if($checkUser)
                {
                    $AnswerInsert_query="UPDATE user_answers SET answer_id=$answer WHERE user_id=$user_id AND quest_id=$count ";
                    $AnswerInsert_query_conff=mysqli_query($conff,$AnswerInsert_query);
                }
                else{
                   $AnswerInsert_query="INSERT INTO user_answers(quest_id,answer_id,user_id) VALUES($count,$answer,$user_id)";
                    $AnswerInsert_query_conff=mysqli_query($conff,$AnswerInsert_query);
                }
                
                if($AnswerInsert_query_conff)
                {
                   
                    if($count+1 <=5)
                    {
                        $Question_query="SELECT question,id FROM questions WHERE id=$count+1";
                        $Question_query_conff=mysqli_query($conff,$Question_query);
                        $Question=mysqli_fetch_assoc($Question_query_conff);
                        if($Question)
                        {
                            $checkUser_query="SELECT * FROM user_answers WHERE user_id=$user_id AND quest_id=$count+1";
                            $checkUser_query_conff=mysqli_query($conff,$checkUser_query);
                            $checkUser=mysqli_fetch_assoc($checkUser_query_conff);
                            $sel_option=null;
                            if($checkUser)
                            {
                                $sel_option=$checkUser['answer_id'];
                                
                               
                            }
                            
                            $Option_query="SELECT id,option_name FROM options WHERE quest_id=$Question[id]";
                            $Option_query_conff=mysqli_query($conff,$Option_query);
                        $inputs="";
                            while($Option=mysqli_fetch_assoc($Option_query_conff))  
                            {
                                $selected = ($sel_option == $Option['id']) ? 'checked' : '';
                               
                                $inputs.="<input type='radio' class='quest_options' name='quest_options' value=$Option[id] $selected>$Option[option_name]<br>";
                            }
                        

                            $response=['status'=>true,'question'=>$Question['question'],'input'=>$inputs,'cur_quest'=>$count+1];
                            echo json_encode($response);
                        }
                    }
                    else{
                        
                        $response=['status'=>true,'question'=>null,'input'=>null,'cur_quest'=>$count+1];
                        echo json_encode($response);
                    }    
                }        
            }
        }


    }
    else{
        $response=['status'=>false,'message'=>'Unsupported method'];
        echo json_encode($response);
    }



   
?>  