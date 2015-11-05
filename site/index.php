<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>Hello World in public_html?</h1>
<?php
$space = "<br>";
echo "Hello PHP! redirected" . $space;
echo $_SERVER["DOCUMENT_ROOT"] . $space;
echo $_SERVER["HTTP_HOST"] . $space;
?>
<img src="img/layout/crush-test-dummies.png">
</body>
</html>