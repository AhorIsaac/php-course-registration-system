<?php 
require_once("Database.php"); 

class Student extends Database 
{
    public function store($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));
        $implodePlaceholder = implode(", :", array_keys($fields));
        $sql = "INSERT INTO students($implodeColumns) VALUES(:".$implodePlaceholder.") ";

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

    public function students() 
    {
        $sql = "SELECT * FROM students ORDER BY id DESC";
        
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

    public function valid_registration_number($registration_number) 
    {
        $sql = "SELECT * FROM students WHERE `reg_num` = '$registration_number' ";
        
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

    public function login($registration_number, $password) 
    {
        $sql = "SELECT * FROM students 
        WHERE 
        `reg_num` = '$registration_number' AND `password` = '$password' ";
        $stmt = $this->open()->prepare($sql);
        $stmt->bindValue(":registration_number", $registration_number);
        $stmt->bindValue(":password", $password); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;                
    }

}
