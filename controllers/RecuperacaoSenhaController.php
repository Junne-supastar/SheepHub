<?php
// NÃO coloque session_start() aqui se você já chamou no roteador
// session_start(); 

require_once __DIR__ . '/../models/RecuperacaoSenha.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecuperacaoSenhaController {
    private $model;

    public function __construct() {
        $this->model = new RecuperacaoSenha(); 
    }

    // Formulário para solicitar recuperação de senha
    public function solicitar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            // Cria token
            $token = $this->model->criarToken($email);

            if ($token) {
                $link = "http://localhost/SheepHub/public/redefinir.php?token=$token";

                if ($this->enviarEmail($email, $link)) {
                    $_SESSION['sucesso'] = "Um e-mail de recuperação foi enviado.";
                } else {
                    $_SESSION['erro'] = "Não foi possível enviar o e-mail. Verifique a configuração do Gmail.";
                }
            } else {
                $_SESSION['erro'] = "E-mail não encontrado ou usuário inativo.";
            }

            // Redireciona para a mesma página para mostrar a mensagem
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        // Chama a view
        require __DIR__ . '/../views/recuperacao_senha/solicitar.php';
    }

    // Envio de e-mail com PHPMailer
    private function enviarEmail($emailDestino, $linkRecuperacao) {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;          // 0 = sem debug, 2 = detalhado
        $mail->Debugoutput = 'html';
        $mail->CharSet = 'UTF-8';

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'juliaramosrodriguestrabalhos@gmail.com';
            $mail->Password   = 'rjdr esca sbme haju'; // senha php
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('juliaramosrodriguestrabalhos@gmail.com', 'Suporte');
            $mail->addAddress($emailDestino);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperação de Senha - SheepHub';
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 10px;'>
                    <h2 style='color:#333;'>Recuperação de Senha SheepHub</h2>
                    <p>Olá! Recebemos uma solicitação para redefinir sua senha.</p>
                    <p style='text-align:center; margin: 30px 0;'>
                        <a href='$linkRecuperacao' 
                           style='background-color:#007BFF; color:#fff; padding: 12px 25px; text-decoration:none; border-radius:5px; font-weight:bold; display:inline-block;'>
                           Redefinir Senha
                        </a>
                    </p>
                    <p>Se você não solicitou a alteração, ignore este e-mail.</p>
                    <p style='font-size: 12px; color: #666;'>Equipe SheepHub</p>
                </div>
            ";
            $mail->AltBody = "Recuperação de Senha SheepHub\n\nOlá! Recebemos uma solicitação para redefinir sua senha.\n
            Acesse o link abaixo para redefinir sua senha:\n$linkRecuperacao\n\nSe você não solicitou a alteração, ignore este e-mail.\nEquipe SheepHub";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Erro ao enviar e-mail: " . $mail->ErrorInfo);
            return false;
        }
    }

    // Formulário para redefinir senha via token
    public function redefinir() {
        $token = $_GET['token'] ?? '';
        $usuario = $this->model->validarToken($token);

        if (!$usuario) {
            $_SESSION['erro'] = "Token inválido ou expirado.";
            header('Location: ../public/recuperacao.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novaSenha = $_POST['senha'] ?? '';
            $confSenha = $_POST['conf_senha'] ?? '';

            if ($novaSenha !== $confSenha) {
                $_SESSION['erro'] = "As senhas não conferem.";
                header('Location: ' . $_SERVER['PHP_SELF'] . "?token=$token");
                exit;
            }

            if ($this->model->atualizarSenha($usuario['usuario_idusuario'], $novaSenha)) {
                $_SESSION['sucesso'] = "Senha atualizada com sucesso!";
                header('Location: ../public/index.php'); // vai para o login
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao atualizar senha.";
                header('Location: ' . $_SERVER['PHP_SELF'] . "?token=$token");
                exit;
            }
        }

        require __DIR__ . '/../views/recuperacao_senha/redefinir.php';
    }
}
