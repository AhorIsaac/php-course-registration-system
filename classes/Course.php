<?php
require_once("Database.php");

class Course extends Database
{
    public function store($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));
        $implodePlaceholder = implode(", :", array_keys($fields));
        $sql = "INSERT INTO courses($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->open()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TrUe;
        }
    }

    public function courses()
    {
        $sql = "SELECT * FROM courses ORDER BY id DESC";

        $result = $this->open()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return faLSE;
        }
    }

    public function my_courses($level)
    {
        $sql = "SELECT * FROM courses WHERE level = '$level' ORDER BY id DESC";

        $result = $this->open()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return faLSE;
        }
    }

    public function course_($id)
    {
        $sql = "SELECT * FROM courses WHERE id = $id";
        $stmt = $this->open()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function course_added_already($code)
    {
        $sql = "SELECT code FROM courses WHERE code = '$code' ";
        $stmt = $this->open()->prepare($sql);
        $stmt->bindValue(":code", $code);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function update($fields, $id)
    {
        $sql = "UPDATE courses 
        SET title=:title, 
        code=:code, 
        unit=:unit, 
        lecturer=:lecturer,
        level=:level  
        WHERE 
        id = '$id' ";

        $stmt = $this->open()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return True;
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM courses WHERE id = $id";
        $stmt = $this->open()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmtExec = $stmt->execute();
        if ($stmtExec) {
            return trUE;
        }
    }
}
