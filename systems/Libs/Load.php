<?php

class Load
{
    public function __construct() {

    }

    public function view($FileName)
    {
        include 'apps/Views/'. $FileName . '.php';
    }
    public function model($FileName)
    {
        include 'apps/Models/' . $FileName . '.php';
        return new $FileName();
    }
}
?>
