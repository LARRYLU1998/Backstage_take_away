<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = '會員列表';
$pageName = 'user list';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

# 每一頁有幾筆
$perPage = 15;

# 計算總筆數
$t_sql = "SELECT COUNT(1) FROM user";
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); # 總頁數
$rows = []; # 預設值為空陣列
if ($totalRows > 0) {
  # 有資料時, 才往下進行
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }

  # 取得分頁的資料
  $sql = sprintf("SELECT * FROM user ORDER BY user_id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
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

<section>
  <div class="container-fluid px-4">
    <h1 class="mt-4">會員專區</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
      <li class="breadcrumb-item active">會員列表</li>
    </ol>
    <a href="user-add.php" class="btn btn-dark btn-sm float-right mb-3">新增會員</a>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        會員列表
      </div>
      <div class="row">
        <div class="card-body col">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="align-middle">修改</i></th>
                <th class="align-middle">編號</th>
                <th class="align-middle">姓名</th>
                <th class="align-middle">手機</th>
                <th class="align-middle">Email</th>
                <th class="align-middle">地址</th>
                <th class="align-middle">刪除</i></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $r) : ?>
                <tr class="align-middle">
                  <td class="align-middle">
                    <a href="user-edit.php?user_id=<?= $r['user_id'] ?>">
                      <i class="fa-solid fa-file-pen"></i>
                    </a>
                  </td>
                  <td class="align-middle"><?= $r['user_id'] ?></td>
                  <td class="align-middle"><?= $r['name'] ?></td>
                  <td class="align-middle"><?= $r['phone'] ?></td>
                  <td class="align-middle"><?= $r['email'] ?></td>
                  <td class="align-middle"><?= htmlentities($r['address_detail']) ?></td>
                  <td class="align-middle">
                    <a href="javascript: deleteOne(<?= $r['user_id'] ?>)">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <div class="row">
            <div class="col">
              <nav aria-label="Page navigation example">
                <ul class="pagination" style="justify-content: center;">
                  <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=1">
                      <i class="fa-solid fa-angles-left"></i>
                    </a>
                  </li>
                  <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">
                      <i class="fa-solid fa-angle-left"></i>
                    </a>
                  </li>
                  <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
                    <?php if ($i >= 1 and $i <= $totalPages) : ?>
                      <li class="page-item <?= $i != $page ?: 'active' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                      </li>
                    <?php endif ?>
                  <?php endfor ?>
                  <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">
                      <i class="fa-solid fa-angle-right"></i>
                    </a>
                  </li>
                  <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $totalPages ?>">
                      <i class="fa-solid fa-angles-right"></i>
                    </a>
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

<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
  const myRows = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;
  // console.log(myRows);

  function deleteOne(user_id) {
    if (confirm(`是否要刪除編號為 ${user_id} 的項目?`)) {
      location.href = `user-delete.php?user_id=${user_id}`;
    }
  }
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>