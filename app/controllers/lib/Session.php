<?php

class Session {

    public function __construct() {
        //session_start();
    }

    public function flash($key, $value) {
        session_cache_expire(1);
        $_SESSION[$key] = $value;
    }

}
