<?php
function error404($info = null)
{
    $view = new View();
    $view->load('public/error404');
}