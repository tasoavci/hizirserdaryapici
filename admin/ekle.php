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
        $yer=$_GET['yer'];
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Serdar Yapıcı | Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="anasayfa.php"><?php echo $_SESSION ["login_name"]; ?></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="cikis.php">Çıkış</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="anasayfa.php">
                                Anasayfa
                            </a>
                            <a class="nav-link" href="hakkinda.php">
                                Hakkımızda
                            </a>
                            <a class="nav-link" href="yetenek.php">
                                Yetenekler
                            </a>
                            <a class="nav-link" href="ozgecmis.php">
                                Özgeçmiş
                            </a>
                            <a class="nav-link" href="portfolio.php">
                                Portfolio
                            </a>
                            <a class="nav-link" href="cv.php">
                                CV
                            </a>
                            <a class="nav-link" href="referans.php">
                                Referanslar
                            </a>
                            <a class="nav-link" href="ilet.php">
                                İletişim
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <br>
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <div class="card text-white mb-4">
                                    <form method="post" action="<?php echo 'yukle_ekle.php?yer='.$yer;?>" enctype="multipart/form-data">
                                        <div class="card-header bg-primary">
                                            <h2>Ekleme<h2>
                                        </div>
                                        <div class="card-body">
                                            <?php if($yer=='a'){?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Slider Yazısı:</h3><br>
                                                <input class="form-control profil-form" type="text" name="home_title">
                                            </div>
                                            <?php }else if($yer=='hp'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Beni Tanı Paragraf Tipi:</h3><br>
                                                <select id="Paragraf" name="aboutpragraph_type">
                                                    <option value="Yazı">Yazı</option>
                                                    <option value="Ön Yazı">Ön Yazı</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Beni Tanı Paragraf:</h3><br>
                                                <textarea class="form-control profil-form" name="aboutpragraph_text"></textarea> 
                                            </div>
                                            <?php }else if($yer=='hb'){?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Beni Tanı Başlığı:</h3><br>
                                                <input class="form-control profil-form" type="text" name="aboutinfo_title">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Beni Tanı Yazısı:</h3><br>
                                                <input class="form-control profil-form" type="text" name="aboutinfo_text">
                                            </div>
                                            <?php }else if($yer=='yp'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Yetenekler Paragraf:</h3><br>
                                                <textarea class="form-control profil-form" name="skillsparagraph_text"></textarea>
                                            </div>
                                            <?php }else if($yer=='ys'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Yetenek:</h3><br>
                                                <input class="form-control profil-form" type="text" name="skillsinfo_skill">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Yetenek Yüzdesi:</h3><br>
                                                <input class="form-control profil-form" type="number" min="0" max="100" name="skillsinfo_percentile">
                                            </div>
                                            <?php }else if($yer=='oo'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Paragraf:</h3><br>
                                                <textarea class="form-control profil-form" name="resumesummary_paragraph"></textarea>
                                            </div>
                                            <?php }else if($yer=='oe'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Okul:</h3><br>
                                                <input class="form-control profil-form" type="text" name="resumeeducation_title">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Tarih:</h3><br>
                                                <input class="form-control profil-form" type="text" name="resumeeducation_date">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Şehir:</h3><br>
                                                <input class="form-control profil-form" type="text" name="resumeeducation_city">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Yazı:</h3><br>
                                                <textarea class="form-control profil-form" name="resumeeducation_text"></textarea>
                                            </div>
                                            <?php }else if($yer=='ot'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>İşyeri:</h3><br>
                                                <input class="form-control profil-form" type="text" name="resumeexperience_title">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Tarih:</h3><br>
                                                <input class="form-control profil-form" type="text" name="resumeexperience_date">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Şehir:</h3><br>
                                                <input class="form-control profil-form" type="text" name="resumeexperience_city">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Yazı:</h3><br>
                                                <textarea class="form-control profil-form" name="resumeexperience_text"></textarea>
                                            </div>
                                            <?php }else if($yer=='p'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Büyük Fotoğraf:</h3><br>
                                                <input class="form-control profil-form" type="file" name="dosya">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Küçük Fotoğraf:</h3><br>
                                                <input class="form-control profil-form" type="file" name="dosya2">
                                            </div>
                                            <?php }else if($yer=='c'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Cv Pdf:</h3><br>
                                                <input class="form-control profil-form" type="file" name="dosya">
                                            </div>
                                            <?php }else if($yer=='r'){ ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Referans İsmi:</h3><br>
                                                <input class="form-control profil-form" type="text" name="testimonial_user">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Referans Firması:</h3><br>
                                                <input class="form-control profil-form" type="text" name="testimonial_company">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Referans Pozisyonu:</h3><br>
                                                <input class="form-control profil-form" type="text" name="testimonial_position">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Referans Email:</h3><br>
                                                <input class="form-control profil-form" type="mail" name="testimonial_email">
                                            </div>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Referans Telefonu:</h3><br>
                                                <input class="form-control profil-form" type="mail" name="testimonial_phone">
                                            </div>

                                            <?php }else if($yer=='os'){
                                            ?>
                                            <div class="col-xl-6 col-md-6" style="color:#000; margin: 2%;">
                                                <h3>Slider Fotografı :</h3><br>
                                                <input class="form-control profil-form" type="file" name="dosya">
                                            </div>
                                        <?php } ?>
                                        </div>
                                        <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                                            <input class="text-white" style="background: none; border:none;" type="submit" value="Ekle" name="ekle" />
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Website 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>