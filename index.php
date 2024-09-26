<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href="./styles/main.css"  type="text/css"/>
    <title>Quiz App</title>
</head>
<body>
    <div class="form-wrapper">
            <form id="startQuizForm">
                <label for="name">Enter Your Name:</label>
                <input type="text" id="name" name="name" required>
                <button type="submit">Start Quiz</button>
            </form>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#startQuizForm').on('submit', function(e) {
        e.preventDefault();
        var name = $('#name').val();
        
        $.ajax({
            type: 'POST',
            url: './pages/start_quiz.php',
            data: { name: name },
            success: function(response) {
                if(response.status)
                {
                    localStorage.setItem('id',response.id);
                    localStorage.setItem('currentQuestion',1);
                    localStorage.setItem('quizStatus',0);
                    localStorage.setItem('name',name)
                    window.location.href = './pages/quiz.php';

                }
                else{
                    alert('something went wrong');
                }
            }
        });
    });
</script>

</body>
</html>
