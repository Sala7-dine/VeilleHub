<?php 

class db {

    protected $conn;

    public function __construct()
    {
    
            $this->conn = new PDO("mysql:host=localhost;dbname=viellehub", "root", "");
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
    }

}