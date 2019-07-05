<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Register</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
<div class="content">
    <div class="brand">
        <a class="link" href="/"><b>HL</b>bot</a>
    </div>
    <?php echo form_open(base_url('/register'), array('id' => 'register-form')); ?>
        <h2 class="login-title">Rejestracja</h2>
        <div class="form-group">
            <input class="form-control" name="email" type="email" placeholder="Email" autocomplete="off">
        </div>
        <div class="form-group">
            <input class="form-control" name="password" type="password" placeholder="Hasło">
        </div>
        <div class="form-group">
            <input class="form-control" name="passwordConf" type="password" placeholder="Potwierdź Hasło">
        </div>
        <div class="form-group text-left">
            <label class="ui-checkbox ui-checkbox-info">
                <input type="checkbox" name="agree">
                <span class="input-span"></span>Akceptuje regulamin serwisu</label>
        </div>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">Zarejestruj</button>
        </div>
        <div class="social-auth-hr">
        </div>
        <div class="text-center">Masz konto?
            <a class="color-blue" href="<?php echo base_url('/login'); ?>">Zaloguj się</a>
        </div>
    <?php echo form_close(); ?>
</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Ładowanie</div>
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
        $('#register-form').validate({
            errorClass: "help-block",
            rules: {
                first_name: {
                    required: true,
                    minlength: 2
                },
                last_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    confirmed: true
                },
                password_confirmation: {
                    equalTo: password
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
<script src="https://www.google.com/recaptcha/api.js?render=6Lft_6sUAAAAAIGM3N420LfGc8sltO8sNI4VLIYL"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6Lft_6sUAAAAAIGM3N420LfGc8sltO8sNI4VLIYL', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>
</body>

</html>