<?php
//Absulte path
require_once __DIR__.'./Db.php';

class Roles extends DB {

    public function Roles() {
        parent::Db();
    }

    public function getRoleByRoleId($role_id) {

        $query = "select * from roles where role_id=" . $role_id;
        $runQuery = mysqli_query($this->db, $query);
        
        $role_name = "";
        if ($runQuery) {
            while ($rs = mysqli_fetch_assoc($runQuery)) {
                $role_name = $rs['role_name'];
            }
        }
        return $role_name;
    }
    public function getRoles() {
        $query = "select * from roles";
        $runQuery = mysqli_query($this->db, $query);
        $role = [];
        if ($runQuery) {
            while ($rs = mysqli_fetch_assoc($runQuery)) {
                $role[] = $rs;
            }
        }
        return $role;
    }

}


 