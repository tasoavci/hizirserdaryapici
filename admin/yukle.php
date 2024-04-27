<?php ob_start(); ?>
<?php
	session_start();
	if(!$_SESSION)
	{
		echo "<script> alert ('ADMİNE ÖZELDİR!'); </script>";
		header("refresh:0;url=index.php");
	}
	else{
?>
<?php
	include "database.php";
	$yer=$_GET['yer'];
	$duzen=$_GET['duzen']; 
	function dosya($yer,$dosya){
		if($yer=='c'){
			$dosyayol="../assets/img/".$_FILES[$dosya]["name"];
		}else if($yer=='pb'){
			$dosyayol="../assets/img/SERDAR_PORTFOLIO/".$_FILES[$dosya]["name"];
		}else if($yer=='pk'){
			$dosyayol="../assets/img/portfolio/".$_FILES[$dosya]["name"];
		}
		$dtip=$_FILES[$dosya]["type"];
		if($dtip="image/jpg" or $dtip="image/png" or $dtip="image/gif" or $dtip="image/pdf"){
			if(is_uploaded_file($_FILES[$dosya]["tmp_name"])){
				$tasi=move_uploaded_file($_FILES[$dosya]["tmp_name"],$dosyayol);
				return $tasi;
			}
		}else {
			echo "Yanlış Dosya Tipi";
			return 0;
		}
	}
	if ($yer=="a"){
		if(p('home_title')!=""){
			mysqli_query($db,"update homeslider set Homeslider_Title='".p('home_title')."' where Homeslider_Id ='".$duzen."'");
			header('Location:anasayfa.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=a&duzen=".$duzen);
		}
	}else if ($yer=="hb"){
		if(p('aboutinfo_title')!="" and p('aboutinfo_text')!=""){
			mysqli_query($db,"update aboutinfo set Aboutinfo_Title='".p('aboutinfo_title')."', Aboutinfo_Text='".p('aboutinfo_text')."' where Aboutinfo_Id='".$duzen."'");
			header('Location:hakkinda.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=hb&duzen=".$duzen);
		}
	}else if ($yer=="hp"){
		if(p('aboutpragraph_type')!="" and p('aboutpragraph_text')!=""){
			mysqli_query($db,"update aboutparagraph set Aboutparagraph_Type='".p('aboutpragraph_type')."', Aboutparagraph_Text='".p('aboutpragraph_text')."' where Aboutparagraph_Id='".$duzen."'");
			header('Location:hakkinda.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=hp&duzen=".$duzen);
		}
	}
	else if ($yer=="yp"){
		if(p('skillsparagraph_text')!=""){
			mysqli_query($db,"update skills set Skills_Paragraph='".p('skillsparagraph_text')."' where Skills_Id='".$duzen."'");
			header('Location:yetenek.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=yp&duzen=".$duzen);
		}
	}else if ($yer=='ys'){
		if(p('skillsinfo_skill')!="" and p('skillsinfo_percentile')!=""){
			mysqli_query($db,"update skillslist set Skillslist_Title='".p('skillsinfo_skill')."', Skillslist_Percentile='".p('skillsinfo_percentile')."' where Skillslist_Id='".$duzen."'");
			header('Location:yetenek.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=ys&duzen=".$duzen);
		}
	}else if ($yer=='oo'){
		if(p('resumesummary_paragraph')!=""){
			mysqli_query($db,"update summaryparagraph set Summaryparagraph_Text='".p('resumesummary_paragraph')."' where Summaryparagraph_Id='".$duzen."'");
			header('Location:ozgecmis.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=oo&duzen=".$duzen);
		}
	}else if ($yer=='oe'){
		if(p('resumeeducation_title')!="" and p('resumeeducation_date')!="" and p('resumeeducation_city')!="" and p('resumeeducation_text')!=""){
			mysqli_query($db,"update resume set Resume_Title='".p('resumeeducation_title')."',Resume_Date='".p('resumeeducation_date')."',Resume_City='".p('resumeeducation_city')."',Resume_Text='".p('resumeeducation_text')."'  where Resume_Id='".$duzen."'");
			header('Location:ozgecmis.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=oe&duzen=".$duzen);
		}
	}else if ($yer=='ot'){
		if(p('resumeexperience_title')!="" and p('resumeexperience_date')!="" and p('resumeexperience_city')!="" and p('resumeexperience_text')!=""){
			mysqli_query($db,"update resume set Resume_Title='".p('resumeexperience_title')."',Resume_Date='".p('resumeexperience_date')."',Resume_City='".p('resumeexperience_city')."',Resume_Text='".p('resumeexperience_text')."'  where Resume_Id='".$duzen."'");
			header('Location:ozgecmis.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=ot&duzen=".$duzen);
		}
	}else if ($yer=='p'){
		if($_FILES["dosya"]["name"]!="" and $_FILES["dosya2"]["name"]!=""){
			$position1=dosya('pb','dosya');
			$eski=mysqli_fetch_array(mysqli_query($db,"select * from portfolio where Portfolio_Id='".$duzen."'"));
			unlink('../assets/img/SERDAR_PORTFOLIO/'.$eski["Portfolio_Magnificationimg"]);
			
			$position2=dosya('pk','dosya2');
			unlink('../assets/img/portfolio/'.$eski["Portfolio_Frontimg"]);
			if($position1 and $position2){
				mysqli_query($db,"update portfolio set Portfolio_Magnificationimg='".$_FILES["dosya"]["name"]."', Portfolio_Frontimg='".$_FILES["dosya2"]["name"]."' where Portfolio_Id='".$duzen."'");
				header('Location:portfolio.php');
			}
		}else if($_FILES["dosya"]["name"]!=""){
			$position=dosya('pb','dosya');
			$eski=mysqli_fetch_array(mysqli_query($db,"select * from portfolio where Portfolio_Id='".$duzen."'"));
			unlink('../assets/img/SERDAR_PORTFOLIO/'.$eski["Portfolio_Magnificationimg"]);
			if($position){
				mysqli_query($db,"update portfolio set Portfolio_Magnificationimg='".$_FILES["dosya"]["name"]."' where Portfolio_Id='".$duzen."'");
				header('Location:portfolio.php');
			}
		}else{
			$position=dosya('pk','dosya2');
			$eski=mysqli_fetch_array(mysqli_query($db,"select * from portfolio where Portfolio_Id='".$duzen."'"));
			unlink('../assets/img/portfolio/'.$eski["Portfolio_Frontimg"]);
			if($position){
				mysqli_query($db,"update portfolio set Portfolio_Frontimg='".$_FILES["dosya2"]["name"]."' where Portfolio_Id='".$duzen."'");
				header('Location:portfolio.php');
			}
		}
	}else if ($yer=='c'){
		if($_FILES["dosya"]["name"]!=""){
			$position=dosya($yer,'dosya');
			$eski=mysqli_fetch_array(mysqli_query($db,"select * from cv where Cv_Id='".$duzen."'"));
			unlink('../assets/img/'.$eski["Cv_pdf"]);
			if($position){
				mysqli_query($db,"update cv set Cv_pdf='".$_FILES["dosya"]["name"]."' where Cv_Id='".$duzen."'");
				header('Location:cv.php');
			}
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=c&duzen=".$duzen);
		}
	}else if ($yer=='r'){
		if(p('testimonial_user')!="" and p('testimonial_company')!="" and p('testimonial_position')!="" and p('testimonial_email')!="" and p('testimonial_phone')!=""){
			mysqli_query($db,"update testimonials set Testimonials_User='".p('testimonial_user')."',Testimonials_Company='".p('testimonial_company')."',Testimonials_Position='".p('testimonial_position')."',Testimonials_Email='".p('testimonial_email')."',Testimonials_Phone='".p('testimonial_phone')."' where Testimonials_Id='".$duzen."'");
			header('Location:referans.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=duzen.php?yer=r&duzen=".$duzen);
		}
	}
}?>
<?php ob_end_flush();?>