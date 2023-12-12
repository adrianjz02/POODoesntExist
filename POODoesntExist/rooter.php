<?php

class rooter
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function run()
    {
        header("Location: " . $this->url);
        exit;
    }
}

?>