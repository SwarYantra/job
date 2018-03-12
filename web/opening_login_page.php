<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>
        Upload the Written Test Json...
    </title>
</head>
<body>
<div id="holder">
    <form action="test_list_page.php" method="post" enctype="multipart/form-data">
        <input type="text" name="opening_id" required placeholder="Enter Opening Id">
        <input type="file" name="test_file" title="Choose file to upload" accept=".json" required>
        <input type="submit" title="Submit">
    </form>
</div>
</body>
</html>
