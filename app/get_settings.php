<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 12:46 PM
 */
/* request:{"applicationName":"The Campaigner","versionCode":1,"versionLastDate":1517900121632}
response:{"functionalAreas":"HR,IT,Android,php,java,test,Sales,good,Production,BPO,New,IT Development",
"versionList":[{"versionId":2,"versionLastDate":1509600742000,"versionName":"new","versionCode":1,"applicationName":null},
{"versionId":3,"versionLastDate":1512648912000,"versionName":"new","versionCode":11,"applicationName":null},
{"versionId":8,"versionLastDate":1544184912000,"versionName":"new","versionCode":13,"applicationName":null}]}
*/
require "../class/mysql_function.php";
require "../class/settings_class.php";

if(isset($_POST['jsonString'])) {
    $db = new Database;
    $setting=new Setting;
    $settingList=array();
    $arr_response=array();
    $decoded = json_decode($_POST['jsonString']);
    if(!empty($decoded)) {
        $setting->setApplicationName($decoded->applicationName);
        $result=$setting->selectList($db);
        if(is_array($result)){
            $count=count($result);
            for($i=0;$i<$count;$i++){
                $setting1=new Setting;
                $setting1->populate($result[$i]);
                $json=$setting1->getVersionList();
            }
            echo $json;
        }
        else{
            echo "null";
        }
    }
}
?>