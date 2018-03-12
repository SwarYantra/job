<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/8/2018
 * Time: 1:05 PM
 */
require_once "../class/mysql_function.php";

function getOpeningList($lastDate)
{
    $db = new Database;
    $db->connect();
    $epochDate = time()*1000;

    file_put_contents('php://stderr', "Current Time is :  ".print_r($epochDate,true));
    $query = "SELECT * FROM opening WHERE create_date > ? AND application_end_date > ? AND status= ?";
    $value = array();
    $value[count($value)] = $lastDate;
    $value[count($value)] = $epochDate;
    $value[count($value)] = "approved";
    $type = 'iis';

    $db->selectWithPreparedQuery($query, $value, $type);
    $result = $db->result;
    file_put_contents('php://stderr', "Total result is:  ".print_r(count($result),true));
    $opening = new Opening();
    $list = $opening->populateFromDatabase($result);
    file_put_contents('php://stderr', "Total list is:  ".print_r(count($list),true));
    return $list;
}
?>