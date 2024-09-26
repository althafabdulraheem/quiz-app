
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="../styles/main.css"  type="text/css"/>
    <title>Quiz</title>
</head>
<body>
<div class="form-wrapper">
    <form id="questionForm">
        <p id="question"></p>
        <div class="options">

        </div>
        
        <button type="submit" class="nxt-btn">Next</button>
    </form>
</div>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    $(document).ready(function()
    {
      
        if(localStorage.getItem('id') && localStorage.getItem('currentQuestion') && localStorage.getItem('quizStatus') == 0)
        {
            var quest_no=localStorage.getItem('currentQuestion');
            if(quest_no)
            {
                getQuestions();
            }
            else{

            }
        }
        else{
           location.href="../index.php";
        }
   

    $('#questionForm').on('submit', function(e) {
        e.preventDefault();
        var selectedOption = $('input[name="quest_options"]:checked').val();
        quest_no=localStorage.getItem('currentQuestion');
        if(selectedOption)
        {
            getQuestions(selectedOption);
        }
       
      
    });

    function getQuestions(selectedOption=null)
    {
       
        let user_id=localStorage.getItem('id');
        $.ajax({
            type: 'POST',
            url: './submit_answers.php',
            data: { answer: selectedOption,quest_count:quest_no,user_id:user_id },
            success: function(response) {
              if(response.status)
              {
                if(response.cur_quest > 5)
                {
                    location.href="../pages/confirm.php"
                }
                
                $("#question").text(response.question)
                $(".options").empty();
                $(".options").html(response.input)
                localStorage.setItem('currentQuestion',response.cur_quest);
                
              }
              else{
                alert(response.message)
              }
            },
            error: function(err) {
                console.log(err)
                alert('An error occurred while submitting the answer.');
            }
        });
    }

})
</script>
</body>
</html>

