<?php
session_start();

?>

<html>

<head>
    <title>Hidrosystem | LOGIN </title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta charset="UTF-8">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .form-gap {
            padding-top: 70px;
        }

        body {
            background: url(https://hidrosystem1.000webhostapp.com/images/greenbg.png) no-repeat;
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
    <?php

    if (isset($_SESSION["login"]) and $_SESSION["2fa"] == true) {
        echo "<script>document.location='dashboard/index.php'</script>";
    } else if (isset($_SESSION["login"])) {

        echo "<script>document.location='2fa.php'</script>";
    }

    function EnviarSms($numero, $message)
    {
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTYzMjI2Nzk2MywiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkwNTg5LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.K71hcHGCZiDgKB-aAjRgbCMC2cWjWgJFoZFwraDIW-I";
        $phone_number = $numero;
        $message = $message;
        $deviceID = 125761;
        $options = [];
        $smsGateway = new SmsGateway($token);
        $result = $smsGateway->sendMessageToNumber($phone_number, $message, $deviceID, $options);
        return $result;
    }

    ?>
     <script>
        function error() {
            Swal.fire(
                'LOGIN',
                'Usuário ou Senha Incorretos',
                'error'
            )
        }

        function recaptcha() {
            Swal.fire(
                'reCAPTCHA',
                'Valide o Recaptcha E Tente Novamente!',
                'error'
            )
        }

        function sucess() {
            Swal.fire({
                title: 'LOGIN',
                text: 'Logado Com Sucesso!',
                type: 'success'
            }).then(function() {
                document.location = "2fa.php";
            })
        }
    </script>
    <?php
    include("apis/conecao.php");
    require_once('sendsms.php');
    include("apis/recaptcha.php");
    if (!empty($_POST['email']) and !empty($_POST['senha']) and !empty($_POST['g-recaptcha-response'])) {
        $captcha_data = $_POST['g-recaptcha-response'];
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        //fazendo a validação do recaptcha
        $status = recaptcha($captcha_data);
        if ($status == true) {
            $sql = "SELECT nome,sobrenome,email,arduino,celular FROM user where email='$email' and senha='$senha'";
            $resultado = mysqli_query($con, $sql);
            if (mysqli_num_rows($resultado) == 0) {
                echo "<script>error()</script>";
            } else {
                $token = rand(100000, 999999);
                $resultado = mysqli_fetch_array($resultado);
                $arduino = $resultado["arduino"];
                $nome = $resultado["nome"];
                $sobrenome = $resultado["sobrenome"];
                $celular = $resultado["celular"];
                $_SESSION["login"] = $email;
                $_SESSION["arduino"] = $arduino;
                $_SESSION["nome"] = $nome;
                $_SESSION["sobrenome"] = $sobrenome;
                $_SESSION["celular"] = $celular;
                $_SESSION["senha"] = $senha;
                $_SESSION["2fa"] = false;
                $_SESSION["token"] = $token;
                //processo de envio do SMS para Autenticação 2fa....
                $sms = "Olá $nome - Seu Código de Autenticação é: \n$token" . "\n Nunca Compartilhe esse Código com ninguem.\nAtenciosamente, Hidrosystem!";
                $out = EnviarSms($celular, $sms);




                //notificação do usuario atraves do Browser que o login estaca correto.
                echo "<script>sucess();</script>";
            }
        } else {
            echo "<script>recaptcha();</script>";
        }

        //executando sql se tudo deu certo....

    }
    ?>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
                                            <input id="email" name="senha" placeholder="Password" class="form-control" type="password" required>
                                        </div>
                                    </div>
                                    <div class="g-recaptcha" data-sitekey="6LewA5UcAAAAAPYrmzG7mDrpIbU0b6VaimGaGAIu">
                                    </div><br>
                                    
                                    <div class="form-group">
                                        <input name="recover-submi" class="btn btn-lg btn-primary btn-block" value="Login" type="submit" style="background:rgb(0, 234, 0);" id="botao">
                                    </div>
                                    <div class="form-group">
                                        <a href="cadastro.php"><string>Cadastre-se</string></a><br>
                                       <a href="recuperar.php"><string>Esqueci minha Senha</string></a>
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