<?php

include 'dbconfig.php';

$login = '';
$passwd = '';

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    if (isset($_POST['password'])) {
        $passwd = $_POST['password'];
    } else {
        echo 'Password required. Please try again.';
        echo <<<HTML
        <a href='login.html'>Try again</a>
        HTML;
    }
} else {
    echo 'Username required. Please try again.';
    echo <<<HTML
    <a href='login.html'>Try again</a>
    HTML;
}
