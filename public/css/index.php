<?php
//Url root
define('URLROOT', 'http://localhost/mvc-app/');
//Page redirect
function redirect($page)
{
    header('Location: ' . URLROOT . '' . $page);
}
redirect('');