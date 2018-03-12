<?php

///Post=company_id
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

if (isset($_GET['company_id'])) {
    try {
        require_once "../../../class/mysql_function.php";
        require_once "../../../class/adminuser_class.php";
        require_once "../../../class/company_registration_class.php";

        $companyId = $_GET['company_id'];
        $company = new CompanyRegistration();
        $db = new Database();
        $adminUser = new AdminUser();
        $company->setRegistrationId($companyId);
        $res = $company->select($db);
        $company->populate($res[0]);
        $company->setStatus('sent');
        $company->update($db);

        $adminUser->setMailId($company->getEmailId());
        $adminUser->setUserName($company->getCompanyName());
        $adminUser->setUserRole($company->getRegistrationType());
        $adminUser->setReferenceCode($company->getRegistrationCode());
        $adminUser->setPassword($adminUser->getReferenceCode());
        $adminUser->insert($db);

        $mail = new PHPMailer();
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'swaryantra@gmail.com';                 // SMTP username
        $mail->Password = 'shivam123';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('swaryantra@gmail.com', 'Swar Yantra Technologies, Faridabad');
        $mail->addAddress($company->getEmailId(), $company->getCompanyName());     // Add a recipient 'paytmu1@gmail.com'
        $mail->addReplyTo('swaryantra@gmail.com', 'Reply');
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Password for The Campaigner app';
        $mail->Body = 'Hello' . $company->getCompanyName() . '<br>Thanks for registering on The Campaigner App
        <br>Kindly use this password : '.$company->getRegistrationCode().'<br>Regards<br>Team Swar Yantra';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
            echo "<script>location.href ='../../company_register.php'</script>";
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>