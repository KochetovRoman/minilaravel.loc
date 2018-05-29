<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../../public/css/images/favicon.ico" />
    <link rel="stylesheet" href="../../public/css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../public/css/form.css" type="text/css" media="all" />
    <script src="../../public/js/jquery.js" type="text/javascript"></script>
    <script src="../../public/js/form.js" type="text/javascript"></script>
    <script src="../../public/js/navigation.js" type="text/javascript"></script>
 </head>
<body>
<div id="wrapper">
    <!-- header -->
    <header class="header">
        <!-- shell -->
        <div class="shell">
            <h1 id="logo"><a href="/">WebLab</a></h1>
            <!-- navigation -->
            <nav id="navigation">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/about">Обо мне</a></li>
                    <li><a href="/post">Посты</a></li>
                    <li><a href="/portfolio">Портфолио</a></li>
                    <li><a href="/contact">Контакты</a></li>
                    <li><a href="/admin/login">Админка</a></li>
                    <?php if (isset($_SESSION['account']['id'])): ?>
                        <li><a href="/account/profile">Привет, <?php echo $_SESSION['account']['login'] ?></a>| <a  href="/account/logout" >Выход</a></li>
                    <?php else: ?>
                        <li><a href="/account/registration">Регистрация</a>| <a  href="/account/login" >Вход</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <!-- navigation -->
        </div>
        <!-- end of shell -->
    </header>
    <!-- end of header -->
    <div class="rightSidebar">

    </div>

    <div class="leftSidebar">
        <h1></h1>
    </div>

    <!-- shell -->
    <div class="shell">
        <div class="main">
        <!-- main -->
        <?php echo $content; ?>
        <!-- end of main -->
        </div>
    </div>
    <!-- end of shell -->
    <div id="footer-push"></div>
</div>
<!-- footer -->
<div id="footer">
    <!-- shell -->
    <div class="shell">
        <div class="widgets">

            <div class="widget">
                <h4>КАТЕГОРИИ</h4>
                <ul>
                    <li><a href="#">Art of Photography</a></li>
                    <li><a href="#">Design Template</a></li>
                    <li><a href="#">Website &amp; Development</a></li>
                    <li><a href="#">How to Create a Great Layout</a></li>
                    <li><a href="#">Beautiful Backgrounds</a></li>
                    <li><a href="#">Customisation</a></li>
                </ul>
            </div>

            <div class="widget gallery-widget">
                <h4>ГАЛЕРЕЯ</h4>
                <ul>
                    <li><a href="#"><img src="../../public/css/images/gallery-img.png" alt="" /></a></li>
                    <li><a href="#"><img src="../../public/css/images/gallery-img2.png" alt="" /></a></li>
                    <li><a href="#"><img src="../../public/css/images/gallery-img3.png" alt="" /></a></li>
                    <li><a href="#"><img src="../../public/css/images/gallery-img4.png" alt="" /></a></li>
                    <li><a href="#"><img src="../../public/css/images/gallery-img5.png" alt="" /></a></li>
                    <li><a href="#"><img src="../../public/css/images/gallery-img6.png" alt="" /></a></li>
                </ul>
            </div>

            <div class="widget">
                <h4>Web Lab</h4>
                <ul>
                    <li><a href="#">More About Us</a></li>
                    <li><a href="#">Our Portfolio Company</a></li>
                    <li><a href="#">Company Blog</a></li>
                    <li><a href="#">Our Mission</a></li>
                    <li><a href="#">Get in Touch with UsMore</a></li>
                </ul>
            </div>

            <div class="widget contact-widget">
                <h4>КОНТАКТЫ</h4>
                <p class="address-ico">
                    Company Name Head Office<br />
                    1234 City Name, <br />
                    Country 7451
                </p>

                <p class="phone-ico">
                    Phone: +375447549540
                </p>
                <a href="#" class="chat-btn"><span class="chat-ico"></span>Client Sheet</a>
            </div>
            <div class="cl">&nbsp;</div>
        </div>
        <!-- end of widgets -->

        <!-- footer-bottom -->
        <div class="footer-bottom">
            <!-- footer-nav -->
            <div class="footer-nav">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/about">Обо мне</a></li>
                    <li><a href="/post">Посты</a></li>
                    <li><a href="/portfolio">Портфолио</a></li>
                    <li><a href="/contact">Контакты</a></li>
                    <li><a href="/admin/login">Админка</a></li>
                </ul>
            </div>
            <!-- end of footer-nav -->
            <p class="copy">&copy; Kochetov Roman 2018</a></p>
        </div>
        <!-- end of footer-bottom -->
    </div>
    <!-- end of shell -->
</div>
<!-- end of footer -->
</body>
</html>



