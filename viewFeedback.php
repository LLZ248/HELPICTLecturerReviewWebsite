<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Feedback</title>
    <style>
      html, body {
      overflow-x:hidden ;
    } 

    </style>
  </head>

  <body class="bg-secondary">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <a href="index.php" style="text-decoration: none;color:black;"><span class="material-icons" style="font-size: 48px;">home</span></a>
    <?php
    $lecturer_id = $_GET['lid'];
    $lecturer_name = null;
        include 'config.php';
        $conn = new mysqli($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        //SELECT LectName FROM LECTURER ORDER BY id DESC
        $sql = "SELECT LectName FROM LECTURER where LectID = '$lecturer_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $lecturer_name =$row["LectName"];
          }
        }else{
            $lecturer_name= "No Lecturer is selected.";
        }
    ?>
    <!-- Modal -->
    <div class="modal" id= "addFeedbackModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Your Feedback for <?php echo $lecturer_name;?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="GET" action="addFeedback.php">
                  <div class="form-group">
                      <label for="lid">maximum characters is 170</label>
                      <input name="lid" value="<?php echo $lecturer_id;?>" style="display:none;">
                      <textarea class="form-control" id="studentFeedback" name="studentFeedback" rows="5" maxLength="170"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <?php
        echo '<h1 class="display-1 text-center text-white">'.$lecturer_name.'<br><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addFeedbackModal">+Add</button></h1>';
        //SELECT LectName FROM LECTURER ORDER BY id DESC
        echo'<div class="d-flex flex-wrap">';
        $sql = "SELECT FMsg FROM feedback where LectId = '$lecturer_id' ORDER BY FId DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo '<div class="media p-3 m-1 bg-light">
              <div class="media-body">';
              echo $row["FMsg"];
              echo '</div></div>';
          }
        }
        echo '</div>';
        /*
        echo '<div class="p-2 bg-light m-2 shadow text-break" style ="width:200px;height:200px">';
        echo 'All SPAM will be reset on the another day';
        echo '</div>';
        */
        $conn->close();
      ?>
        
  </div>


  </body>
</html>