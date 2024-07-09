<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Senhas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Coluna para a imagem -->
            <div class="col-md-5">
                <img class="logo" src="img/senha.jpg" alt="Gerador de senha logo">
            </div>
            <!-- Coluna para o conteúdo -->
            <div class="col-md-7">
                <form method="post">
                    <h1 class="text-center">Gerador de Senhas</h1>
                    <p class="text-center">Crie senhas fortes e seguras para proteger suas contas online.</p>
                    <div class="form-group">
                        <label for="slider">Tamanho da senha: <span id="valor">15</span> caracteres</label>
                        <input id="slider" class="form-control-range slider" type="range" name="length" min="5" max="25" value="15" oninput="updateSliderValue(this.value)">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="include_uppercase" id="include_uppercase">
                                <label class="form-check-label" for="include_uppercase">ABC</label>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="include_lowercase" id="include_lowercase">
                                <label class="form-check-label" for="include_lowercase">abc</label>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="include_numbers" id="include_numbers">
                                <label class="form-check-label" for="include_numbers">123</label>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="include_special" id="include_special">
                                <label class="form-check-label" for="include_special">#$&</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block button-cta">Gerar senha</button>
                </form>
                <br>
                <div id="container-password" class="container-password <?php echo isset($_POST['length']) ? '' : 'hide'; ?>" onclick="copyPassword()">
                    <h4 class="title">Sua senha gerada foi:</h4>
                    <br>
                    <span id="password" class="password">
                        <?php
                        if (isset($_POST['length'])) {
                            function generatePassword($length, $options)
                            {
                                $charset = '';
                                if ($options['include_uppercase']) {
                                    $charset .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                }
                                if ($options['include_lowercase']) {
                                    $charset .= 'abcdefghijklmnopqrstuvwxyz';
                                }
                                if ($options['include_numbers']) {
                                    $charset .= '0123456789';
                                }
                                if ($options['include_special']) {
                                    $charset .= '!@#$%^&*()';
                                }
                                if ($charset === '') {
                                    return 'Selecione pelo menos uma opção de caracteres.';
                                }

                                $password = '';
                                for ($i = 0; $i < $length; $i++) {
                                    $password .= $charset[rand(0, strlen($charset) - 1)];
                                }
                                return $password;
                            }

                            $length = intval($_POST['length']);
                            $options = [
                                'include_uppercase' => isset($_POST['include_uppercase']),
                                'include_lowercase' => isset($_POST['include_lowercase']),
                                'include_numbers' => isset($_POST['include_numbers']),
                                'include_special' => isset($_POST['include_special']),
                            ];

                            // Verifica se pelo menos uma opção foi selecionada
                            if (!$options['include_uppercase'] && !$options['include_lowercase'] && !$options['include_numbers'] && !$options['include_special']) {
                                echo 'Selecione pelo menos uma opção de caracteres.';
                            } else {
                                echo generatePassword($length, $options);
                            }
                        }
                        ?></span>
                    <span class="tooltip">Clique na senha para copiar. </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Your custom JavaScript -->
    <script>
        let novaSenha = "<?php echo isset($_POST['length']) ? generatePassword(intval($_POST['length']), $options) : ''; ?>";

        function updateSliderValue(value) {
            document.getElementById('valor').innerText = value;
        }

        function copyPassword() {
            alert("Senha copiada com sucesso!");
            navigator.clipboard.writeText(novaSenha);
        }
    </script>
</body>

</html>
