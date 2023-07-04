<?
if ($_SESSION['TRANSFER_NAME']=="") {
    header("location: login");
    die();
}