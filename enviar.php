
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $telefone = htmlspecialchars($_POST["telefone"]);
    $emailUsuario = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cursopotencialrj@gmail.com';
        $mail->Password = '23032011wl';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('SEUEMAIL@gmail.com', 'Formulário do site');
        $mail->addAddress('SEUEMAIL@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Novo contato do formulário';
        $mail->Body    = "
            <h3>Novo contato recebido:</h3>
            <p><strong>Nome:</strong> $nome</p>
            <p><strong>Telefone:</strong> $telefone</p>
            <p><strong>Email:</strong> $emailUsuario</p>
        ";

        $mail->send();
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href = 'index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erro: {$mail->ErrorInfo}'); history.back();</script>";
    }
}
?>
