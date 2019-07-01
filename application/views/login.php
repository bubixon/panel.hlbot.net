<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>HLBot.net | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo base_url('/assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo base_url('/assets/vendors/themify-icons/css/themify-icons.css'); ?>" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?php echo base_url('/assets/css/pages/auth-light.css'); ?>" rel="stylesheet" />
</head>

<body class="bg-silver-300">
<div class="content">
    <div class="brand">
        <a class="link" href="index.html"><b>HL</b>bot</a>
    </div>
    <?php echo viewMessage(); ?>
    <?php echo form_open(base_url('/login'), array('id' => 'login_form')); ?>
        <h2 class="login-title">Logowanie</h2>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" type="email" value="<?php echo set_value('email'); ?>" name="email" placeholder="Email" autocomplete="off">
                <?php echo form_error('email'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                <input class="form-control" type="password" name="password" placeholder="Hasło">
                <?php echo form_error('password'); ?>
            </div>
        </div>
        <div class="form-group d-flex justify-content-between">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox">
                <span class="input-span"></span>Zapamiętaj mnie</label>
            <a href="forgot_password.html">Zapomniałeś Hasła?</a>
        </div>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Zaloguj</button>
            <?php echo form_close(); ?>
        </div>
        <div class="social-auth-hr">
        </div>
        <div class="text-center">Nie masz konta?
            <a class="color-blue" href="<?php echo base_url('/register'); ?>">Stwórz je</a>
        </div>
</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS -->
<script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS -->
<script src="./assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="assets/js/app.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<script type="text/javascript">
    $(function() {
        $('#login-form').validate({
            errorClass: "help-block",
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            highlight: function(e) {
                $(e).closest(".form-group").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group").removeClass("has-error")
            },
        });
    });
</script>
<script src="https://www.google.com/recaptcha/api.js?render=6LdWf6kUAAAAAN41Jum0W7vjWzjx3IeJTNysb3Aq"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6LdWf6kUAAAAAN41Jum0W7vjWzjx3IeJTNysb3Aq', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>
</body>

</html>