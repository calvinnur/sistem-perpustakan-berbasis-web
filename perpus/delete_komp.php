<?php 
require_once('library.php');
$call = new perpus;

$id = $_GET['id'];

$call->komplain_delete($id);
header('location:admin.php?page=complain');

?>