<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/28/2018
 * Time: 5:13 PM
 */
session_start();
session_unset();
session_destroy();
echo "<script>location.href='hr_login.php'</script>"
?>