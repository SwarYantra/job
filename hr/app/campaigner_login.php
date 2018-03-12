<?php
/**
 * Created by Shivam.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 12:44 PM
 */
require "../../class/mysql_function.php";
require "../../class/adminuser_class.php";
/*
 *
 *Request:
 * $_POST['jsonString']='{"emailId":"nitishkumar@gmail.com","password":"nitish12"}
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
        if(is_array($result) && $result!=null){
            $count=count($result);
            for($i=0;$i<$count;$i++){
                $adminUser1=new AdminUser();
                $adminUser1->populate($result[$i]);
                $temp=$adminUser1->getJsonData();
            }
            $json=json_encode($temp);
            echo $json;
        }
        else{
            echo "null";
        }
    }
}
?>



