<?PHP
SESSION_START();
unset($_SESSION['admin_id']);
header("location:index.mgb");
?>