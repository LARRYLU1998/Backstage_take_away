<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = '線上認養紀錄';
$pageName = 'adoptList';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

# 每一頁有幾筆
$perPage = 10;

# 計算總筆數
$t_sql = "SELECT COUNT(1) FROM online_virtual_adoption_form";
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
  $sql = sprintf("SELECT * FROM online_virtual_adoption_form ORDER BY adopt_id  DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll();
}
function Name($user_id)
{
  switch ($user_id) {
    case '10001':
      return 'dana';
    case '10002':
      return '白賢祐';
    case '10003':
      return '洪海仁';
    case '10004':
      return '洪秀哲';
    case '10005':
      return '千多慧';
    case '10006':
      return '洪凡資';
    case '10007':
      return '全峰藹';
    case '10008':
      return '白斗關';
    case '10009':
      return '尹殷盛';
    case '10010':
      return '羅彩妍';
    case '10011':
      return '金陽基';
    default:
      return $user_id;
  }
}
function pet($pet_id)
{
  switch ($pet_id) {
    case '10001':
      return '露露';
    case '10002':
      return '馬克斯';
    case '10003':
      return '寶貝';
    case '10004':
      return '花花';
    case '10008':
      return '小雪';
    case '10009':
      return '皮皮';
    case '10011':
      return '罐頭';
    case '10012':
      return '嘟嘟';
    default:
      return $pet_id;
  }
}
?>
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
<div class="container">
  <div class="row ">
    <h1 class="mt-4 fw-bold lh-lg text-secondary fs-2">線上認養紀錄</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
      <li class="breadcrumb-item active">線上認養紀錄</li>
    </ol>
    <div class="col  ">
      <table class="table table-striped table-hover mt-2 border border-3 border-secondary">
        <thead>
          <tr class="text-center text-secondary fs-4 ">
            <th>認養#</th>
            <th>使用者ID</th>
            <th>寵物ID</th>
            <th>捐款方式</th>
            <th>捐款金額</th>
            <th>付款方式</th>
            <th>捐款用途</th>
            <th>捐贈證明寄送</th>
            <th><i></i></th>
            <th><i></i></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php /*
          # PHP 區塊註解
          */ ?>
          <?php foreach ($rows as $r) : ?>
            <tr class="text-center text-secondary fs-5">
              <td class="d-flex justify-content-center"><?= $r['adopt_id'] ?></td>
              <td><?= Name($r['user_id'])  ?></td>
              <td><?= pet($r['pet_id'])  ?></td>
              <td><?= $r['donation_method'] ?></td>
              <td><?= $r['amount'] ?></td>
              <td><?= $r['payment'] ?></td>
              <td><?= $r['donation'] ?></td>
              <td><?= $r['donate_address'] ?></td>
              <td>
                <a href="adoptEdit.php?adopt_id=<?= $r['adopt_id'] ?>" class="color-primary">
                  <i class="fa-solid fa-file-pen text-secondary d-flex justify-content-center "></i>
                </a>
              </td>
              <td>
                <a href="javascript: deleteOne(<?= $r['adopt_id'] ?>)">
                  <i class="fa-solid fa-trash text-primary d-flex justify-content-center text-secondary"></i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>

    </div>
  </div>

  <div class="row mt-5">
    <div class="col d-flex justify-content-center">
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
              <li class="page-item  <?= $i != $page ?: 'active' ?>">
                <a class="page-link bd-secondary" href="?page=<?= $i ?>"><?= $i ?></a>
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
<!-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">確認刪除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        確定要刪除編號為 <span id="adoptIdToDelete"></span> 的項目嗎？
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <a id="confirmDeleteBtn" class="btn btn-danger">刪除</a>
      </div>
    </div>
  </div>
</div> -->
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
  const myRows = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;
  // console.log(myRows);

  function deleteOne(adopt_id) {
    if (confirm(`是否要刪除編號為 ${adopt_id } 的項目?`)) {
      location.href = `adoptDelete.php?adopt_id=${adopt_id }`;
    }
  }
  // function deleteOne(adopt_id) {
  //       adoptIdSpan.textContent = adopt_id; // Set the ID in the modal
  //       confirmDeleteBtn.href = `adoptDelete.php?adopt_id=${adopt_id}`; // Set the delete URL
  //       deleteModal.show(); // Show the modal
  //       window.deleteOne = deleteOne;
  //   }
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>