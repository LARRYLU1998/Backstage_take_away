<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '訂單紀錄';
$pageName = 'order';


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

//讓使用者在輸入非數字的頁數時會跳轉到第一頁
if ($page < 1) {
  header('Location: ?page=1');
  exit; //跳轉後結束 不繼續執行
}
//每頁有幾筆
$perPage = 8;

//計算總筆數
$t_sql = "SELECT COUNT(1) FROM order_history";
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
//ceil 無條件進位
$totalPages = ceil($totalRows / $perPage); //總頁數

//讓使用者在輸入超過的頁數時會跳轉到最後頁
$rows = []; //預設為空陣列
if ($totalRows > 0) {
  //有資料時 再往下進行
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }

  //取得分頁資料
  $sql = sprintf("SELECT * FROM order_history order by order_id DESC  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll();
}


?>

<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<section>
  <div class="container-fluid px-4">
    <h1 class="mt-4">訂單紀錄</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
      <li class="breadcrumb-item active">訂單紀錄</li>
    </ol>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        歷史紀錄
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>變更狀態</th>
              <th>編號</th>
              <th class="text-nowrap">會員編號</th>
              <th class="text-nowrap">訂單詳情</th>
              <th class="text-nowrap">收件人</th>
              <th class="text-nowrap">收件人電話</th>
              <th class="text-nowrap">訂單日期</th>
              <th class="text-nowrap">備註</th>
              <th class="text-nowrap">寄送方式</th>
              <th class="text-nowrap">付款方式</th>
              <th class="text-nowrap">寄送地址</th>
              <th class="text-nowrap">訂單狀態</th>
              <th class="text-nowrap">電子條碼</th>
            </tr>
          </thead>
          <tbody>
            <!-- 4.用表格輸出資料 -->
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td>
                  <a href="order_history_edit.php?order_id=<?= $r['order_id'] ?>">
                    <p class="btn btn-outline-success btn-sm text-nowrap">變更狀態</p>
                  </a>
                </td>
                <td><?= $r['order_id'] ?></td>
                <td><?= $r['user_id'] ?></td>
                <td style="text-align: center;"><a href="order_detail.php?order_detail_id=<?= $r['order_detail_id'] ?>">
                    <i class="fa-solid fa-file fa-xl" style="color: #59786e;"></i>
                  </a></td>
                <td><?= $r['recipient_name'] ?></td>
                <td><?= $r['recipient_phone'] ?></td>
                <td><?= $r['order_date'] ?></td>
                <td><?= htmlentities($r['order_remark']) ?></td>
                <td><?= $r['delivery_method'] ?></td>
                <td><?= $r['payment_method'] ?></td>
                <td><?= $r['recipient_address_detail'] ?></td>
                <td><?= $r['status'] ?></td>
                <td><?= $r['Invoice_no'] ?></td>

              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
          <ul class="pagination">
            <li class="page-item" <?= $page == 1 ? 'disabled' : '' ?>>
              <a class="page-link" href="?page=1">
                <i class="fa-solid fa-angles-left"></i>
              </a>
            </li>

            <li class="page-item" <?= $page == 1 ? 'disabled' : '' ?>>
              <a class="page-link" href="?page=<?= $page - 1 ?>">
                <i class="fa-solid fa-angle-left"></i>
              </a>
            </li>

            <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
              <?php if ($i >= 1 and $i <= $totalPages) : ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endif ?>
            <?php endfor ?>

            <li class="page-item" <?= $page == $totalPages ? 'disabled' : '' ?>>
              <a class="page-link" href="?page=<?= $page + 1 ?>">
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </li>

            <li class="page-item" <?= $page == $totalPages ? 'disabled' : '' ?>>
              <a class="page-link" href="?page=<?= $totalPages ?>">
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>




<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
  //3.php 倒資料給 js
  const myRows = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;

  console.log(myRows);
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>