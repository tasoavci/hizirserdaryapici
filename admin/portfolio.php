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
            $info=mysqli_query($db,"select * from portfolio");
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
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" >
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
                                    <div class="card-header bg-primary">
                                            <h2>Portfolio</h2>
                                        </div>
                                    <div class="card-body">
                                        <table id="datatablesSimple1">
                                            <thead>
                                                <tr>
                                                    <th>Küçük Resim</th>
                                                    <th>Büyük Resim</th>
                                                    <th style="opacity: 0;"></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Küçük Resim</th>
                                                    <th>Büyük Resim</th>
                                                    <th style="opacity: 0;"></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php while ($portfolio=mysqli_fetch_array($info)){ ?>
                                                <tr>
                                                    <td>
                                                        <?php if($portfolio['Portfolio_Type']=="images"){ ?>
                                                            <img style="width: 70%; margin-bottom: 2%;" src="<?php echo '../assets/img/portfolio/'.$portfolio['Portfolio_Frontimg'];?>"/>
                                                        <?php }else{ ?>
                                                            <video style="width: 70%; margin-bottom: 2%;" controls>
                                                                <source src="<?php echo '../assets/img/portfolio/'.$portfolio['Portfolio_Frontimg'];?>">
                                                            </video>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($portfolio['Portfolio_Type']=="images"){ ?>
                                                            <img style="width: 35%; margin-bottom: 2%;" src="<?php echo '../assets/img/SERDAR_PORTFOLIO/'.$portfolio['Portfolio_Magnificationimg'];?>"/>
                                                        <?php }else{ ?>
                                                            <video style="width: 70%; margin-bottom: 2%;" controls>
                                                                <source src="<?php echo 'assets/img/SERDAR_PORTFOLIO/'.$portfolio['Portfolio_Magnificationimg'];?>">
                                                            </video>
                                                        <?php } ?>
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo "duzen.php?yer=p&duzen=".$portfolio["Portfolio_Id"] ?>">
                                                            <input class="btn btn-primary" type="submit" value="Düzenle">
                                                        </a>
                                                        <a href="<?php echo 'sil.php?yer=p&sil='.$portfolio["Portfolio_Id"] ?>">
                                                            <input class="btn btn-danger" type="submit" value="Sil">
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer bg-primary d-flex align-items-center justify-content-between">
                                        <a class="small text-white" href="ekle.php?yer=p">Yeni Ekle</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
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