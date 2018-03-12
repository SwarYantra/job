<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/17/2018
 * Time: 1:22 PM
 */
include_once "../class/company_registration_class.php";
include_once "../class/mysql_function.php";
//Post=id
if(isset($_GET['company_id'])){
    $companyId=$_GET['company_id'];
    $status=$_GET['status'];

    $db=new Database();
    $company=new CompanyRegistration();
    $company->setRegistrationId($companyId);
    $company->setStatus($status);
    $company->update($db);
    echo "<script>location.href ='company_register.php'</script>";

}
?>