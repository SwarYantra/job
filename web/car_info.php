<?php
include_once "../class/mysql_function.php";
include_once "../class/car_class.php";
if (isset($_POST["serverId"])) {

    $serverId = $_POST['serverId'];
    $car = new Car();
    $db = new DataBase();
    $car->setServerCarId($serverId);
    $result = $car->select($db);
    $car->populate($result[0]); ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <title>Detail of the CAR</title>
    </head>
    <body>
    <div id="holder">
        <b>Contents of the CAR</b>
        <form method="post">
            <input type="hidden" name="serverCarId" value="<?php echo $_POST['serverId']; ?>">
            <input type="text" name="context" placeholder="Context" required value="<?php echo $car->getContext(); ?>">
            <input type="text" name="action" placeholder="Action" required value="<?php echo $car->getContext(); ?>">
            <input type="text" name="result" placeholder="Result" required value="<?php echo $car->getContext(); ?>">
            <input type="text" name="reject_message" placeholder="Reject Message">
            <?php if(!empty($car->getAudioPath())){
                ?>Audio:
                <audio controls>
                    <source src="<?php echo $car->getAudioPath();?>" type="audio/wav">
                </audio>
            <?php }?>
            <br><br>
            <input type="radio" value="processed" name="status" required style="width:auto"> Approve &nbsp;&nbsp;&nbsp;
            <input type="radio" value="rejected" name="status" required style="width:auto"> Reject<br>
            <input type="submit" value="Submit">
        </form>
    </div>
    </body>
    </html>
    <?php
} else if(isset($_POST['context'],$_POST['action'],$_POST['result'],$_POST['status'])) {
    $serverCarId=$_POST['serverCarId'];
    $action=$_POST['action'];
    $context=$_POST['context'];
    $result=$_POST['result'];
    $rejectMessage=$_POST['reject_message'];
    $status=$_POST['status'];
    $carObj =new Car();
    $carObj->setServerCarId($serverCarId);
    $carObj->setAction($action);
    $carObj->setContext($context);
    $carObj->setResult($result);
    $carObj->setRejectMessage($rejectMessage);
    $carObj->setStatus($status);
    $carObj->update($db);
} else {
    echo "Please Login....";
} ?>