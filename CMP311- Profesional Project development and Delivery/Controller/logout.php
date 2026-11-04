
<?php
session_start();
session_unset($_SESSION['uid']);
session_destroy();
session_write_close();
setcookie("cookie_your","cookie_value",time()-1);
header('Location: ../View/index.php');
?>
