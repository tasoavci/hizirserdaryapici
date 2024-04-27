<!DOCTYPE html>
<html lang="tr">

<?php include "admin/database.php"; ?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hızır Serdar Yapıcı Portfolio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/profile-img.JPG" rel="icon">
  <link href="assets/img/profile-img.JPG" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="img/profile-img.JPG" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index.php">Hızır Serdar Yapıcı</a></h1>
        <div class="social-links mt-3 text-center">
          <a href="https://mobile.twitter.com/serdaryapici035" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="https://www.facebook.com/serdar035" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="https://www.instagram.com/serdaryapici35/" class="instagram"><i class="bx bxl-instagram"></i></a>
          <!--<a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>-->
        </div>
      </div>

      <nav id="navbar" class="nav-menu navbar">
        <ul>
          <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Anasayfa</span></a></li>
          <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Beni Tanı</span></a></li>
          <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Özgeçmiş</span></a></li>
          <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
          <li><a href="#testimonials" class="nav-link scrollto"><i class="bx bx-server"></i> <span>Referanslar</span></a></li>
          <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>İletişim</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <?php 
    $home=mysqli_fetch_array(mysqli_query($db,"select * from home"));
    $slider=mysqli_query($db,"select * from homeslider");
  ?>
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1><?php echo $home['Home_Title']; ?></h1>
      <p><?php echo $home['Home_Text']; ?> <span class="typed" data-typed-items="<?php
      while ($homeslider=mysqli_fetch_array($slider)){
        echo $homeslider['Homeslider_Title'].",";
      }
      ?>"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <?php 
      $about=mysqli_fetch_array(mysqli_query($db,"select * from about"));
      $coverletter=mysqli_query($db,"select * from aboutparagraph where Aboutparagraph_Type='Ön Yazı'");
      $paragraph=mysqli_query($db,"select * from aboutparagraph where Aboutparagraph_Type='Yazı'");
      $info=mysqli_query($db,"select * from aboutinfo");
      $infohalf=round(mysqli_num_rows($info)/2);
      $infocount=mysqli_num_rows($info);
    ?>
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Beni Tanı</h2>
          <?php while ($aboutcoverletter=mysqli_fetch_array($coverletter)){ ?>
            <p><?php echo  $aboutcoverletter['Aboutparagraph_Text'];?></p>
          <?php }?>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <img src="<?php echo 'assets/img/'.$about['About_Img'];?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3><?php echo $about['About_Title']; ?></h3>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <?php for ($x = 0; $x < $infohalf; $x++) { ?>
                    <li>
                      <i class="bi bi-chevron-right"></i> 
                      <strong><?php echo mysqli_result($info,$x, "Aboutinfo_Title"); ?></strong> 
                      <span><?php echo mysqli_result($info,$x, "Aboutinfo_Text"); ?></span>
                    </li>
                  <?php }?>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <?php for ($x = $infohalf; $x < $infocount; $x++) { ?>
                    <li>
                      <i class="bi bi-chevron-right"></i> 
                      <strong><?php echo mysqli_result($info,$x, "Aboutinfo_Title"); ?></strong> 
                      <span><?php echo mysqli_result($info,$x, "Aboutinfo_Text"); ?></span>
                    </li>
                  <?php }?>
                </ul>
              </div>
            </div>
            <?php while ($aboutparagraph=mysqli_fetch_array($paragraph)){ ?>
            <p><?php echo  $aboutparagraph['Aboutparagraph_Text'];?></p>
            <?php }?>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <?php
      $skillsparagraph=mysqli_query($db,"select * from skills");
      $skillsinfo=mysqli_query($db,"select * from skillslist");
      $skillsinfohalf=round(mysqli_num_rows($skillsinfo)/2);
      $skillsinfocount=mysqli_num_rows($skillsinfo);
     ?>
    <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Yetenekler</h2>
          <?php while ($skill1=mysqli_fetch_array($skillsparagraph)){?>
            <p><?php echo $skill1['Skills_Paragraph'];?></p>
          <?php } ?>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6" data-aos="fade-up">
            <?php for ($x = 0; $x < $skillsinfohalf; $x++) { ?>
              <div class="progress">
                <span class="skill"><?php echo mysqli_result($skillsinfo,$x, "Skillslist_Title"); ?>
                  <i class="val"><?php echo mysqli_result($skillsinfo,$x, "Skillslist_Percentile"); ?>%</i>
                </span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo mysqli_result($skillsinfo,$x, "Skillslist_Percentile"); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            <?php }?>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <?php for ($x = $skillsinfohalf; $x < $skillsinfocount; $x++) { ?>
              <div class="progress">
                <span class="skill"><?php echo mysqli_result($skillsinfo,$x, "Skillslist_Title"); ?>
                  <i class="val"><?php echo mysqli_result($skillsinfo,$x, "Skillslist_Percentile"); ?>%</i>
                </span>
                <div class="progress-bar-wrap">
                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo mysqli_result($skillsinfo,$x, "Skillslist_Percentile"); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            <?php }?>
          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <?php 
      $resumesummary=mysqli_fetch_array(mysqli_query($db,"select * from resumesummary"));
      $summaryparagraph=mysqli_query($db,"select * from summaryparagraph");
      $education=mysqli_query($db,"select * from resume where Resume_Position='Eğitim'");
      $experience=mysqli_query($db,"select * from resume where Resume_Position='Tecrübe'");
    ?>
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Özgeçmiş</h2>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Özet</h3>
            <div class="resume-item pb-0">
              <h4><?php echo $resumesummary['Resumesummary_Title']; ?></h4>
              <?php while ($summary=mysqli_fetch_array($summaryparagraph)){ ?>
                <p><em><?php echo $summary['Summaryparagraph_Text'];?></em></p>
              <?php }?>              
              <ul>
                <li><?php echo $resumesummary['Resumesummary_Address']; ?></li>
                <li><?php echo $resumesummary['Resumesummary_Phone']; ?></li>
                <li><?php echo $resumesummary['Resumesummary_Email']; ?></li>
              </ul>
            </div>

            <h3 class="resume-title">Eğitim</h3>
            <?php while ($resumeeducation=mysqli_fetch_array($education)){ ?>
              <div class="resume-item">
                <h4><?php echo $resumeeducation['Resume_Title'];?></h4>
                <h5><?php echo $resumeeducation['Resume_Date'];?></h5>
                <p><em><?php echo $resumeeducation['Resume_City'];?></em></p>
                <p><?php echo $resumeeducation['Resume_Text'];?></p>
              </div>
            <?php }?>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">Tecrübeler</h3>
            <?php while ($resumeexperience=mysqli_fetch_array($experience)){ ?>
              <div class="resume-item">
                <h4><?php echo $resumeexperience['Resume_Title'];?></h4>
                <h5><?php echo $resumeexperience['Resume_Date'];?></h5>
                <p><em><?php echo $resumeexperience['Resume_City'];?></em></p>
                <p><?php echo $resumeexperience['Resume_Text'];?></p>
              </div>
            <?php }?>
            <!--<div class="resume-item">
              <h4>Kırlıoğlu</h4>
              <h5>2012-2016</h5>
              <p><em>İzmir Türkiye</em></p>
              <p>Lise dönemi boyunca part-time olarak çalıştım. Bilgisayar bileşenlerinin tasarımı, geliştirilmesi ve test edilmesinden sorumluydum. Bu dönemde web tasarımı, video düzenleme ve ihtiyaçlara yönelik tasarım değişiklikleri uyguladım. Özellikle bilgisayar oyunlarında karakter çizimleri, yayınlanacağı platform, hedef kitlesi, bütçe, piyasa ve pazar analizi süreçlerinde sorumluluklar üstlendim. İş sürecimde kendime sürekli olarak gelişme, öğrenme ve çağımızın yeniliklerine uyum sağlamak adına güzel bir deneyim kattım. </p>
              <ul>
                <li>Developed numerous marketing programs (logos, brochures,infographics, presentations, and advertisements).</li>
                <li>Managed up to 5 projects or tasks at a given time while under pressure</li>
                <li>Recommended and consulted with clients on the most appropriate graphic design</li>
                <li>Created 4+ design presentations and proposals a month for clients and account managers</li>
              </ul>
            </div>-->
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <?php 
      $portfolioinfo=mysqli_query($db,"select * from portfolio");
    ?>
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Portfolio</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
          <?php while ($portfolio=mysqli_fetch_array($portfolioinfo)){ ?>
            <div class="col-lg-4 col-md-6 portfolio-item lazy">
              <a href="<?php echo 'assets/img/portfolio/'.$portfolio['Portfolio_Magnificationimg'];?>" data-gallery="portfolioGallery" class="portfolio-lightbox lazy">
                <div class="portfolio-wrap">
                    <?php if($portfolio['Portfolio_Type']=="images"){ ?>
                        <img class="img-fluid" src="<?php echo 'assets/img/portfolio/'.$portfolio['Portfolio_Magnificationimg'];?>"/>
                    <?php }else{ ?>
                        <video class="img-fluid" controls>
                           <source src="<?php echo 'assets/img/portfolio/'.$portfolio['Portfolio_Magnificationimg'];?>">
                        </video>
                    <?php } ?>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Cv Section ======= -->
    <?php 
      $cvpage=mysqli_query($db,"select * from cv ");  
    ?>
    <section id="cv" class="cv">
      <div class="container">

        <div class="section-title">
          <h2>CV</h2>
        </div>

        <div class="row">
          <?php while ($cvdetail=mysqli_fetch_array($cvpage)){ ?>
            <div class="col-lg-6">
              <iframe src="assets/img/<?php echo $cvdetail['Cv_pdf'];?>" title="CV" height="300px" width="100%"></iframe>
            </div>
          <?php }?>
        </div>

      </div>
    </section><!-- End Cv Section -->

    <!-- ======= Testimonials Section ======= -->
    <?php 
      $testimonials=mysqli_query($db,"select * from testimonials");  
    ?>
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Referanslar</h2>
        </div>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <?php while ($testimonial=mysqli_fetch_array($testimonials)){ ?>
              <div class="swiper-slide">
                <div class="testimonial-item" data-aos="fade-up">
                  <div class="yazi">
                  <h3><?php echo $testimonial['Testimonials_Company'];?></h3>
                    <ul>
                      <li><?php echo $testimonial['Testimonials_Position'];?></li>
                      <li><?php echo $testimonial['Testimonials_Email'];?></li>
                      <li><?php echo $testimonial['Testimonials_Phone'];?></li>
                    </ul>
                  </div>
                  <h3><?php echo $testimonial['Testimonials_User'];?></h3>
                </div>
              </div><!-- End testimonial item -->
            <?php }?>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <?php 
      $info=mysqli_fetch_array(mysqli_query($db,"select * from contactinfo"));
    ?>
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>İletişim</h2>
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Adres :</h4>
                <p><?php echo $info['Contactinfo_Address']; ?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo $info['Contactinfo_EMail']; ?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Telefon :</h4>
                <p><?php echo $info['Contactinfo_Phone']; ?></p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3129.7776043646613!2d27.130245715191403!3d38.33098057966195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbdfc9623d372b%3A0x66c60fff101c2e53!2sGazi%2C%2028%2F25.%20Sk.%20No%3A13%2C%2035410%20Gaziemir%2F%C4%B0zmir!5e0!3m2!1sen!2str!4v1649790996235!5m2!1sen!2str"   frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form class="email-form" method="post" action="admin\mail.php" enctype="multipart/form-data" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">İsminiz</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Emailiniz</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Konu</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
              </div>
              <div class="form-group">
                <label for="name">Mesajınız</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="text-center">
                <input class="text-white" type="submit" value="Gönder" name="btngnc"/>
              </div>
              <div class="col-lg-12" id="call">
                <div id="number"><h2>0(506) 385 78 59</h2></div>
                <div id="ara">
                  <div id="containerara">
                    <a onClick="git();"><div id="callme"><img src="assets/img/tel.png"></div></a>
                    <a onClick="git();"><h2 id="yaz">Hemen Arayın</h2></a>
                  </div>
                  <p>Bana Ulaşmak için..</p>
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="credits">
        <a href="#">Hızır Serdar Yapıcı</a> tarafından tasarlanmıştır. 
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/lazy_loding.js"></script>
</body>

</html>