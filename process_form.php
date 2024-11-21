<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $project_name = htmlspecialchars($_POST['project_name']);
    $email = htmlspecialchars($_POST['email']);
    $project_type = htmlspecialchars($_POST['project_type']);
    $project_budget = htmlspecialchars($_POST['project_budget']);
    $message = htmlspecialchars($_POST['message']);
    require_once './vendor/autoload.php'; 
    $mail = new PHPMailer(true); 

    try {
        $mail->isSMTP();  
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;  
        $mail->Port = 587;  
        $mail->Username = 'hybritechinnovationsltd@gmail.com';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Password = 'gizflulxmzwywrpd';  
        $mail->setFrom($email, $name);  
        $mail->addAddress('info@hybri.tech', 'Recipient Name');
        $mail->addReplyTo($email, $name);
        $mail->Subject = 'Thanks for your Project Inquiry!';
        $mail->isHTML(true);
        $mail->Body = "
            <html>
            <body>
            <h2>Project Inquiry Details</h2>
            <p><strong>Full Name:</strong> $name</p>
            <p><strong>Project Name:</strong> $project_name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Project Type:</strong> $project_type</p>
            <p><strong>Project Budget:</strong> $project_budget</p>
            <p><strong>Message:</strong><br>$message</p>
            </body>
            </html>";
        $mail->AltBody = 'Project Inquiry Details: ' . $message;
        if ($mail->send()) {
//            echo '<script type="text/javascript"> alert("Message has been sent"); window.history.back(); </script>';
             header("Location: index.html");
            exit;
        } else {
            // echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            header("Location: index.html");
        }
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: index.html");
    }
}
?>
