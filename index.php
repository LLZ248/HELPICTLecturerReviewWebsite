<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Feedback</title>
    <style>
    html, body {
      overflow-x:hidden ;
    } 
    .btn-group-vertical{
      display: block;
    }
    </style>
  </head>

  

  <body class="container bg-secondary">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <h1 class="display-2 text-center text-white">Give Some Comments to Your Lecturers</h1>

    <div class="container">
        <?php
        include 'config.php';
        
        // Create connection
        $conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        //SELECT LectName FROM LECTURER ORDER BY id DESC
        $sql = "SELECT LectName FROM LECTURER";
        $result = $conn->query($sql);
        echo '<div class="mx-auto btn-group-vertical" style="width:300px">';
        $lid=1;
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo '<a role="button" class="px-2 btn btn-primary btn-lg" href="viewFeedback.php?lid='.$lid.'">';
              echo $row["LectName"];
              echo '</a>';
              $lid++;
          }
        } 
        echo '</div>';
        $conn->close();
      ?>
        
  </div>


  </body>
</html>