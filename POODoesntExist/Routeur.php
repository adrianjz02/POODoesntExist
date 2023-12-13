<?php

class Routeur {
    private $page;

    public function __construct($page) {
        $this->page = $page;
    }


    public function route() {
        switch ($this->page) {
            case 'contact':
                include 'contact.php';
                break;
            case 'form':
                include 'form.php';
                break;
            default:
                echo 'Page not found : 404';
                break;
        }
    }
}

?>
