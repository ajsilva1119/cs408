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
  
  
}

//