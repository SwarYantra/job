<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <title>Registered User</title>
    <?php
    include_once "phpmailer/src/send_email.php";
    include_once "../class/mysql_function.php";
    include_once "../class/company_registration_class.php";
    include 'navbar.php';
    ?>
</head>
<body>
<img src="images/Logo.PNG" height="90px">
<div id="web_title">User List</div>
<div class="company_holder">
    <table class="company_table">
        <tr><td>Registered Companies</td></tr>
        <tr class="company_table_heading">
            <td>Registration Id</td>
            <td>Registration Code</td>
            <td>Email Id</td>
            <td>Phone Number</td>
            <td>Company Name</td>
            <td>Registration Type</td>
            <td>Status</td>
            <td>Operation</td>
        </tr>
        <?php
        $db = new Database;
        $companies = new CompanyRegistration();
        $companies->setStatus('sent');
        $res = $companies->select($db);
        $count = count($res);
        for ($i = 0; $i < $count; $i++) {
            $companyObj = new CompanyRegistration();
            $companyObj->populate($res[$i]);
            file_put_contents("php://stderr", "The Current object is:".print_r($companyObj, true));
            echo "<tr class=\"company_table_data\"><td>" .
                $companyObj->getRegistrationId() . "</td><td>".
                $companyObj->getRegistrationCode()."</td><td>".
                $companyObj->getEmailId()."</td><td>".
                $companyObj->getPhoneNumber()."</td><td>".
                $companyObj->getCompanyName()."</td><td>".
                $companyObj->getRegistrationType()."</td><td>".
                $companyObj->getStatus()."</td>".
                "<td><a href='delete_company.php?company_id=".$companyObj->getRegistrationId(). "'><img src='images/delete.png' height='20px' title='Delete'></a></td>";
    }
        ?>
    </table>
</div>

<div class="company_holder">
    <table class="company_table">
        <tr><td>Approved Companies</td></tr>
        <tr class="company_table_heading">
            <td>Registration Id</td>
            <td>Registration Code</td>
            <td>Email Id</td>
            <td>Phone Number</td>
            <td>Company Name</td>
            <td>Registration Type</td>
            <td>Status</td>
            <td>Operation</td>
        </tr>
        <?php
        $db = new Database;
        $companies = new CompanyRegistration();
        $companies->setStatus('approved');
        $res = $companies->select($db);
        $count = count($res);
        for ($i = 0; $i < $count; $i++) {
            $companyObj = new CompanyRegistration();
            $companyObj->populate($res[$i]);
            file_put_contents("php://stderr", "The Current object is:".print_r($companyObj, true));
            echo "<tr class=\"company_table_data\"><td>" .
                $companyObj->getRegistrationId() . "</td><td>".
                $companyObj->getRegistrationCode()."</td><td>".
                $companyObj->getEmailId()."</td><td>".
                $companyObj->getPhoneNumber()."</td><td>".
                $companyObj->getCompanyName()."</td><td>".
                $companyObj->getRegistrationType()."</td><td>".
                $companyObj->getStatus()."</td>".
                "<td><a href='delete_company.php?company_id=".$companyObj->getRegistrationId(). "'><img src='images/delete.png' height='20px' title='Delete'></a>&nbsp;&nbsp;&nbsp;<a href='phpmailer/src/send_email.php?company_id=".$companyObj->getRegistrationId(). "'><img src='images/email.png' title='Email' height='20px'></a></td>";
        }
        ?>
    </table>
</div>

<div class="company_holder">
    <table class="company_table">
        <tr><td>Created Companies</td></tr>
        <tr class="company_table_heading">
            <td>Registration Id</td>
            <td>Registration Code</td>
            <td>Email Id</td>
            <td>Phone Number</td>
            <td>Company Name</td>
            <td>Registration Type</td>
            <td>Status</td>
            <td>Operation</td>
        </tr>
        <?php
        $db = new Database;
        $companies = new CompanyRegistration();
        $companies->setStatus('created');
        $res = $companies->select($db);
        $count = count($res);
        for ($i = 0; $i < $count; $i++) {
            $companyObj = new CompanyRegistration();
            $companyObj->populate($res[$i]);
            file_put_contents("php://stderr", "The Current object is:".print_r($companyObj, true));
            echo "<tr class=\"company_table_data\"><td>" .
                $companyObj->getRegistrationId() . "</td><td>".
                $companyObj->getRegistrationCode()."</td><td>".
                $companyObj->getEmailId()."</td><td>".
                $companyObj->getPhoneNumber()."</td><td>".
                $companyObj->getCompanyName()."</td><td>".
                $companyObj->getRegistrationType()."</td><td>".
                $companyObj->getStatus()."</td>".
                "<td><a href='delete_company.php?company_id=".$companyObj->getRegistrationId(). "'><img src='images/delete.png' height='20px' href='google.com' title='Delete'></a>&nbsp;&nbsp;&nbsp;<a href='update_status.php?company_id=".$companyObj->getRegistrationId()."&status=approved'><img src='images/approved.png' height='20px' title='Approve'></a></td>";
        }
        ?>
    </table>
</div>

</body>
</html>