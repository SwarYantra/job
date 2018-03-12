<?php
include_once "../class/company_class.php";
include_once "../class/mysql_function.php";

if (isset($_POST['hrId'])) {
    $companyId = $_POST['hrId'];
    $company = new Company();
    $db = new Database;
    $company->setCompanyId($companyId);
    $result = $company->selectList($db);
    if (is_array($result)) {
        file_put_contents("php://stderr", "The Company Exists....");
        $company->populate($result[0]);
        session_start();
        $_SESSION['hrId'] = $_POST['hrId'];
        echo "<script/>location.href='hr_dashboard.php'</script>";
    }else{
        echo "<script>alert('Company Not Exists...')</script>";
    }

}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>
        HR Login....
    </title>
</head>
<div id="holder">
    Enter Your HR Id
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" name="hrId" placeholder="Enter HR id">
        <input type="submit" value="Submit">
    </form>
</div>
</html>