<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/27/2018
 * Time: 2:16 PM
 */
include_once "../class/mysql_function.php";
include_once "../class/company_class.php";
include_once "../class/adminuser_class.php";
include_once "../class/hr_client_class.php";
include_once "../class/hr_client_reviewer_class.php";
include 'navbar.php';
session_start();
if (isset($_SESSION['hrId'])) {
    $hrId = $_SESSION['hrId'];
    $db = new Database();
    $hrClientList = array();
    $hrClient = new HrClientRelation();
    $hrClient->setHrId($hrId);
    $hrClientList = $hrClient->select($db);
    ?>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/style.css"/>
        <title>
            Welcome
        </title>
    </head>
    <body>
    <div id="holder">
        Add new Reviewer
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="hrId" value="<?php echo $hrId ?>">
            <input type="text" name="emailId" placeholder="Reviewer Email Id" required>
            <br>
            <input type="password" name="password" placeholder="Reviewer Password" required>
            <br>
            <select required name="client">
                <option selected='selected'>Choose One</option>
                <?php
                for ($i = 0; $i < count($hrClientList); $i++) {
                    $client = new HrClientRelation();
                    $client->populate($hrClientList[$i]);

                    $clientObj = new Company();
                    $clientObj->setCompanyId($client->getClientId());
                    $clientList = $clientObj->selectList($db);

                    $clientObj->populate($clientList[0]);
                    ?>
                    <option><?php echo $clientObj->getName() ?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Add Reviewer">
        </form>
    </div>

    </body>
    </html>
    <?php
} else {
    echo "<script>location.href='hr_login.php'</script>>";
}
if (isset($_POST['emailId']) && isset($_POST['password']) && isset($_POST['client'])) {
    $user = new AdminUser();
    $user->setMailId($_POST['emailId']);
    $user->setPassword($_POST['password']);
    $user->setUserRole("reviewer");
    $result = $user->select($db);

    if (!is_array($result)) {
        file_put_contents("php://stderr", "The User not found..");
        $user->insert($db);
        $result = $user->select($db);
    }

    $user->populate($result[0]);
    file_put_contents("php://stderr", "The Current User...");

    $companyObj = new Company();
    $companyObj->setName($_POST['client']);
    $companyList = $companyObj->selectList($db);
    $companyObj->populate($companyList[0]);

    $hrId = $_SESSION['hrId'];
    $clientId = $companyObj->getCompanyId();
    $reviewerId = $user->getUserId();

    $reviewer = new HrClientReviewer();
    $reviewer->setClientId($clientId);
    $reviewer->setHrId($hrId);
    $reviewer->setUserId($reviewerId);
    file_put_contents('php://stderr', "This is selected " . $_POST['client']);
    $reviewer->insert($db);
}
?>