<?php

require_once __DIR__ . './Db.php';

class Schedule extends DB {

    public function Schedule() {
        parent::Db();
    }

    public function getSchedule($team_id) {

        $select_schedule_time = "select s.schedule_id ,s.team_1_name ,s.team_2_name,s.schedule_date from schedule_view s  
            where (s.team_1=$team_id or s.team_2=$team_id) and s.schedule_date>=now() order by s.schedule_date ASC limit 1;
";

        $runselect_schedule_time = mysqli_query($this->db, $select_schedule_time);
        

        $nextMatch = [];
        if ($runselect_schedule_time) {
            while ($rs = mysqli_fetch_assoc($runselect_schedule_time)) {
                $nextMatch = $rs;
            }
        }
        return $nextMatch;
    }

}
