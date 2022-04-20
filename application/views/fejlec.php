<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=base_url()?>/favicon.ico">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
    <?php if (isset($stylesheets)): ?>
    <?php foreach ($stylesheets as $stylesheet): ?>
    <link rel="stylesheet" href="<?php echo base_url()."public/css/".$stylesheet.".css"; ?>">
    <?php endforeach; ?>
    <?php endif; ?>
    <title>Országos Állatorvos Kereső<?php echo $title ?></title>
    <?php if (isset($oldal)) : ?>
    <script>
    $(function() {
        $('#<?php echo $oldal; ?>').addClass('active');
    });
    </script>
    <?php endif; ?>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-custom navbar-dark bg-primary fixed-top">

            <a class="navbar-brand" href="<?php echo base_url(); ?>kezdolap/index">Kezdőoldal</a>
            <ul class="nav navbar-nav">
                <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '3'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Rendelők</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>rendelok/index">Rendelők listája</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Orvosok</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>orvosok/index">Orvosok listája</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Állatok</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>allatok/index">Állatok listája</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Árak</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>arak/index">Árak listája</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Szolgáltatások</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>szolgaltatasok/index">Szolgáltatások
                            listája</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Nyitvatartások</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>nyitvatartasok/index">Nyitvatartások
                            listája</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Vélemények</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>velemenyek/rogzit">Vélemény
                            rögzítése</a>
                    </div>
                </li>
                <?php else: ?>
                <?php endif; ?>

                <?php if ($this->session->userdata('felhasznalonev') !== NULL && $this->session->userdata('tipus') === '1'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Rendelők</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>rendelok/index">Rendelők listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>rendelok/rogzit">Rendelő rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Orvosok</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>orvosok/index">Orvosok listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>orvosok/rogzit">Orvos rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Állatok</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>allatok/index">Állatok listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>allatok/rogzit">Állat rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Árak</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>arak/index">Árak listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>arak/rogzit">Ár rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Szolgáltatások</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>szolgaltatasok/index">Szolgáltatások
                            listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>szolgaltatasok/rogzit">Szolgáltatás
                            rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Nyitvatartások</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>nyitvatartasok/index">Nyitvatartások
                            listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>nyitvatartasok/rogzit">Nyitvatartás
                            rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Felhasználók</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>felhasznalok/index">Felhasználók
                            listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>felhasznalok/rogzit">Felhasználó
                            rögzítése</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Vélemények</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>velemenyek/index">Vélemények listája</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>velemenyek/rogzit">Vélemény
                            rögzítése</a>
                    </div>
                </li>
                <?php else: ?>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if ($this->session->userdata('felhasznalonev') !== NULL): ?>
                <li class="nav-item" id="kijelentkezes">
                    <a class="nav-link" href="<?php echo base_url(); ?>kijelentkezes">Kijelentkezés</a>
                </li>
                <?php else: ?>
                <li class="nav-item" id="regisztracio">
                    <a class="nav-link" href="<?php echo base_url(); ?>regisztracio">Regisztráció</a>
                </li>
                <li class="nav-item" id="bejelentkezes">
                    <a class="nav-link" href="<?php echo base_url(); ?>bejelentkezes">Bejelentkezés</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <br>
        <br>
        <br>
        <div class="container">
            <?php if ($this->session->userdata('success') !== NULL) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->userdata('success'); ?>
            </div>
            <?php endif; ?>

            <?php if ($this->session->userdata('error') !== NULL) : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->userdata('error'); ?>
            </div>
            <?php endif; ?>