<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/28/2018
 * Time: 11:57 AM
 */
session_start();
include_once "../class/settings_class.php";
include_once "../class/mysql_function.php";
include 'navbar.php';
$text_id = 0;
if (isset($_GET['settingId'])) {
    $db = new Database();
    $settingId = $_GET['settingId'];
    $setting = new Setting();
    $setting->setSettingId($settingId);
    $settingList = $setting->selectList($db);

    $setting->populate($settingList[0]);
    ?>
    <html>
    <head>
        <script language="javascript">
            function addTextBox() {
                var total_text=form1.getElementsByTagName("input").length;
                total_text=total_text+1;
                var container = document.getElementById("functionalArea_wrapper");
                var inpt = document.createElement("input");
                inpt.setAttribute("type", "text");
                inpt.setAttribute("class","functionBox");
                inpt.setAttribute("name", "functionalArea[]");
                inpt.setAttribute("placeholder", "Functional Area");
                inpt.setAttribute("id","textBox"+total_text);

                var cross = document.createElement("img");
                cross.setAttribute("src", "images/cross.png");
                cross.setAttribute("class", "crossBtn");
                cross.setAttribute("id","cross"+total_text);
                cross.setAttribute("onClick","removeTextBox("+total_text+")");

                container.appendChild(inpt);
                container.appendChild(cross);
            }
            function removeTextBox(id) {
                var box=document.getElementById('textBox'+id);
                var del=document.getElementById('cross'+id);
                var container = document.getElementById("functionalArea_wrapper");
                del.parentNode.removeChild(del);
                container.removeChild(box);
            }

        </script>

        <link rel="stylesheet" type="text/css" href="style/style.css" ;

    </head>
    <body>
    <div id="holder">
        Edit the Functional Areas
        <form name="form1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input name="settingId" type="hidden" value="<?php echo $settingId ?>">
            <div id="functionalArea_wrapper">
                <?php
                $functionAreasList = explode(',', $setting->getFunctionalAreas());
                foreach ($functionAreasList as $functionalArea) {
                    ?>
                    <input type="text" class="functionBox" name="functionalArea[]" placeholder="Functional Area"
                           value="<?php echo $functionalArea; ?>" id="<?php
                    $text_id = $text_id + 1;
                    echo 'textBox'.$text_id ?>"><img src="images/cross.png" class='crossBtn' id="<?php echo 'cross'.$text_id?>" onclick="javascript:removeTextBox(<?php echo $text_id?>)">
                    <?php
                }
                ?>
            </div>
            <input type="button" value="Add Functional Area" onclick="javascript:addTextBox()">
            <input type="submit" value="Submit">
        </form>
    </div>
    </body>
    </html>
    <?php
} else if (isset($_POST['functionalArea']) && isset($_POST['settingId'])) {
    $db = new Database();
    $functionAreaList = $_POST['functionalArea'];
    $settingId = $_POST['settingId'];
    $functionalAreaStr = implode(",", array_filter($functionAreaList));

    $settingObj = new Setting();
    $settingObj->setSettingId($settingId);
    $settingObj->setFunctionalAreas($functionalAreaStr);
    $settingObj->update($db);
    echo "<script>location.href='hr_dashboard.php'</script>";
} else {
    echo "Response Invalid...";
}
?>
