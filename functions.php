<?php
include 'classes-dao.php';

session_start();


function login(){
  $db = new UserDao();
  $email = $_POST['email'];
  $password = $_POST['password'];
  $result = $db->get_user($email);

  if($result){
    $hash_password = hash('sha256', $password);
    if(hash_equals($hash_password, $result['user_password'])){
      $_SESSION['logged-in'] = true;
      header("Location: projects.php");
    }
    else{
      echo "<script>alert('Invalid password')</script>";
    }
  }
  else{
    echo "<script>alert('Invalid email')</script>";
  }
}



function add_project(){
  if (!$_SESSION["logged-in"]) {
    header("Location: login.php");
  }

  $db = new ProjectDao();
  $result = $db->add_project($_POST);
  echo "<script>alert('Project has been created successfully')</script>";
}



function add_comment(){
  if (!$_SESSION["logged-in"]) {
    header("Location: login.php");
  }

  $db = new ProjectDao();
  $db->add_comment($_GET['id'], $_POST['new-comment'], $_POST['comment-img']);
}



function get_projects(){
  if (!$_SESSION["logged-in"]) {
    header("Location: login.php");
  }

  $db = new ProjectDao();
  $project_result = $db->get_all_projects();

  if(!mysqli_num_rows($project_result)){
    echo "<div class='no-projects'>NO PROJECTS HERE YET</div>";
  }
  else{
    while($project_row = mysqli_fetch_assoc($project_result)){
      $comment_result = $db->get_comments($project_row['project_id']);
      display_project($project_row, $comment_result);
    }
  }
}



function get_project_by_name(){
  if (!$_SESSION["logged-in"]) {
    header("Location: login.php");
  }

  $db = new ProjectDao();
  $project_result = $db->get_project_by_name($_POST['search-field']);

  if(!mysqli_num_rows($project_result)){
    echo "<div class='no-projects'>No projects found by that name</div>";
  }
  else{
    while($project_row = mysqli_fetch_assoc($project_result)){
      $comment_result = $db->get_comments($project_row['project_id']);
      display_project($project_row, $comment_result);
    }
  }
}





function display_project($project_row, $comment_result){
  
  echo "<div class='project-box-container'>
  <div class='project-box'>
    <div>
      <ul>
        <li><b>Name: </b>{$project_row['project_name']}</li><br>
        <li><a href='{$project_row['project_url']}' style='text-decoration: underline;'>Project Link</a></li><br>
        <li><b>Status: </b>{$project_row['project_status']}</li><br>
        <li><b>End Date: </b>{$project_row['end_date']}</li><br>";
  while($comment_row = mysqli_fetch_assoc($comment_result)){
    echo "<li><b>Commented on {$comment_row['time_created']}: </b><br>";
    if($comment_row['comment_img'] != ''){
      echo "<img src='img/{$comment_row['comment_img']}' width='70'><br>";
    }
    echo "{$comment_row['comment']}</li><br>";
  }
  echo "</ul><br>
        <form action='projects.php?id={$project_row['project_id']}' method='post'>
          <input type='text' id='new-comment' name='new-comment' placeholder='Add new comment *' required><br><br>
          <label for='comment-img2'>Add Comment Picture (optional): </label><br><br>
          <input type='file' id='comment-img2' name='comment-img' style='padding-top: 3px;'><br><br>
          <input type='submit' id='add-comment' name='add-comment' value='Add Comment'><br><br>
        </form>
          </div>
          <div>
            <img src='img/{$project_row['project_img']}' width='200'> 
          </div>
        </div> 
      </div>
    </div>";
}


?>