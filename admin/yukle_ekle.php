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
	function dosya($yer,$dosya){
		if($yer=='c'){
			$dosyayol="../assets/img/".$_FILES[$dosya]["name"];
		}else if($yer=='pb'){
			$dosyayol="../assets/img/SERDAR_PORTFOLIO/".$_FILES[$dosya]["name"];
		}else if($yer=='pk'){
			$dosyayol="../assets/img/portfolio/".$_FILES[$dosya]["name"];
		}
		$dtip=$_FILES[$dosya]["type"];
		if($yer=='c'){
			if($dtip="image/pdf" ){
			    if(is_uploaded_file($_FILES[$dosya]["tmp_name"])){
				    $tasi=move_uploaded_file($_FILES[$dosya]["tmp_name"],$dosyayol);
				    return $tasi;
			    }
		    }else {
			    echo "Yanlış Dosya Tipi";
			    return 0;
		    }
		}else{
			if($dtip="image/jpg" or $dtip="image/png" or $dtip="image/gif" or $dtip="video/mov" or $dtip="video/mp4" or $dtip="video/3gp" or $dtip="video/ogg"){
			    if(is_uploaded_file($_FILES[$dosya]["tmp_name"])){
				    $tasi=move_uploaded_file($_FILES[$dosya]["tmp_name"],$dosyayol);
				    return $tasi;
			    }
		    }else {
			    echo "Yanlış Dosya Tipi";
			    return 0;
		    }
		}
		
	}
	if ($yer=='a'){
		if(p('home_title')!=""){
			mysqli_query($db,"insert into homeslider(Homeslider_Title) values('".p('home_title')."')");
			header('Location:anasayfa.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=hb");
		}
	}else if ($yer=='hb'){
		if(p('aboutinfo_title')!="" and p('aboutinfo_text')!=""){
			mysqli_query($db,"insert into aboutinfo(Aboutinfo_Title,Aboutinfo_Text) values('".p('aboutinfo_title')."', '".p('aboutinfo_text')."')");
			header('Location:hakkinda.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=hb");
		}
	} else if ($yer=='hp'){
		if(p('aboutpragraph_type')!="" and p('aboutpragraph_text')!=""){
			mysqli_query($db,"insert into aboutparagraph(Aboutparagraph_Type,Aboutparagraph_Text) values('".p('aboutpragraph_type')."', '".p('aboutpragraph_text')."')");
			header('Location:hakkinda.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=hp");
		}
	}else if ($yer=='yp'){
		if(p('skillsparagraph_text')!=""){
			mysqli_query($db,"insert into skills(Skills_Paragraph) values('".p('skillsparagraph_text')."')");
			header('Location:yetenek.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=yp");
		}
	}else if ($yer=='ys'){
		if(p('skillsinfo_skill')!="" and p('skillsinfo_percentile')!=""){
			mysqli_query($db,"insert into skillslist(Skillslist_Title,Skillslist_Percentile) values('".p('skillsinfo_skill')."', '".p('skillsinfo_percentile')."')");
			header('Location:yetenek.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=ys");
		}
	}
	else if ($yer=='oo'){
		if(p('resumesummary_paragraph')!=""){
			mysqli_query($db,"insert into summaryparagraph(Summaryparagraph_Text) values('".p('resumesummary_paragraph')."')");
			header('Location:ozgecmis.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=oo");
		}
	}else if ($yer=='oe'){
		if(p('resumeeducation_title')!="" and p('resumeeducation_date')!="" and p('resumeeducation_city')!="" and p('resumeeducation_text')!=""){
			mysqli_query($db,"insert into resume(Resume_Title,Resume_Date,Resume_City,Resume_Text,Resume_Position) values('".p('resumeeducation_title')."','".p('resumeeducation_date')."','".p('resumeeducation_city')."','".p('resumeeducation_text')."','Eğitim')");
			header('Location:ozgecmis.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=oe");
		}
	}else if ($yer=='ot'){
		if(p('resumeexperience_title')!="" and p('resumeexperience_date')!="" and p('resumeexperience_city')!="" and p('resumeexperience_text')!=""){
			mysqli_query($db,"insert into resume(Resume_Title,Resume_Date,Resume_City,Resume_Text,Resume_Position) values('".p('resumeexperience_title')."','".p('resumeexperience_date')."','".p('resumeexperience_city')."','".p('resumeexperience_text')."','Tecrübe')");
			header('Location:ozgecmis.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=ot");
		}
	}else if ($yer=='p'){
		if($_FILES["dosya"]["name"]!="" and $_FILES["dosya2"]["name"]!=""){
			$position1=dosya('pb','dosya');
			$position2=dosya('pk','dosya2');
			if($position1 and $position2){
			    if($dtip="video/mp4" or $dtip="video/3gp" or $dtip="video/ogg"){
			        mysqli_query($db,"insert portfolio(Portfolio_Magnificationimg,Portfolio_Frontimg,	Portfolio_Type) values('".$_FILES["dosya"]["name"]."', '".$_FILES["dosya2"]["name"]."','video')");
			    }else{
			        mysqli_query($db,"insert portfolio(Portfolio_Magnificationimg,Portfolio_Frontimg) values('".$_FILES["dosya"]["name"]."', '".$_FILES["dosya2"]["name"]."')");
			    }
				header('Location:portfolio.php');
			}
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=p");
		}
	}else if ($yer=='c'){
		if($_FILES["dosya"]["name"]!=""){
			$position=dosya($yer,'dosya');
			if($position){
				mysqli_query($db,"insert into cv(Cv_pdf) values('".$_FILES["dosya"]["name"]."')");
				header('Location:cv.php');
			}
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=c");
		}
	}else if ($yer=='r'){
		if(p('testimonial_user')!="" and p('testimonial_company')!="" and p('testimonial_position')!="" and p('testimonial_email')!="" and p('testimonial_phone')!=""){
			mysqli_query($db,"insert into testimonials(Testimonials_User,Testimonials_Company,Testimonials_Position, Testimonials_Email,Testimonials_Phone) values('".p('testimonial_user')."','".p('testimonial_company')."','".p('testimonial_position')."','".p('testimonial_email')."','".p('testimonial_phone')."')");
			header('Location:referans.php');
		}else{
			echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
			header("refresh:0;url=ekle.php?yer=r");
		}
	}
	/*if($yer!='o'){
		$dosyaad=$_FILES["dosya_ekle"]["name"];
	if ($_FILES["dosya_ekle"]["name"]!=""){
		if($yer=='g'){	
			$dosyayol="../assets/img/galeri/".$dosyaad;
		}else if($yer=='b'){
			$dosyayol="../assets/img/blog/".$dosyaad;
		}else if($yer=='a'){
			$dosyayol="../assets/img/slide/".$dosyaad;
		}else if($yer=='og'){
			$oyun=$_GET['oyun'];
			$dosyayol="../assets/img/oyun".$oyun."/galeri/".$dosyaad;
		}else if($yer=='os'){
			$oyun=$_GET['oyun'];
			$dosyayol="../assets/img/oyun".$oyun."/slider/".$dosyaad;
		}
		$dtip=$_FILES["dosya_ekle"]["type"];
		if($dtip="image/jpg" or $dtip="image/png" or $dtip="image/gif"){
			if(is_uploaded_file($_FILES["dosya_ekle"]["tmp_name"])){
				$tasi=move_uploaded_file($_FILES["dosya_ekle"]["tmp_name"],$dosyayol);
				  if($tasi){
				  		if($yer=='g'){
				  			if(p('resim_ekle_isim')!=""){
				  				mysqli_query($db,"insert into galery(Galery_img,Galery_name) values('$dosyaad','".p('resim_ekle_isim')."')");
						 		header('Location:galeri.php');
				  			}
				  			else{
				  				echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
				  				header("refresh:0;url=ekle.php?yer=g");
				  			}
				  			
				  		}else if($yer=='b'){
				  			if(p('blog_ekle_katagori')!="" and p('blog_ekle_baslik')!="" and p('blog_ekle_yazi')!="" and p('blog_ekle_yazar')!="" and p('blog_ekle_zaman')!=""){
				  				mysqli_query($db,"insert into blog(Blog_img,Blog_category,Blog_title,Blog_text,Blog_author,Blog_time) values('$dosyaad','".p('blog_ekle_katagori')."', '".p('blog_ekle_baslik')."','".p('blog_ekle_yazi')."','".p('blog_ekle_yazar')."','".p('blog_ekle_zaman')."')");
						 		header('Location:blog.php');
				  			}
				  			else{
				  				echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
				  				header("refresh:0;url=ekle.php?yer=b");
				  			}
				  		}else if($yer=='a'){
				  			mysqli_query($db,"insert into slider(Slider_img) values('$dosyaad')");
						 	header('Location:anasayfa.php');
				  		}else if($yer=='og'){
				  			if(p('foto_ekle_isim')!=""){
				  				mysqli_query($db,"insert into game_galery(GameGalery_img,GameGalery_name,Game_Id) values('$dosyaad','".p('foto_ekle_isim')."',".$oyun.")");
						 		header('Location:oyun.php?oyun='.$oyun);
				  			}
				  			else{
				  				echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
				  				header("refresh:0;url=ekle.php?yer=og&oyun=".$oyun);
				  			}
				  		}else if($yer=='os'){
				  			mysqli_query($db,"insert into game_slider(GameSlider_img,Game_Id) values('$dosyaad',".$oyun.")");
						 	header('Location:oyun.php?oyun='.$oyun);
				  		}
					  }
				}
		}
		else {
			echo "Yanlış Dosya Tipi";
		}
	}
	else{
		echo "<script>alert('Bütün alanlar doldurulmalıdır.')</script>";
		if($yer=='g'){
			header("refresh:0;url=ekle.php?yer=g");
		}else if($yer=='b'){
			header("refresh:0;url=ekle.php?yer=b");
		}else if($yer=='a'){
			header("refresh:0;url=ekle.php?yer=a");
		}else if($yer=='og'){
			$oyun=$_GET['oyun'];
			header("refresh:0;url=ekle.php?yer=og&oyun=".$oyun);
		}else if($yer=='os'){
			$oyun=$_GET['oyun'];
			header("refresh:0;url=ekle.php?yer=os&oyun=".$oyun);
		}	
	}
	}*/
}?>
<?php ob_end_flush();?>