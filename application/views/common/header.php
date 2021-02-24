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

<nav class="navbar navbar-inverse navbar-no-radius">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url() ?>">Roens</a>
        </div>
        <div id="header-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li id="navbar-main"><a href="<?php echo site_url() ?>">首页</a></li>
                <li id="navbar-photography"><a href="<?php echo site_url("photography") ?>">摄影</a></li>
                <li id="navbar-essay"><a href="<?php echo site_url("essay") ?>">文字</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">
                        <small>注册</small>
                    </a></li>
                <li><a href="#" data-toggle="modal" data-target="#login-modal">
                        <small>登录</small>
                    </a></li>
            </ul>
            <!-- modal -->
            <div class="modal fade" id="login-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">登录</h4>
                        </div>
                        <div class="modal-body">
                            <form id="user-login">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="user_id" placeholder="邮箱">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="user_password" placeholder="密码">
                                </div>
                                <div class="form-group">

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 保持登录
                                        </label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <a class="btn btn-primary">登录</a>
                                    <a class="btn btn-default">取消</a>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php if (isset($active_navbar)) { ?>
    <script>
        $(function () {
            var nav_active = "<?php echo $active_navbar;?>";
            $("div#header-navbar ul.navbar-nav li#" + nav_active).addClass("active");
        });
    </script>
<?php } ?>
<div class="container">