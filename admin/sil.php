<!DOCTYPE html>
<?php
    include "database.php";
    session_start();
    if(!$_SESSION)
    {
        echo "<script> alert ('ADMİNE ÖZELDİR!'); </script>";
        header("refresh:0;url=index.php");
    }
    else{
         
?>
<html>
<head>
<meta charset="utf-8">
<title>Serdar Yapıcı | Admin</title>
<link rel="stylesheet"  href="css/reset.css">
<link rel="stylesheet"  href="css/style.css">
</head>
<body>
<?php
function remove_dir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object)
        {
            if ($object != "." && $object != "..")
            {
                if (is_dir($dir. "/" . $object)) {
                    remove_dir($dir . "/" . $object);
                } else {
                    unlink($dir . "/" . $object);
                }
            }
        }
        rmdir($dir);
   }
}
 ?>
<?php $yer=$_GET['yer']; 
$sil=$_GET['sil'];
    if($yer=='a'){
        mysqli_query($db,"delete from homeslider where HomeSlider_Id='".$sil."'");
        header('Location:anasayfa.php');
    }else if($yer=='hb'){
		mysqli_query($db,"delete from aboutinfo where Aboutinfo_Id='".$sil."'");
        header('Location:hakkinda.php');
	} else if($yer=='hp'){
        mysqli_query($db,"delete from aboutparagraph where Aboutparagraph_Id='".$sil."'");
        header('Location:hakkinda.php');
    }else if($yer=='yp'){
        mysqli_query($db,"delete from skills where Skills_Id='".$sil."'");
        header('Location:yetenek.php');
    }else if($yer=='ys'){
        mysqli_query($db,"delete from skillslist where Skillslist_Id='".$sil."'");
        header('Location:yetenek.php');
    }else if($yer=='oo'){
        mysqli_query($db,"delete from summaryparagraph where Summaryparagraph_Id ='".$sil."'");
        header('Location:ozgecmis.php');
    }else if($yer=='oe' or $yer=='ot'){
        mysqli_query($db,"delete from resume where Resume_Id ='".$sil."'");
        header('Location:ozgecmis.php');
    }else if($yer=='p'){
        $eski=mysqli_fetch_array(mysqli_query($db,"select * from portfolio where Portfolio_Id='".$sil."'"));
        unlink('../assets/img/SERDAR_PORTFOLIO/'.$eski["Portfolio_Magnificationimg"]);
        unlink('../assets/img/portfolio/'.$eski["Portfolio_Frontimg"]);
        mysqli_query($db,"delete from portfolio where Portfolio_Id ='".$sil."'");
        header('Location:portfolio.php');
    }else if($yer=='c'){
        $eski=mysqli_fetch_array(mysqli_query($db,"select * from cv where Cv_Id='".$sil."'"));
        unlink('../assets/img/'.$eski["Cv_pdf"]);
        mysqli_query($db,"delete from cv where Cv_Id ='".$sil."'");
        header('Location:cv.php');
    }else if($yer=='r'){
        mysqli_query($db,"delete from testimonials where Testimonials_Id ='".$sil."'");
        header('Location:referans.php');
    }else if($yer=='i'){
        mysqli_query($db,"delete from contact where Contact_Id ='".$sil."'");
        header('Location:ilet.php');
    }
    /*else if($yer=='o'){
        unlink('../assets/img/oyun'.$oyun.'/slider/'.$bul['GameSlider_img']);
        $galery=mysqli_fetch_array(mysqli_query($db,"select * from game_galery where Game_Id='".$sil."'"));
        $slider=mysqli_fetch_array(mysqli_query($db,"select * from game_slider where Game_Id='".$sil."'"));
        $text=mysqli_fetch_array(mysqli_query($db,"select * from game_text where Game_Id='".$sil."'"));
        remove_dir('../assets/img/oyun'.$text['Game_Id']);
        if(isset($text)){
            mysqli_query($db,"delete from game_text where Game_Id='".$sil."'");
        }
        if(isset($slider)){
            mysqli_query($db,"delete from game_slider where Game_Id='".$sil."'");
        }
        if(isset($galery)){
            mysqli_query($db,"delete from game_galery where Game_Id='".$sil."'");
        }
        mysqli_query($db,"delete from game where Game_Id='".$sil."'");
        header('Location:oyunlar.php');
    }*/		    
?>
</body>
</html>
<?php } ?>