
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="../styles/main.css"  type="text/css"/>
    <title>Confirm</title>
</head>
<body>
    <div class="form-wrapper">
        <button class="cf-btn" id="confirm">Confirm</button>
        <button class="chng-btn" id="re-correct">Change Options</button>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    if(localStorage.getItem('id') && localStorage.getItem('currentQuestion') && localStorage.getItem('quizStatus')) {
        var quest_no = localStorage.getItem('currentQuestion');
        let confirm_url=null;
        if(!quest_no && quest_no <= 5) {
            location.href = "../index.php";
              
        } 

        if(localStorage.getItem('quizStatus') == 1)
        {
            location.href='../pages/results.php?id='+localStorage.getItem('id')
        }
    } else {
        location.href = "../index.php";
    }

    $(".cf-btn").on('click',function()
    {
        let confirm_url='../pages/results.php?id='+localStorage.getItem('id');
        location.href=confirm_url;
    })

    $(".chng-btn").on('click',function()
    {
        localStorage.setItem('currentQuestion',1)
        let change_url='../pages/quiz.php';
        location.href=change_url;

    })

    $('#questionForm').on('submit', function(e) {
        e.preventDefault();
        var selectedOption = $('input[name="quest_options"]:checked').val();
        quest_no = localStorage.getItem('currentQuestion');
        if(selectedOption) {
            getQuestions(selectedOption);
        }
    });
});
</script>
</body>
</html>
