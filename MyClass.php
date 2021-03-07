<?php
//======================class=================

class MyClass {
    // ===============constructor==========

    public function today() {
        echo date("yy-m-d");
    }
    
    static function dob(){
        echo date("yy-m-d H:i");
    }

}
// calling object. when class is calling  object then constructor will exhicuted first ========

MyClass::dob();