<?php
include_once "../class/mysql_function.php";
include_once "../class/adminuser_class.php";
include_once "../class/company_class.php";
include_once "../class/hr_client_reviewer_class.php";
include 'navbar.php';
session_start();
if (isset($_SESSION['hrId'])) {
    $hrId = $_SESSION['hrId'];
    ?>

    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script>
            function formSubmit(userId, clientId, hrId) {
                document.forms[0].clientId.value = clientId;
                document.forms[0].hrId.value = hrId;
                document.forms[0].userId.value = userId;
                document.forms[0].submit();
            }
        </script>
        <title>
            Reviewer List
        </title>
    </head>
    <body>
    <div class="company_holder">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="hidden" name="clientId" value="-1">
            <input type="hidden" name="hrId" value="-1">
            <input type="hidden" name="userId" value="-1">
            <table class="company_table">
                <tr>
                    <td> List of all Reviewers</td>
                </tr>
                <tr class="company_table_heading">
                    <td> Client Name</td>
                    <td> Reviewer</td>
                    <td> Operation</td>
                </tr>
                <?php
                $db = new Database();
                $reviewerObj = new HrClientReviewer();
                $reviewerObj->setHrId($hrId);
                $reviewerList = $reviewerObj->select($db);
                for ($i = 0; $i < count($reviewerList); $i++) {
                    $reviewer = new HrClientReviewer();
                    $reviewer->populate($reviewerList[$i]);

                    $companyObj = new Company();
                    $companyObj->setCompanyId($reviewer->getClientId());
                    $companyList = $companyObj->selectList($db);

                    $companyObj->populate($companyList[0]);

                    $adminObj = new AdminUser();
                    $adminObj->setUserId($reviewer->getUserId());
                    $adminList = $adminObj->select($db);

                    $adminObj->populate($adminList[0]);

                    echo "<tr class=\"company_table_data\"><td>" .
                        $companyObj->getName() . "</td><td>" .
                        $adminObj->getMailId() . "</td>" .
                        "<td><a href=\"javascript:formSubmit(" . $reviewer->getUserId() . ',' . $reviewer->getClientId() . ',' . $hrId . ");\"><img src='images/delete.png' height='20px' title='Delete'></a></td>";
                }
                ?>
            </table>
        </form>
    </div>
    </body>
    </html>
    <?php
    if (isset($_POST['clientId']) && isset($_POST['userId']) && isset($_POST['hrId'])) {
        $reviewerTemp = new HrClientReviewer();

        $reviewerTemp->setHrId($_POST['hrId']);
        $reviewerTemp->setClientId($_POST['clientId']);
        $reviewerTemp->setUserId($_POST['userId']);
        $reviewerTemp->delete($db);
        header("Refresh:0");

    }
} else {
    echo "<script>location.href='hr_login.php'</script>";
}
?>