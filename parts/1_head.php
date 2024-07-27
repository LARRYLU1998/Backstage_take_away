<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="css/styles.css" rel="stylesheet" />
    <title><?= empty($title) ? 'TAKE PET AWAY' : "$title - TAKE PET AWAY" ?></title>
    <!-- <title>後臺介面</title> -->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<style>
    /* header 側nav */
    :root {
        --bs-dark-rgb: 83, 46, 28;
    }

    .sb-sidenav-dark {
        background-color: #8E806A;
    }

    .sb-sidenav-dark .sb-sidenav-footer {
        background-color: #8E806A;
    }

    .row {
        --bs-gutter-x: 0rem;
    }

    .pagination,
    .datatable-pagination ul {
        --bs-pagination-active-border-color: #EEE0C9;
        --bs-pagination-active-bg: #967E76;
        --bs-link-color: #967E76;
        --bs-link-hover-color: #967E76;
        --bs-dark-rgb: #967E76;
    }
</style>

<body class="sb-nav-fixed">