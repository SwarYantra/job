<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/7/2018
 * Time: 3:01 PM
 */
require "../../class/mysql_function.php";
require "../../class/adminuser_class.php";
/**
 * * $_POST['jsonString']='{"emailId":"nitishkumar@gmail.com","password":"nitish12","newPassword":"somePass"}
Response: {"userId":12,"mailId":"nitishkumar@gmail.com","password":"nitish12","userRole":"campaigner","referenceCode":"NITISH23"}'
 * */
if(isset($_POST['jsonString'])) {
    $db = new Database;
    $adminUser=new AdminUser;
    $adminUserList=array();
    $arr_response=array();
    $decoded = json_decode($_POST['jsonString']);
    if(!empty($decoded)) {
        $adminUser->setMailId($decoded->emailId);
        $adminUser->setPassword($decoded->password);
        $result=$adminUser->select($db);
        if(is_array($result)){
            $count=count($result);
            for($i=0;$i<$count;$i++){
                $adminUser1=new AdminUser();
                $adminUser1->setMailId($decoded->emailId);
                $adminUser1->setPassword($decoded->newPassword);
                $adminUser1->update($db);
            }
            echo "successs";
        }
        else{
            echo "null";//Wrong Password...
        }
    }
}
////
?>