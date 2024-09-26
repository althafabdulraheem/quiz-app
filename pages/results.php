<?php
    include('../DbCon.php');
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $results=[];
        $correct=0;
        $incorrect=0;
        
        $Result_query = "SELECT * FROM user_answers JOIN options ON user_answers.answer_id = options.id JOIN questions ON user_answers.quest_id=questions.id WHERE user_id = $id";
        $Result_query_conff=mysqli_query($conff,$Result_query);
      
        if(mysqli_num_rows($Result_query_conff) > 0)
        {
            while($Result=mysqli_fetch_assoc($Result_query_conff))
            {
                $Answer_query="SELECT * FROM options WHERE quest_id=$Result[quest_id] AND is_answer='1'";
                $Answer_query_conff=mysqli_query($conff,$Answer_query);
                if($Answer_query_conff)
                {
                    $Answer=mysqli_fetch_assoc($Answer_query_conff);
                    $Options_query="SELECT * FROM options WHERE quest_id=$Result[quest_id]";
                    $Options_query_conff=mysqli_query($conff,$Options_query);
                    $Options=[];
                    while($Options_data=mysqli_fetch_assoc($Options_query_conff))
                    {
                        $Options[]=$Options_data;
                    }
                    
                    if($Answer['id'] == $Result['answer_id'])
                    {
                        $correct++;
                        $results[] = [
                            'status' => 'correct',
                            'selected' => $Result['option_name'],
                            'correct' => $Answer['option_name'],  
                            'question' => $Result, //$Result['quest_id']
                            'options'=>$Options
                              
                        ];
                    }
                    else{

                        $incorrect++;
                        $results[] = [
                            'status' => 'incorrect',
                            'selected' => $Result['option_name'],
                            'correct' => $Answer['option_name'],
                            'question' => $Result,
                            'options'=>$Options
                        ];
                    }
                }
            }
            
        }
        else{
           
            header('Location: ../index.php');
            exit;
        }
        // print_r($results);
    }
    else{
        header('Location: ../index.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="../styles/main.css"  type="text/css"/>
    <title>Result</title>
</head>
<body>
    <div class="card-wrapper">
        <div class="card">
            <h1 style="margin-top:10px">Hi <span id="user_name"></span> Your Result</h1>
            <p>Total Questions : 5</p>
            <p>Passed:<?php echo $correct ?></p>
            <p>Failed:<?php echo $incorrect ?></p>
            
            <?php
          
            foreach ($results as $result) {
                echo "<p>{$result['question']['question']}</p>";
                echo "<ul>";
                foreach ($result['options'] as $option) {
                    if($result['selected'] == $option['option_name'])
                    {
                        echo"<li>";
                        echo "<strong>$option[option_name]</strong>";
                        
                        if($option['option_name'] == $result['correct'])
                        {
                            echo "<span style='color:green'>&#x2714;<span>";

                        }
                        echo "</li>";
                    }
                    else{
                        echo"<li>";
                        echo "$option[option_name]";
                        if($option['option_name'] == $result['correct'])
                        {
                            echo "<span style='color:green'>&#x2714;<span>";

                        }
                        echo "</li>";
                    }
                }
                echo "</ul>";
            }
            ?>

            <button style="padding:10px;margin:10px;background:red;color:white;width: 210px;" id="re-start">Close</button>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        
         if(localStorage.getItem('id') && localStorage.getItem('currentQuestion') && localStorage.getItem('quizStatus')) {
            var quest_no = localStorage.getItem('currentQuestion');
            if(localStorage.getItem('name'))
            {
                $("#user_name").text(localStorage.getItem('name'))
            }
            else{
                $("#user_name").text('USER')
            }

            localStorage.setItem('quizStatus',1)
            if(!quest_no && quest_no <= 5) {
                location.href = "../index.php";
            }
         
         }
         else{
            location.href = "../index.php";
         }

         $("#re-start").on('click',function()
         {
            localStorage.removeItem('id')
            localStorage.removeItem('currentQuestion')
            localStorage.removeItem('quizStatus')
            localStorage.removeItem('name')
            location.href='../index.php';
         });
    </script>
</body>
</html>