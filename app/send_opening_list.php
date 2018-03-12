<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/8/2018
 * Time: 3:15 PM
 */
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 12:46 PM
 */
/*
 * request:{"lastDate":0,"userFlag":1,"userId":"12"}
 */

header('Content-type: application/zip');
header('Content-disposition: attachment; filename=../data/opening.zip');
header('Location:../data/opening.zip');

require_once "../class/required_documnets_class.php";
require_once "../class/mysql_function.php";
require_once "../class/company_class.php";
require_once "../class/skill_class.php";
require_once "../class/responsibility_class.php";
require_once "../class/opening_class.php";
require_once "../support/opening_list_support.php";

if (isset($_POST['jsonString'])) {
    $zipName = "../data/opening.zip";
    $db = new database;
    $count = 0;

    $absLogoPathArr = array();
    $actualLogoPathArr = array();

    $decode = json_decode($_POST["jsonString"]);
    if ($decode) {
        $opening_list = getOpeningList($decode->lastDate);///It is fine getting Result in associative array....
        $count = count($opening_list);
        $arr_res = array();

        file_put_contents('php://stderr', "Total Opening Count ".print_r($count,true));
        for ($k = 0; $k < $count; $k++) {
            $opening = new Opening();
            $skill = new Skill();
            $responsibility = new Responsibility();
            $hrCompany = new Company();
            $clientCompany = new Company();

            $opening->populate($opening_list[$k]);

            $responsibility->setOpeningId($opening->getOpeningId());
            $skill->setOpeningId($opening->getOpeningId());
            $hrCompany->setCompanyId($opening->getHrId());
            $hrCompany->setType("Hr");
            $clientCompany->setCompanyId($opening->getClientId());
            $clientCompany->setType("Other");

            $responsibility_arr = $responsibility->selectList($db);//Returns Responsibility List....
            $skill_arr = $skill->selectList($db);
            $hrCompanyArr = $hrCompany->selectList($db);//Array of Hr Companies..

            $hrCompany->populate($hrCompanyArr[0]);
            $hrCompanyList = $hrCompany->getJsonData();

            $clientCompanyArr = $clientCompany->selectList($db);//Array of Client Companies..
            $clientCompany->populate($clientCompanyArr[0]);//This has All Info about client

            if(!empty($clientCompany->getLogoPath())) {
                $absLogoPathArr[] = $clientCompany->getLogoPath();
                //To get Logo Path and combine with id....
                $absLogoPath = $clientCompany->getLogoPath();
                $reversedParts = explode('/', strrev($absLogoPath), 2);
                $logoName = strrev($reversedParts[0]);
                $logoName = $clientCompany->getCompanyId() . "/" . $logoName;
                $actualLogoPathArr[] = $logoName;

                $clientCompany->setLogoPath($logoName);
            }

            $clientCompanyObj = $clientCompany->getJsonData();

            $opening->setResponsibilities($responsibility_arr);
            $opening->setSkills($skill_arr);
            $opening->setClientCompany($clientCompanyObj);
            $opening->setHrCompany($hrCompanyList);

            $docs=$opening->getRequiredDocumentList();
            $docsList=array();
            $requiredDocumentList=array();
            $docsList = explode(",",$docs);

            $countDocs = count($docsList);
            for($j=0;$j<$countDocs;$j++) {
                $requiredDocument = new RequiredDocument();
                $requiredDocument->setDocumentId($j+1);
                $requiredDocument->setDocumentName($docsList[$j]);
                $requiredDocumentList[] = $requiredDocument;
            }

            $opening->setRequiredDocumentList($requiredDocumentList);

            $arr_res[]=$opening->getJsonData();
        }
        file_put_contents('php://stderr', "Existing the Loop ".print_r(count($arr_res),true));
        $response['openingList'] = $arr_res;
        $json = json_encode($response);

        file_put_contents("../data/opening.txt", $json);
        zipFiles($absLogoPathArr, $zipName, $actualLogoPathArr);
    }
}

function zipFiles($companyImage, $zipName, $actualLogoPathArr)
{
    $count = count($companyImage);
    file_put_contents('php://stderr', "\nNumber of  : " . $count);

    $zip = new ZipArchive;
    if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
        for ($i = 0; $i < $count; $i++) {
            $zip->addFile($companyImage[$i], $actualLogoPathArr[$i]);
        }
        $zip->addFile("../data/opening.txt", "opening.txt");
        $zip->close();
    }
}
?>