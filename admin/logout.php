<?php
session_start();
session_destroy();
//you can change index.php with any url\\

   echo '<script>top.location.href="index.php"</script>';
?>