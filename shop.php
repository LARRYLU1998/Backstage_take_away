<?php
require __DIR__ . '/parts/pdo-connect.php'; #獲取資料庫連線資料

$title = '商城產品';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}


$perPage = 10; #決定一頁有多少筆資料

$t_sql = "SELECT COUNT(1) FROM commodity"; #這是要查詢表單所有資料所以 FROM之後 要改自己的表單
$t_stmt = $pdo->query($t_sql); #這是要執行上方查詢的動作
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); #總筆數除一頁有幾筆 ceil為無條件進位 並存入一個變數(總頁數的算法)
$rows = []; #預設是空陣列

if ($totalPages > 0) {
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }
}


$sql = sprintf("SELECT * FROM commodity LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
$rows = $pdo->query($sql)->fetchAll();
?>

<!-- 所有頁面的拼接順序 每一頁都主要是換掉section的部分 -->
<?php include __DIR__ . '/parts/1_head.php' ?>
<style>
    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        border-color: #EEE0C9;
    }

    .table> :not(caption)>*>*,
    .datatable-table> :not(caption)>*>* {
        background-color: #F1F0E8;
    }

    .row .card-body .table-striped thead tr th {
        text-align: center;
    }

    .row .card-body .table-striped tbody tr th {
        text-align: center;
    }

    .row .card-body .table-striped tbody tr td {
        text-align: center;
    }

    .card-header {
        background-color: #967E76;
    }

    .card {
        border-color: #D7C0AE;
    }

    .pagination,
    .datatable-pagination ul {
        --bs-pagination-active-border-color: #EEE0C9;
        --bs-pagination-active-bg: #967E76;
        --bs-link-color: #967E76;
        --bs-link-hover-color: #967E76;
        --bs-dark-rgb: #967E76;
    }

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
</style>

<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<section>
    <div class="container-fluid px-4">
        <h1 class="mt-4">商城產品</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
            <li class="breadcrumb-item active">商城產品</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                商品清單
            </div>
            <div class="row">
                <div class="card-body col">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle" scope="col">產品編號</th>
                                <th style="width: 15%;" class="align-middle" scope="col">產品圖片</th>
                                <th class="align-middle" scope="col">產品名稱</th>
                                <th class="align-middle" scope="col">品牌名稱</th>
                                <th class="align-middle" scope="col">產品價格</th>
                                <th class="align-middle" scope="col">產品種類</th>
                                <th class="align-middle" scope="col">適用物種</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r) : ?>
                                <tr>
                                    <!-- $r[裡面要改成表單的欄位名稱123] -->
                                    <th class="align-middle"><?= $r['commodity_id'] ?></th>
                                    <td class="align-middle"><img style="width: 100%;" src="uploads/<?= $r['pic'] ?>" alt="">
                                    </td>
                                    <td class="align-middle"><?= $r['name'] ?></td>
                                    <td class="align-middle"><?= $r['brand_name'] ?></td>
                                    <td class="align-middle"><?= $r['price'] ?></td>
                                    <td class="align-middle"><?= $r['type'] ?></td>
                                    <td class="align-middle"><?= $r['species'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <nav aria-label="Page navigation example ">
                                <ul class="pagination" style="justify-content: center;">
                                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page= 1"><i class="fa-solid fa-angles-left"></i></a>
                                    </li>
                                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                                    </li>
                                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) : ?>
                                        <?php if ($i >= 1 and $i <= $totalPages) : ?>
                                            <li class="page-item <?= $i != $page ?: 'active' ?>">
                                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                            </li>
                                        <?php endif ?>
                                    <?php endfor ?>
                                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                                    </li>
                                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                        <a class="page-link" href="?page=<?= $totalPages ?>"><i class="fa-solid fa-angles-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<?php include __DIR__ . '/parts/6_foot.php' ?>