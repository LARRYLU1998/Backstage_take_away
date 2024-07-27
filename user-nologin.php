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

<div class="container">
  <div class="row mt-3">
    <div class="col">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
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
  <div class="row">
    <div class="col">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>編號</th>
            <th>姓名</th>
            <th>手機</th>
            <th>Email</th>
            <th>照片</th>
            <th>地址</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r) : ?>
            <tr>
              <td><?= $r['user_id'] ?></td>
              <td><?= $r['name'] ?></td>
              <td><?= $r['phone'] ?></td>
              <td><?= $r['email'] ?></td>
              <td><?= $r['address_detail'] ?></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>

    </div>
  </div>


</div>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
  const myRows = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;
  // console.log(myRows);

  function deleteOne(user_id) {
    if (confirm(`是否要刪除編號為 ${user_id} 的項目?`)) {
      location.href = `user-delete.php?sid=${user_id}`;
    }
  }
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>