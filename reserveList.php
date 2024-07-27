<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = '線上預約紀錄';
$pageName = 'reserveList';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

# 每一頁有幾筆
$perPage = 10;

# 計算總筆數
$t_sql = "SELECT COUNT(1) FROM reserve_system";
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
  $sql = sprintf("SELECT * FROM reserve_system ORDER BY reservation_id  DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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
<style>
  .page-color {
    --bs-pagination-color: #6c757d;
    --bs-pagination-active-bg: #6c757d;
    --bs-pagination-disabled-color: #6c757d;


    position: relative;
    display: block;
    padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
    font-size: var(--bs-pagination-font-size);
    color: var(--bs-pagination-color);
    text-decoration: none;
    background-color: var(--bs-pagination-bg);
    border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
</style>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
<div class="container">
  <div class="row ">
    <h1 class="mt-4 fw-bold lh-lg text-secondary fs-2">線上預約紀錄</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
      <li class="breadcrumb-item active">線上預約紀錄</li>
    </ol>
    <div class="col table-striped table-hover ">
      <table class="table table-striped table-hover mt-2 border border-3 border-secondary">
        <thead>
          <tr class="text-center text-secondary fs-4">
            <th>預約#</th>
            <th>使用者ID</th>
            <th>寵物ID</th>
            <th>預約時間</th>
            <th><i></i></th>
            <th><i></i></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php /*
          # PHP 區塊註解
          */ ?>
          <?php foreach ($rows as $r) : ?>
            <tr class="text-center">
              <td class="d-flex justify-content-center"><?= $r['reservation_id'] ?></td>
              <td><?= Name($r['user_id'])  ?></td>
              <td><?= pet($r['pet_id'])  ?></td>
              <td class="d-flex justify-content-center"><?= $r['time'] ?></td>
              <td>
                <a href="reserveEdit.php?sid=<?= $r['reservation_id'] ?>" class="color-primary">
                  <i class="fa-solid fa-file-pen text-secondary d-flex justify-content-center  "></i>
              <td>
                <a href="javascript: deleteOne(<?= $r['reservation_id'] ?>)" class="color-primary">
                  <i class="fa-solid fa-trash text-secondary d-flex justify-content-center"></i>
                </a>
              </td>
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
      <nav aria-label="Page navigation example center ">
        <ul class="pagination ">
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
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
  const myRows = <?= json_encode($rows, JSON_UNESCAPED_UNICODE) ?>;
  // console.log(myRows);

  function deleteOne(reservation_id) {
    if (confirm(`是否要刪除編號為 ${reservation_id } 的項目?`)) {
      location.href = `reverveDelete.php?reservation_id=${reservation_id }`;
    }
  }
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>