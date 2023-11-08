<?php
class IndexController implements IController{
    public function index()
    {
        $data = "daniel";
        View::load('public/index', compact('data'));
    }
}