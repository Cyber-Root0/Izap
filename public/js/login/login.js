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