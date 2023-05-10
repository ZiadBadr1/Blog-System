<?php

class Post
{
    private $pdo ; 
    private $table = "posts";
    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }


    public function createPost($title , $content , $userid)
    {
        $query = "INSERT INTO posts (title , content , user_id) VALUES (:title , :content, :userid)";
        try{
        $stat  = $this->pdo->prepare($query);
        $stat->bindParam(":title",$title);
        $stat->bindParam(":content",$content);
        $stat->bindParam(":userid",$userid);
        $stat->execute();
        return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function readAllPosts()
    {

        $query = 'SELECT posts.* , users.username FROM posts LEFT JOIN users
        ON(posts.user_id = users.id) ORDER BY posts.created_at DESC' ;
              try {
                // Prepare the SQL statement for execution
                $stmt = $this->pdo->prepare($query);
    
                // Execute the prepared statement
                $stmt->execute();
    
                // Fetch the results as an associative array
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                // Return the results
                return $results;
            } catch(PDOException $e) {
                // Handle any exceptions that may occur during the query execution
                echo $e->getMessage();
                return false;
            }
    }
    public function readonePost($id)
    {

        $query = 'SELECT  p.title, p.content, p.created_at ,u.username as user_id from '. $this->table .' p  INNER JOIN users u 
        ON(p.user_id = u.id) where p.id = :id' ;
              try {
                // Prepare the SQL statement for execution
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(":id",$id);
                // Execute the prepared statement
                $stmt->execute();
                
                // Fetch the results as an associative array
                $results = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Return the results
                return $results;
            } catch(PDOException $e) {
                // Handle any exceptions that may occur during the query execution
                echo $e->getMessage();
                return false;
            }
    }
    public function delete($id)
    {
        $query = "DELETE from ".$this->table . " where id = :id";
        try{
        $stmt = $this->pdo->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id  );
        $stmt->execute();

      
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return true;
    } catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        
    }

    public function update($title , $content , $id)
    {
        $query = "UPDATE " .$this->table . " SET title = :title , content = :content where id = :id";
         try{
        $stmt = $this->pdo->prepare($query);
        $title = htmlspecialchars(strip_tags($title));
        $content = htmlspecialchars(strip_tags($content));
        $id = htmlspecialchars(strip_tags($id));

        
        $stmt->execute(array(":title"=>$title , ":content" => $content , ":id"=>$id));
        return true;
    
        }
         catch(PDOException $e)
         {
            echo $e->getMessage();
            return false;
         }
        
    }
    
    
    
    
}


?>