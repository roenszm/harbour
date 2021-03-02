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
    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>

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
            <?php if (!$this->session->has_userdata('user_id')) { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">
                            <small>注册</small>
                        </a>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">
                            <small>登录</small>
                        </a>
                    </li>
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
                                    <div class="form-group email-form-group">
                                        <label>邮箱</label>
                                        <input type="email" class="form-control" required name="user_email"
                                               placeholder="请输入邮箱">
                                    </div>
                                    <div class="form-group">
                                        <label>密码</label>
                                        <input type="password" class="form-control" required minlength="6"
                                               name="user_password" placeholder="请输入密码">
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="keep_login"> 保持登录
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary user-login-btn" type="submit">登录</button>
                                        <button class="btn btn-default" data-dismiss="modal">取消</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $this->session->userdata('user_name'); ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="logout()">登出</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
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