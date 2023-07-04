<?
error_reporting(1);
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "isleescapes"; /* Database name */
$con = mysqli_connect($host, $user, $password,$dbname);
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
define("PROJECT_TITLE", "ISLE ESCAPES");
$NOW = date("Y-m-d H:i:s");
?>