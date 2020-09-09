<?php 
  class Light {
    // DB stuff
    private $conn;
    private $table = 'lights';

    // light Properties
    public $light_id;
    public $state;
    public $red;
    public $green;
    public $blue;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get all lights
    public function read() {
      // Create query
      $query = 'SELECT
                    light_strip.name,
                    lights.*
              FROM 
                    light_strip
              LEFT JOIN
                    lights on lights.light_strip_owner = light_strip.light_strip_id
              ORDER BY
                    light_strip_owner, light_id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single light
    public function read_single_light_array($light_array_num) {
          // Create query

          $query ='SELECT
                    light_strip.name,
                    lights.*
                    FROM light_strip
                    right JOIN lights on lights.light_strip_owner = light_strip.light_strip_id
                    where light_strip_owner = :light_array_num
                    ORDER BY light_id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);          

            // Bind ID to first parameter
            $stmt->bindParam(':light_array_num', $light_array_num);
        //   $query = 'SELECT c.name as category_name, 
        //             p.light_id, 
        //             p.category_id, 
        //             p.title, 
        //             p.body, 
        //             p.author, 
        //             p.created_at
        //            FROM ' . $this->table . ' p
        //            LEFT JOIN
        //             categories c ON p.category_id = c.id
        //            WHERE
        //             p.light_id = ?
        //            LIMIT 0,1';

        //   // Prepare statement
        //   $stmt = $this->conn->prepare($query);

        //   // Bind ID to first parameter
        //   $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          return $stmt;

        //   $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //   // Set properties
        //   $this->title = $row['title'];
        //   $this->body = $row['body'];
        //   $this->author = $row['author'];
        //   $this->category_id = $row['category_id'];
        //   $this->category_name = $row['category_name'];
    }

    // Create light
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update light
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete light
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }