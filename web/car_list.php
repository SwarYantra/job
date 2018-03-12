<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/7/2018
 * Time: 2:36 PM
 */
include_once "../class/mysql_function.php";
include_once "../class/car_class.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>
        Created CAR List
    </title>
</head>
<body>
<div id="holder">
    <b>Select a CAR to review<b>
    <?php
    $db = new Database();
    $car = new Car();
    $car->setStatus('review_request');
    $carList = $car->select($db);
    ?>
    <form method="post" action="car_info.php">
        <?php for ($i = 0; $i < count($carList); $i++) {
            $carObj = new Car();
            $carObj->populate($carList[$i]);
            file_put_contents('php://stderr', "The Car Object is: " . $carObj->getServerCarId());
            ?>
            <input type="submit" name="serverId" value="<?php echo $carObj->getServerCarId();?>">
        <?php }
        ?>
    </form>
</div>
</body>
</html>
