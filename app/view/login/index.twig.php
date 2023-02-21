<html>
<head>
    <title>izap | LOGIN </title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src='{{BASE}}js/login/login.js'></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{BASE}}vendor/sweetalert/sweetalert2@11.js"></script>
    <script src="{{BASE}}vendor/sweetalert/jquery.js"></script>
    <script src="{{BASE}}vendor/sweetalert/jquery.form.js"></script>
    <script src="{{BASE}}vendor/sweetalert/sweetalert.min.js"></script>
    <link href="{{BASE}}vendor/bootstrap/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style>
        .form-gap {
            padding-top: 70px;
        }

        body {
            background: url({{BASE}}img/login/backgground.avif) no-repeat;
            background-size: cover;
            
            
        }
        input[type="submit"].btn:hover {
            background: none;
        }

        #botao:hover {
            background: none;
        }
        string{
            margin-left:20px;
            font-size:20px;
        }
    </style>
</head>
<body>
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            
                            <h2 class="text-center">LOGIN</h2>
                            <p>Insira seu Usuário e Senha para Login no Sistema</p>
                            <div class="panel-body">
                                <form action="" role="form" class="form" method="post" onsubmit="if (grecaptcha.getResponse() == ''){
                                alert('Você não clicou no reCAPTCHA, por favor, faça!')
                                return false;
                                 }">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="E-MAIL" class="form-control" type="email" required>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="senha" name="senha" placeholder="Password" class="form-control" type="password" required>
                            
                                        </div>
                                        
                                    </div>
                                    <div class="g-recaptcha" data-sitekey="6LewA5UcAAAAAPYrmzG7mDrpIbU0b6VaimGaGAIu">
                                    </div><br>
                                    
                                    <div class="form-group">
                                        <input name="recover-submi" class="btn btn-lg btn-primary btn-block" value="Login" type="submit" style="background:rgb(0, 234, 0);" id="botao">
                                    </div>
                                    <div class="form-group">
                                        <a href="{{BASE}}login/cadastro/"><string>Cadastre-se</string></a><br>
                                       <a href="{{BASE}}login/recovery/"><string>Esqueci minha Senha</string></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>