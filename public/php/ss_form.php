<?php

// single-select answer
$ss_answer = $_POST['single'];

// single-select correct
$correct = $_POST['correct'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/scrivener.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Answer</title>
</head>
<body>
  <div class="container">
    <h2 class="header">Answer</h2>
    <div class="table-responsive-md">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Your Answer</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $ss_answer ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Correct Answer</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $correct ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>