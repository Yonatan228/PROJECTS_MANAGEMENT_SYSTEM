<?php


class Dao{

  protected $conn;

  function db_connect(){
    $this->conn = mysqli_connect("localhost", "root", "","project_management_db");
    if(!$this->conn){
      $this->handle_error();
    }
  }


  function Close_conn(){
    $this->conn->close();
  }


  function handle_error(){
    die("DATABASE ERROR: " . mysqli_error($this->conn));
  }


  public static function create_db(){
    $conn = mysqli_connect("localhost","root", "");
    if(!$conn){
      die("ERROR: Unable to connect to database. " . mysqli_error($conn));
    }
    $query = "CREATE DATABASE IF NOT EXISTS project_management_db;";

    $query .= "use project_management_db;";

    $query .= "CREATE TABLE IF NOT EXISTS users(
                user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_email VARCHAR(100) NOT NULL,
                user_password CHAR(128) NOT NULL
                );";

    //CREATE STATIC USER:
    $email = "user1@mail.com";
    $password = hash('sha256', '1234');
    $query .= "INSERT INTO users(user_email, user_password) VALUES('$email', '$password');";


    $query .= "CREATE TABLE IF NOT EXISTS projects(
                project_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                project_name varchar(100) NOT NULL,
                project_url varchar(255) NOT NULL,
                project_img varchar(100) NOT NULL,
                project_status varchar(20) DEFAULT 'active' CHECK (project_status IN ('active', 'terminated', 'canceled')),
                end_date DATE NOT NULL
                );";

    $query .= "CREATE TABLE IF NOT EXISTS comments(
                comment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                project_id INT UNSIGNED NOT NULL,
                comment text NOT NULL,
                time_created  varchar(30) NOT NULL,
                comment_img varchar(100)
                );";

    $result = $conn->multi_query($query);
    if(!$result){
      die("ERROR: Unable to create database. " . mysqli_error($conn));
    }

    $conn->close();
  }
}





class UserDao extends Dao{

  function get_user($email){
    $this->db_connect();
    $query = "select * from users where user_email='$email';";
    $result = mysqli_query($this->conn, $query);
    if(!$result){
      $this->handle_error();
    }
    $this->Close_conn();
    $row = mysqli_fetch_assoc($result);
    return $row;
  }
}





class ProjectDao extends Dao{

  function add_project($data){
    $this->db_connect();
    $query = "INSERT INTO projects(project_name, project_url, project_img, project_status, end_date)
              VALUES('{$data['project-name']}', '{$data['project-url']}', '{$data['project-img']}',
              '{$data['project-status']}', '{$data['project-date']}');";
    $result = mysqli_query($this->conn, $query);
    if(!$result){
      $this->handle_error();
    }
    if($data['project-comment'] != ''){
      $query = "SELECT project_id from projects where project_url='{$data['project-url']}';";
      $result = mysqli_query($this->conn, $query);
      if(!$result){
        $this->handle_error();
      }
      $row = mysqli_fetch_assoc($result);
      $this->Close_conn();
      $this->add_comment($row['project_id'], $data['project-comment'], $data['comment-img']);
    }
    else{
      $this->Close_conn();
    }  
  }

  function get_all_projects(){
    $this->db_connect();
    $query = "select * from projects";
    $result = mysqli_query($this->conn, $query);
    if(!$result){
      $this->handle_error();
    }
    $this->Close_conn();
    return $result;
  }

  function add_comment($project_id, $comment, $image){
    $this->db_connect();
    $date = date('d-m-y h:ia');
    $query = "INSERT INTO comments(project_id, comment, time_created, comment_img)
               VALUES('$project_id', '$comment', '$date', '$image');";
    $result = mysqli_query($this->conn, $query);
    if(!$result){
      $this->handle_error();
    }
    $this->Close_conn();
  }

  function get_comments($project_id){
    $this->db_connect();
    $query = "select * from comments where project_id='$project_id'";
    $result = mysqli_query($this->conn, $query);
    if(!$result){
      $this->handle_error();
    }
    $this->Close_conn();
    return $result;
  }


  function get_project_by_name($name){
    $this->db_connect();
      $query = "select * from projects where project_name='$name'";
      $result = mysqli_query($this->conn, $query);
      if(!$result){
        $this->handle_error();
      }
      $this->Close_conn();
      return $result;
  }
}




?>