<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url('favicon.png')?>"/>

    <title>Checador2</title>

    <link href="<?=base_url('assets/css/phpapp4.css')?>" rel="stylesheet"/>

    <!-- jquery -->
    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>

    <!-- semantic-ui -->
    <link href="<?=base_url('assets/css/semantic.min.css')?>" rel="stylesheet"/>
    <script src="<?=base_url('assets/js/semantic.min.js')?>"></script>

    <!-- datatables -->
    <link href="<?=base_url('assets/css/datatables.min.css')?>" rel="stylesheet"/>
    <script src="<?=base_url('assets/js/datatables.min.js')?>"></script>

    <!-- chart.js -->
    <script src="<?=base_url('assets/js/chart.js')?>"></script>
    <script src="<?=base_url('assets/js/chartjs-plugin-datalabels')?>"></script>

    <!-- utils.js -->
    <script src="<?=base_url('assets/js/utils.js')?>"></script>

    <style type="text/css">
        .secondary.pointing.menu .toc.item {
            display: none;
        }

        .secondary.pointing.menu .visible {
            display: block;
        }

        @media only screen and (max-width: 700px) {
            .secondary.pointing.menu .item,
            .secondary.pointing.menu .menu {
                display: none;
            }
            .secondary.pointing.menu .toc.item {
                display: block;
            }
        }
    </style>

    <script>
    $(document).ready(function() {
        // create sidebar and attach to menu open
        $('.ui.sidebar')
            .sidebar('attach events', '.toc.item')
        ;
        $('.selection.dropdown')
            .dropdown()
        ;
    });
    </script>
</head>
<body>

<?php
    $session = service('session');
    $userdata = $session->get();
    $id_usuario = $userdata['id_usuario'];

    $acceso_sistema_model = model('Acceso_sistema_model');
    $permisos_usuario = explode(',', $acceso_sistema_model->get_permisos_usuario($id_usuario));
?>

<!-- Sidebar Menu -->
<div class="ui left vertical sidebar massive menu">

    <a class="item" href="<?=site_url('incidentes')?>">
      <i class="home icon"></i>
        Incidentes
    </a>

    <?php
        $permisos_requeridos = array(
            'importar.can_edit',
        );
    ?>
    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
        <a class="item" href="<?=site_url('importar')?>">
            <i class="file alternate icon"></i>
            Importar
        </a>
    <?php endif ?>

    <?php
        $permisos_requeridos = array(
            'reporte.can_view',
        );
    ?>
    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
        <a class="item" href="<?=site_url('reportes')?>">
            <i class="file alternate icon"></i>
            Reportes
        </a>
    <?php endif ?>

    <?php
        $permisos_requeridos = array(
            'catalogo.can_view',
        );
    ?>
    <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
        <a class="item" href="<?=site_url('catalogos')?>">
            <i class="wrench icon"></i>
            Catálogos
        </a>
    <?php endif ?>

    <a class="item">
      <i class="user icon"></i>
      <?= $userdata['nom_usuario'] ?>
    </a>

    <a class="item" href="<?=site_url('logout')?>">
        <i class="sign out alternate icon"></i>
        Salir
    </a>

</div>

<!-- Page Contents -->
<div class="pusher">
<div class="ui vertical center aligned segment">
    <?php
        $nombre_archivo = 'logo.png';
        $up_dir = 'assets/img/';
        $nombre_archivo_fs = $up_dir . $nombre_archivo;
        $nombre_archivo_url = base_url($up_dir . $nombre_archivo);
    ?>

    <div class="ui container barra no-print">
        <div class="ui large secondary pointing menu">
            <a class="toc item">
                <i class="sidebar icon"></i>
            </a>
            <div class="header item">
                Checador2
            </div>
            <div class="ui toc item"><h3>Checador2</h3></div>
            <div class="ui toc item">
                <div class="ui horizontal list">
                    <div class="item">
                        <?php if ( file_exists($nombre_archivo_fs) and $nombre_archivo_fs !== $up_dir ): ?>
                            <img class="ui bordered image" src="<?= $nombre_archivo_url ?>" style="height:30px; width:30px">
                        <?php else: ?>
                            <img class="ui bordered image" src="<?= base_url('assets/img/image.png') ?>" style="height:30px; width:30px">
                        <?php endif ?>
                        <div class="content">
                            <?=$userdata['nom_usuario'] ? $userdata['nom_usuario'] : $userdata['nom_usuario']?>
                        </div>
                    </div>
                </div>
            </div>

            <a class="item" href="<?=site_url('incidentes')?>">Incidentes</a>

            <?php
                $permisos_requeridos = array(
                    'importar.can_edit',
                );
            ?>
            <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                <a class="item" href="<?=site_url('importar')?>">Importar</a>
            <?php endif ?>

            <?php
                $permisos_requeridos = array(
                    'reporte.can_view',
                );
            ?>
            <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                <a class="item" href="<?=site_url('reportes')?>">Reportes</a>
            <?php endif ?>

            <?php
                $permisos_requeridos = array(
                    'catalogo.can_view',
                );
            ?>
            <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                <a class="item" href="<?=site_url('catalogos')?>">Catálogos</a>
            <?php endif ?>

            <div class="right menu">
                <div class="item" style="height: 40px;">
                    <a href="#">
                        <?php if ( file_exists($nombre_archivo_fs) and $nombre_archivo_fs !== $up_dir ): ?>
                            <img class="ui bordered image" src="<?= $nombre_archivo_url ?>" style="height:30px; width:30px">
                        <?php else: ?>
                            <img class="ui bordered image" src="<?= base_url('assets/img/image.png') ?>" style="height:30px; width:30px">
                        <?php endif ?>
                    </a>
                    <span>
                        <a class="item usuario-menu" href="#"><?=$userdata['nom_usuario'] ? $userdata['nom_usuario'] : $userdata['nom_usuario']?></a>
                    </span>
                </div>
                <a class="item" href="<?=site_url('logout')?>">Salir</a>
            </div>

        </div>
    </div>

</div>
