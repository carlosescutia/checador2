<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url('favicon.png')?>"/>

    <title>PHP App 4</title>

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

    <script>
    $(document).ready(function() {
        // create sidebar and attach to menu open
        $('.ui.sidebar')
            .sidebar()
        ;
        $('.selection.dropdown')
            .dropdown()
        ;
    });
    </script>
</head>
<body>

<!-- Sidebar Menu -->
<div class="ui sidebar"></div>

<!-- Page Contents -->
<div class="pusher">
<div class="ui hidden divider"></div>


