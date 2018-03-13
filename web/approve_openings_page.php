<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/12/2018
 * Time: 12:49 PM
 */
include_once "../class/mysql_function.php";
include_once "../class/JsonMapper.php";
include_once "../class/Question.php";
include_once "../class/Section.php";
include_once "../class/Test.php";
include_once "../class/WrittenTest.php";
include_once "../class/WrittenTestList.php";
include_once "../class/opening_class.php";

function printLog($msg, $obj)
{
    file_put_contents('php://stderr', $msg . print_r($obj, true) . "\n");
}

$db = new Database();
$openingObj = new Opening();
$openingObj->setStatus('created');
$listObj = $openingObj->selectList($db);
$openingList = $openingObj->populateFromDatabase($listObj);
printLog("This is Length of Returned List: ", count($openingList));
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>
        Unapproved openings
    </title>
</head>
<body>
<div class="company_holder">
    <table class="company_table">
        <tr>
            <td>
                Unapproved Openings
            </td>
        </tr>
        <tr class="company_table_heading">
            <td>Opening Id</td>
            <td>Designation</td>
            <td>Location</td>
            <td>Functional Area</td>
            <td>Test Uploaded</td>
            <td>Operation</td>
        </tr>

        <?php
        for ($i = 0; $i < count($openingList); $i++) {
            $opening = new Opening();
            $opening->populate($openingList[$i]);
            ?>
            <tr class="company_table_data">
                <form method="post">
                    <input type="hidden" name="opening_id" value="<?php echo $opening->getOpeningId() ?>">
                    <td><?php echo $opening->getOpeningId() ?></td>
                    <td><?php echo $opening->getDesignation() ?></td>
                    <td><?php echo $opening->getLocation() ?></td>
                    <td><?php echo $opening->getFunctionalArea() ?></td>
                    <?php if ($opening->getWrittenTest()!=null) {
                        echo "<td>Yes</td>";
                    } else {
                        echo "<td>No</td>";
                    } ?>
                    <td><input type="image" title="Approve" class="imageButton" src="images/approved.png" height="20px"
                               style="width: auto;
                               margin:0;
                               padding:  0px;
                               border: 0px;
                               border-radius:  0px;
                               font-size:  0px;">
                    </td>

                </form>
            </tr>
        <?php }
        if (isset($_POST['opening_id'])) {
            $openingId = $_POST['opening_id'];
            $db = new Database;
            $openingObj = new Opening();

            $openingObj->setOpeningId($openingId);
            $listObj = $openingObj->selectList($db);
            $openingList = $openingObj->populateFromDatabase($listObj);
            $openingObj->populate($openingList[0]);

            $fileCount = 0;
            while ($fileCount < 10) {
                $jsonMapper = new JsonMapper();
                $writtenTestJson = $openingObj->getWrittenTest();
                $obj = json_decode($writtenTestJson);
                $writtenTest = $jsonMapper->map($obj, new WrittenTest());;

                foreach ($writtenTest->writtenTest->writtenTestList as $testList) {
                    foreach ($testList->sectionList as $sectionNameObj) {
                        $attemptCount = $sectionNameObj->attemptCount;///Total number of questions.....
                        $randomQuestionsNumList = array_rand($sectionNameObj->questionList, $attemptCount);
                        $randomQuestionsList = array();
                        for ($k = 0; $k < $attemptCount; $k++) {
                            if ($attemptCount == 1)
                                $randomQuestionsList[$k] = $sectionNameObj->questionList[$randomQuestionsNumList];
                            else
                                $randomQuestionsList[$k] = $sectionNameObj->questionList[$randomQuestionsNumList[$k]];
                        }
                        $sectionNameObj->questionList = $randomQuestionsList;
                    }
                }
                $writtenTestJson = json_encode($writtenTest);

                if (!is_dir("../data/test_json/" . $openingId)) {
                    mkdir("../data/test_json/" . $openingId);
                }
                file_put_contents("../data/test_json/" . $openingId . "/writtenTest" . $fileCount . ".json", $writtenTestJson);
                $fileCount++;
            }
            $openingObj->setStatus('approved');
            $openingObj->update($db);
            echo "<script>location.href='approve_openings_page.php'</script>";
        }
        ?>
    </table>
</div>
</body>
</html>
