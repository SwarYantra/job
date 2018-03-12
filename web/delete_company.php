
<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/17/2018
 * Time: 12:58 PM
 */
include_once "../class/company_registration_class.php";
include_once "../class/mysql_function.php";
///Post=company_id
if(isset($_GET['company_id'])){
    $companyId=$_GET['company_id'];
    $company=new CompanyRegistration();
    $db=new Database();
    $company->setRegistrationId($companyId);
    $company->delete($db);
    echo "<script>location.href ='company_register.php'</script>";
}
?>