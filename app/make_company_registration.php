<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 12:45 PM
 */
/*Request:{"city":"Efupjgcxff",
"emailId":"dhkgaehiki@fjkbg.con",
"line1":"Zgjouttcbh","line2":"Sdhkbvshjk",
"name":"Sgjkhdghj",
"phoneNumber":"7662488962",
"pinCode":"552240",
"registrationId":0,"registrationType":"campaigner",
"state":"Sdgkluyfdxc"}


Response:{"registrationId":56,
"registrationCode":"OGKPSU79",
"emailId":"dhkgaehiki@fjkbg.con",
"phoneNumber":"7662488962","companyName":"","registrationType":"campaigner","json":""}
*/
require "../class/mysql_function.php";
require "../class/adminuser_class.php";
require "../class/company_registration_class.php";
require "../class/address_class.php";

if (isset($_POST['jsonString'])) {
    $db = new Database;
    $address = new Address;
    $companyRegistration = new CompanyRegistration;

    $decoded = json_decode($_POST['jsonString']);
    if (!empty($decoded)) {

        $companyRegistration->setEmailId($decoded->emailId);

        $res = $companyRegistration->select($db);//check whether user exists or not...

        if (count($res) != 0) {
            echo "false";
        } else {
            //Send Password to emailId

            $address->setPincode($decoded->pinCode);
            $address->setState($decoded->state);
            $address->setCity($decoded->city);
            $address->setLine1($decoded->line1);
            $address->setLine2($decoded->line2);
            $addressJson = json_encode($address->getJsonData());

            $companyRegistration->setEmailId($decoded->emailId);
            $companyRegistration->setPhoneNumber($decoded->phoneNumber);
            $companyRegistration->setCompanyName($decoded->name);
            $companyRegistration->setStatus('created');
            $companyRegistration->setRegistrationType($decoded->registrationType);

            $companyRegistration->setJson($addressJson);
            $companyRegistration->insert($db);

            $result = json_encode($companyRegistration->getJsonData());
            echo $result;
        }
    }
}
?>