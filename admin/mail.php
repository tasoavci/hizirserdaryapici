<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
	include "database.php";
    if(p('name')!="" and p('email')!="" and p('subject')!="" and p('message')!=""){
        require 'src/Exception.php';
        require 'src/PHPMailer.php';
        require 'src/SMTP.php';
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0; // debug on - off
            $mail->isSMTP(); 
            $mail->Host = gethostbyname('mail.hizirserdaryapici.com'); // SMTP sunucusu örnek : mail.alanadi.com
            $mail->SMTPAuth = true; // SMTP Doğrulama
            $mail->Username = 'info@hizirserdaryapici.com'; // Mail kullanıcı adı
            $mail->Password = 'SerdaryapiciInfo96'; // Mail şifresi
            $mail->SMTPSecure = 'ssl'; // Şifreleme
            $mail->Port = 465; // SMTP Port
            $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true));
            //Alıcılar
            $mail->setfrom(p('email'), p('name'));
            $mail->addAddress('info@hizirserdaryapici.com');
            $mail->addReplyTo(p('email'), p('name'));
            //İçerik
            $mail->isHTML(true);
            $mail->Subject = p('subject');
            $mail->Body = p('message');

            $mail->send();
            echo "Mesajınız İletildi --> ".p('email')."<br>";
        } catch (Exception $e) {
            echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
        }
    	mysqli_query($db,"insert into contact(Contact_User,Contact_Mail,Contact_Subject,Contact_Message) values('".p('name')."','".p('email')."','".p('subject')."','".p('message')."')");
    }else{
        echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
    }
    header("refresh:0;url=../index.php");
?>
<?php ob_end_flush();?>