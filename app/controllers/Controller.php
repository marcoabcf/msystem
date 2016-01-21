<?php

include_once('lib/Input.php');
include_once('lib/Session.php');

class Controller {

    protected $input;
    protected $session;

    public function __construct() {
        $this->input = new Input;
        $this->session = new Session;
    }

}
