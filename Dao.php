<?php
// Dao.php
// class for saving and getting comments from MySQL
class Dao {

  private $host = "qao3ibsa7hhgecbv.cbetxkdyhwsb.us-east-1.rds.amazonaws.com"; 
  private $db = "avputsxw71qsfmas";
  private $user = "wkf0d1a1okt0wv1s";
  private $pass = "ciw26b898kemzy9a";

  public function getConnection () {

    return
      new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user,
          $this->pass);
  }

  public function getUser($userid){
    $conn = $this->getConnection();
        $saveQuery =
            sprintf("SELECT * FROM Users
            WHERE UserID = :userid");
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":userid", $userid);
        $q->execute();
        $user = $q->fetch();

        if($user){
          return $user;
        }
        else {
          return FALSE;
        }
      return FALSE;
  }

  public function newUser($userName, $email, $password){
    try{
      $conn = $this->getConnection();
      $saveQuery =
            "INSERT INTO Users
            (Email, Username, PasswordHash)
            VALUES
            (:email, :userName, :password)";
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":email", $email);
        $q->bindParam(":userName", $userName);
        $q->bindParam(":password", $password);
        $q->execute();
       
      } catch (PDOException $e) {
      // Handle database query execution error
        die("Database query failed: " . $e->getMessage());
      }
    }
    
      public function authenticate ($email, $password) {
        // TODO make an actual table.
        $conn = $this->getConnection();
        $saveQuery =
            sprintf("SELECT * FROM Users
            WHERE email = :email");
        $q = $conn->prepare($saveQuery);
        $q->bindParam(":email", $email);
        $q->execute();
        $user = $q->fetch();

        if($user){
          if(password_verify($password, $user["PasswordHash"])){
            return $user;
          }
          else{
            return FALSE;
          }
        } else {
          return FALSE;
        }

     }

     public function addPost($userId, $title, $content) {
      $conn = $this->getConnection();
      $saveQuery = "INSERT INTO Posts (UserID, Title, Content) VALUES (:userId, :title, :content)";
      $q = $conn->prepare($saveQuery);
      $q->bindParam(":userId", $userId);
      $q->bindParam(":title", $title);
      $q->bindParam(":content", $content);
      $q->execute();
  }
  
  public function getMostRecentPost() {
    $conn = $this->getConnection();
    $query = "SELECT * FROM Posts ORDER BY CreatedAt DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->rowCount() > 0) {
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    return null;
}

public function getPostById($postid){
  $conn = $this->getConnection();
      $saveQuery =
          sprintf("SELECT * FROM posts
          WHERE PostID = :postid");
      $q = $conn->prepare($saveQuery);
      $q->bindParam(":postid", $postid);
      $q->execute();
      $post = $q->fetch(PDO::FETCH_ASSOC);

      if($post){
        return $post;
      }
      else {
        return FALSE;
      }
    return FALSE;
}
}

//