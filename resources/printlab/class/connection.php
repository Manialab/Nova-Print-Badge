<?php
class Database
{
    private $host = "localhost";
    private $db_name = "alulaemdeinfo_db";
    private $username = "alulaemdeinfo_user";
    private $password = "38@@oije*Y#$&IHie38H&UGHiu3kms32y8info";

    public $conn;
    public function dbConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
