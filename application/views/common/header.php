<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>roens</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">

    <script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li id="navbar-main"><a href="<?php echo site_url() ?>">首页</a></li>
                <li id="navbar-photography"><a href="<?php echo site_url("photography") ?>">摄影</a></li>
                <li id="navbar-essay"><a href="#">文字</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php if (isset($active_navbar)) {?>
<script>
    $(function() {
        var nav_active = "<?php echo $active_navbar;?>";
        $("ul.navbar-nav li#"+nav_active).addClass("active");
    });
</script>
<?php }?>
<div class="container">