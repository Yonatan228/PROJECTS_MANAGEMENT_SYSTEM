<?php
include 'functions.php';
if(isset($_POST['add-project'])){
  add_project();
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Document</title>
</head>
<body>

  <div class="title-panel">
      PROJECTS &nbsp MANAGEMENT &nbsp SYSTEM
  </div>

  <div class="header">
    <a href="projects.php">All Projects</a>
    <a href="add-project.php">Add Project</a>
  </div>

  <form method="post">
    <div class="add-project-box-container">
      <div class="add-project-box">
        <div>
          <label for="project-name">Add Project Name: </label><br><br>
          <input type="text" id="project-name" name="project-name" placeholder="project name *" required>
          <br><br><br>
          <label for="project-url">Add Project URL: </label><br><br>
          <input type="text" id="project-url" name="project-url" placeholder="project url *" required>
          <br><br><br>
          <label for="project-comment">Add a Comment (optional): </label><br><br>
          <input type="text" id="project-comment" name="project-comment" placeholder="comment">
          <br><br><br>
          <label for="comment-img1">Add Comment Picture (optional): </label><br><br>
          <input type="file" id="comment-img1" name="comment-img" style="padding-top: 8px;">
        </div>
        <div>
          <label for="project-status">Select Project Status: </label><br><br>
          <select name="project-status" id="project-status">
            <option value="active">Active</option>
            <option value="terminated">Terminated</option>
            <option value="canceled">Canceled</option>
          </select>
          <br><br><br>
          <label for="project-img">Add Project Picture: </label><br><br>
          <input type="file" id="project-img" name="project-img" style="padding-top: 8px;" required>
          <br><br><br>
          <label for="project-date">Select Project End Date: </label><br><br>
          <input type="date" id="project-date" name="project-date" required>
          <br><br><br><br>
          <input type="submit" id="add-project" name="add-project" value="Add Project">
        </div>
     </div>
   </div>
  </form>
  
</body>
</html>