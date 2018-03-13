<?php
include_once "../class/mysql_function.php";
include_once "../class/opening_class.php";
include_once "../class/WrittenTestList.php";
include_once "../class/Test.php";
include_once "../class/WrittenTest.php";
include_once "../class/JsonMapper.php";
include_once "../class/Question.php";
include_once "../class/Section.php";

if (isset($_POST['opening_id'], $_FILES['test_file'])) {
    $openingId = $_POST['opening_id'];
    $fileName = $_FILES['test_file']['tmp_name'];
    $jsonFile = file_get_contents($fileName);
    $encodedString = utf8_encode($jsonFile);///Encoded String.....
    $obj = json_decode($encodedString);
    if ($obj instanceof \stdClass) {
        $mapper = new JsonMapper();
        $writtenTest = $mapper->map($obj, new WrittenTest());
        ?>
        <!DOCTYPE html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="style/form-style.css">
            <link rel="stylesheet" type="text/css" href="style/style.css"/>
            <title>
                Test Questions
            </title>
        </head>
        <body>
        <form method="post">
            <?php
            foreach ($writtenTest->writtenTest->writtenTestList as $testList) {
                ?>
                <div class="wrap-form">
                    <div class="test-title">
                        <?php echo $testList->evaluationType; ?>
                    </div>
                    <?php
                    foreach ($testList->sectionList as $sectionNameObj) {
                        ?>
                        <div class="section-title">Subject: <?php echo $sectionNameObj->name; ?></div>
                        Total Questions:&nbsp; <?php echo count($sectionNameObj->questionList) ?><br>
                        Attempt Count: &nbsp;&nbsp;<input
                                type="number"
                                class="section-input"
                                value="<?php echo $sectionNameObj->attemptCount; ?>"
                                max="<?php echo count($sectionNameObj->questionList) ?>"
                                name="<?php echo $sectionNameObj->id . '_attempt_count' ?>"
                        >
                        &nbsp;&nbsp;&nbsp;
                        Total Time:&nbsp;&nbsp;<input
                                type="number"
                                class="section-input"
                                value="<?php echo $sectionNameObj->totalTime; ?>"
                                name="<?php echo $sectionNameObj->id . '_total_time' ?>"
                        >&nbsp;in milliseconds
                        <div class="section-description"><?php echo $sectionNameObj->description; ?></div>
                        <?php
                        foreach ($sectionNameObj->questionList as $questionObj) {
                            ?>
                            <br>Question:<br>
                            <textarea
                                    rows="2"
                                    cols="20"
                                    disabled><?php echo $questionObj->questionText; ?></textarea><br>
                            <?php
                            if (isset($questionObj->options)) {
                                if (is_array($questionObj->options)) {
                                    foreach ($questionObj->options as $options) {
                                        ?>
                                        <input
                                                type="checkbox"
                                                value="<?php echo $options ?>"
                                                disabled>&nbsp; <?php echo $options ?><br>
                                    <?php }
                                }
                            }
                        }
                    }
                    ?>
                </div>
            <?php }

            ?>
            <div class="wrap-form">
                <textarea name="encoded_string" style="display: none"><?php echo $encodedString?></textarea>
                <input type="hidden" value="<?php echo $openingId ?>" name="opening_id">
                <input type="submit" value="Save">
            </div>
        </form>
        </body>
        </html>
    <?php } else {
        echo "Json not valid.....";

    }
}
else if(isset($_POST['opening_id'],$_POST['encoded_string']))
{
    $opening_id=$_POST['opening_id'];
    $jsonString=$_POST['encoded_string'];
    $obj=json_decode($jsonString);
    $mapper = new JsonMapper();
    $writtenTest = $mapper->map($obj, new WrittenTest());
    foreach ($writtenTest->writtenTest->writtenTestList as &$testList){
        $testList->openingId=$opening_id;
        foreach ($testList->sectionList as &$sectionListUpd){
            $sectionListUpd->attemptCount=$_POST[$sectionListUpd->id."_attempt_count"];
            $sectionListUpd->totalTime=$_POST[$sectionListUpd->id."_total_time"];
        }
    }
    $updatedJson=json_encode($writtenTest);
    file_put_contents('php://stderr',"The Updated Json is:".$updatedJson);
    $db=new Database();
    $opening=new Opening();
    $opening->setOpeningId($opening_id);
    $opening->setWrittenTest($updatedJson);
    $opening->update($db);
    header('Location:opening_login_page.php');
}
?>

