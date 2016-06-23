<?php
/**
 * Created by PhpStorm.
 * User: jenish
 * Date: 02-05-2016
 * Time: PM 04:53
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="front_end/css/app.css" rel="stylesheet" type="text/css" media='all'>
    <script data-main="front_end/js/entry.js" src="front_end/js/vendor/require.js"></script>
    <title><?= $name ?></title>
</head>
<body>
<div class="container">
    <div data-ng-view=""></div>
</div>
<input type="hidden" id="hdnRootUrl" value="<?= $base_url ?>">
</body>
</html>
