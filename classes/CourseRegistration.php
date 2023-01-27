<?php
require_once("Database.php");

class CourseRegistration extends Database
{
    public function store($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));
        $implodePlaceholder = implode(", :", array_keys($fields));
        $sql = "INSERT INTO course_registration($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->open()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TrUe;
        }
    }

    public function course_registrations()
    {
        $sql = "SELECT 
        course_registration.id AS cos_reg_id, 
        course_registration.student_id AS stud_id, 
        course_registration.course_ids AS cos_reg_ids, 
        course_registration.date AS cos_reg_date, 
        course_registration.status AS cos_reg_stat, 

        students.fullname AS cos_reg_fullname, 
        students.reg_num AS cos_reg_num, 
        students.level AS cos_reg_level

        FROM course_registration LEFT JOIN students 
        ON course_registration.student_id = students.id 

        ORDER BY course_registration.id DESC";

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

    public function my_registration($id)
    {
        $sql = "SELECT * FROM course_registration WHERE `student_id` = '$id' ORDER BY id DESC";

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
        $sql = "UPDATE course_registration 
        SET
        status=:status  
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
