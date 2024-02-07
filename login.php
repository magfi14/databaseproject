<?php

$reference = 'CPS3740.Customers';
$ip_prefix = 10;

$login = '';
$password = '';

if (isset($_POST['login'])) $login = $_POST['login'];
else {
    echo 'Username required.';
    echo <<<HTML
    <a href='login.html'>Try again</a>
    HTML;
}

$passwd = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];
$ipv4 = explode('.', $ip);
if ($ipv4[0] == 10 || ($ipv4[0] == 131 && $ipv4[1] == 125)) {
    echo <<<html
    You are from: <b>Kean University.</b>
    html;
} else echo <<<html
    You are <b>not</b> from Kean University.
    html;

echo $ip_prefix . "<br>\n";

include 'dbconfig.php';

$con = mysqli_connect($host, $username, $password, $dbname) or die("<br>Cannot connect to DB: $dbname on $host, error: " . mysqli_connect_error());

$sql = "select * from $reference ";
$sql_login = $sql . " where login = $login ";
$sql_password = $sql . " where password = $password ";
$sql_whole = $sql . " where login = $login and password = $password ";

function exists($connection, $query)
{
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    return $count > 0;
}

if (!exists($con, $sql_login))
    die("Login $login doesn't exist in the database.");
elseif (!exists($con, $sql_password))
    die("Login $login exists, but password not matches.");
