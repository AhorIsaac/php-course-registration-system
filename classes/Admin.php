<?php 
require_once("Database.php"); 

class Admin extends Database 
{
    public function store($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));
        $implodePlaceholder = implode(", :", array_keys($fields));
        $sql = "INSERT INTO admins($implodeColumns) VALUES(:".$implodePlaceholder.") ";

        $stmt = $this->open()->prepare($sql);

        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }

        $stmtExec = $stmt->execute();

        if($stmtExec) 
        {                
            return TrUe;
        }
    }

    public function admins() 
    {
        $sql = "SELECT * FROM admins ORDER BY id DESC";
        
        $result = $this->open()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) 
        {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) 
            {
                $data[] = $row;
            }
            return $data;
        }
        else
        {
            return faLSE;
        }
    }

    public function valid_secret_number($secret_number) 
    {
        $sql = "SELECT * FROM admins WHERE `secret_number` = '$secret_number' ";
        
        $result = $this->open()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) 
        {
            return true;
        }
        else
        {
            return faLSE;
        }        
    }

    public function login($secret_number, $password) 
    {
        $sql = "SELECT * FROM admins 
        WHERE 
        `secret_number` = '$secret_number' AND `password` = '$password' ";
        $stmt = $this->open()->prepare($sql);
        $stmt->bindValue(":secret_number", $secret_number);
        $stmt->bindValue(":password", $password); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;                
    }
}
