<?php
include 'functions.php';
if(isset($_POST['add-comment'])){
  add_comment();
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

  <div class="search-box">
    <form method="post">
      <input type="text" id="search-field" name="search-field" placeholder="Search project by name"><br><br>
      <input type="submit" id="search-btn" name="search-btn" value="Search">
    </form>
  </div>

  <?php
  if(isset($_POST['search-btn'])){
    get_project_by_name();
  }
  else{
    get_projects();
  }
  ?>
  
</body>
</html>