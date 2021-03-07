<?php

//Absulte path
require_once __DIR__ . './Db.php';
require_once './classes/DbPdo.php';

class Roles extends DB {

    public function Roles() {
        parent::Db();
    }

    public function getRoleByRoleId($role_id) {

       $query = "select * from roles where role_id =:role_id";
        $stmt = DbPdo::connect()->prepare($query);
        $role_id =1 ;
        $stmt->bindParam("role_id", $role_id);
        $stmt->execute();
        if ($stmt) {

            while ($rs = $stmt->fetch()) {
                $role_name = $rs["role_name"];
            }
        }
        // print_r($role_name); 
        return $role_name;
    }

    public function getRoles() {
        $query = "select * from roles ";
        $stmt = DbPdo::connect()->prepare($query);
        $stmt->bindParam("role_id", $role_id);
        $stmt->execute();
        if ($stmt) {

            $role = $stmt->fetchAll();
               
            
        }
        //print_r($role);
        return $role;
    }

}

//$query = "select * from roles ";
//$stmt = DbPdo::connect()->prepare($query);
//$stmt->bindParam("role_id", $role_id);
//$stmt->execute();
//if ($stmt) {
//
//    while ($rs = $stmt->fetch()) {
//        $role[] = $rs;
//    }
//}
// 