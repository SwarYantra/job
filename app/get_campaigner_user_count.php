<?php
require "../class/mysql_function.php";
require "../class/campaigner_user_count_class.php";
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 12:45 PM
 */
/*
 * Request: {"applicationName":"The Campaigner","versionCode":1,"versionLastDate":1517833061787}
 */

/* Response:
{"campaignerUserCountList":[
{"referenceCode":"NITISH23","openingId":313,"totalShareCount":3,"selectCount":1,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":314,"totalShareCount":1,"selectCount":0,"rejectCount":1},
{"referenceCode":"NITISH23","openingId":318,"totalShareCount":3,"selectCount":1,"rejectCount":1},
{"referenceCode":"NITISH23","openingId":316,"totalShareCount":3,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":319,"totalShareCount":3,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":315,"totalShareCount":1,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":317,"totalShareCount":2,"selectCount":1,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":320,"totalShareCount":1,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":321,"totalShareCount":1,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":325,"totalShareCount":1,"selectCount":0,"rejectCount":1},
{"referenceCode":"NITISH23","openingId":327,"totalShareCount":1,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":329,"totalShareCount":1,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":332,"totalShareCount":1,"selectCount":0,"rejectCount":1},
{"referenceCode":"NITISH23","openingId":352,"totalShareCount":1,"selectCount":0,"rejectCount":0},
{"referenceCode":"NITISH23","openingId":326,"totalShareCount":1,"selectCount":0,"rejectCount":0}
]}

*/
if(isset($_POST['jsonString'])) {
    $db = new Database;
    $campaignerCount=new CampaignerUserCount;
    $campaignerCountList=array();
    $arr_response=array();
    $decoded = json_decode($_POST['jsonString']);
    if(!empty($decoded)) {
        $campaignerCount->setReferenceCode($decoded->referenceCode);
        $result=$campaignerCount->selectList($db);
        if(is_array($result)){
            $count=count($result);
            for($i=0;$i<$count;$i++){
                $campaignerCount1=new CampaignerUserCount;
                $campaignerCount1->populate($result[$i]);
                $temp=$campaignerCount1->getJsonData();
                array_push($arr_response,$temp);
            }
            $response['campaignerUserCountList']=$arr_response;
            $json=json_encode($response);
            echo $json;
        }
        else{
            echo "null";
        }
    }
}
?>