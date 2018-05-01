<?php

//////////////////////////////
// multiple-choice answers

$mc_answers = $_POST['multi'];

// multiple-choice corrects
$corrects = array();


$correct0 = $_POST['correct0'];

if (!empty( $correct0)) {
    array_push($corrects,$correct0);
}

$correct1 = $_POST['correct1'];

if (!empty( $correct1)) {
    array_push($corrects,$correct1);
}

$correct2 = $_POST['correct2'];

if (!empty( $correct2)) {
    array_push($corrects,$correct2);
}

$correct3 = $_POST['correct3'];

if (!empty( $correct3)) {
    array_push($corrects,$correct3);
}

$correct4 = $_POST['correct4'];

if (!empty( $correct4)) {
    array_push($corrects,$correct4);
}

$correct5 = $_POST['correct5'];

if (!empty( $correct5)) {
    array_push($corrects,$correct5);
}

$correct6 = $_POST['correct6'];

if (!empty( $correct6)) {
    array_push($corrects,$correct6);
}

$correct7 = $_POST['correct7'];

if (!empty( $correct7)) {
    array_push($corrects,$correct7);
}

$correct8 = $_POST['correct8'];

if (!empty( $correct8)) {
    array_push($corrects,$correct8);
}

$correct9 = $_POST['correct9'];

if (!empty( $correct9)) {
    array_push($corrects,$correct9);
}

$corrects = array_unique($corrects);

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
    <h2 class="header">Answers</h2>
    <div class="table-responsive-md">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Your Answers</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($mc_answers as $answer) :?>
          <tr>
            <td><?php echo $answer ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Correct Answers</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($corrects as $correct) :?>
        <tr>
          <td><?php echo $correct ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>