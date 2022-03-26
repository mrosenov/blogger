<?php include ("includes/connection.php"); ?>
<?php include ("includes/header.php"); ?>
<?php include ("includes/navigation.php"); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
    if (isset($_POST['contact_us'])){
        $EmailTo = $_POST['email'];
        $NameTo = $_POST['name'];
        $TitleSubject = $_POST['subject'];
        $body = $_POST['body'];

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp-relay.sendinblue.com';                  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'mitkorosenov@live.com';             // SMTP username
            $mail->Password = 'Sfz8kgqh4LFOT1bZ';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('mitkorosenov@live.com', 'Mailer');          //This is the email your form sends From
            $mail->addAddress($EmailTo, $NameTo); // Add a recipient address

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $TitleSubject;
            $mail->Body    = $body;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
?>
<div class="container">
    <div class="row" style="margin-top: 5px;">
        <div class="col col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title">Contact Us</h5>
                        </div>
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label><br>
                                    <textarea name="body" class="form-control" id="content" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="contact_us" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-4">
            <?php include ("includes/sidebar.php"); ?>
        </div>
    </div>
<?php include ("includes/footer.php"); ?>
