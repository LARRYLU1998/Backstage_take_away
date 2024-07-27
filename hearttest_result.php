<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '心理測驗';
$pageName = 'list';


//6-1.計算每頁有幾筆
// $perPage = 12;

//5.計算資料總筆數
$t_sql = "SELECT COUNT(1) FROM psycological_test_result";
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];



//2-1.取得分頁資料
$sql = sprintf("SELECT * FROM 
  psycological_test_result");
//2.讀取資料表
$rows = $pdo->query($sql)->fetchAll();


?>

<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<section>
  <div class="container-fluid px-4">
    <h1 class="mt-4">測驗結果</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
      <li class="breadcrumb-item active">測驗結果</li>
    </ol>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        結果類別
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <!-- 13.新增刪除編輯的功能按鈕 -->
              <th><i class="fa-solid fa-trash"></i></th>
              <th>編號</th>
              <th class="text-nowrap">個性種類</th>
              <th class="text-nowrap">圖片</th>
              <th class="text-nowrap">個性說明</th>
              <th>
                <a href="hearttest_result_add.php?result_id=" class="btn btn-primary btn-sm text-nowrap">新增類別</a>
              </th>
            </tr>
          </thead>
          <tbody>
            <!-- 4.用表格輸出資料 -->
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td>
                  <!-- 13-1. 符號設定-->
                  <a href="javascript: deleteOne(<?= $r['result_id'] ?>)">
                    <i class="fa-solid fa-trash btn btn-outline-danger"></i>
                  </a>
                </td>
                <td><?= $r['result_id'] ?></td>
                <td><?= $r['personality_type'] ?></td>
                <td><img src="uploads/<?= $r["pic"] ?>" alt="" style="width:400px"></td>
                <td><?= $r['type__content'] ?></td>
                <!-- 13-2.符號設定 -->
                <td>
                  <a href="hearttest_result_edit.php?result_id=<?= $r['result_id'] ?>">
                    <p class="btn btn-outline-success btn-sm">變更</p>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
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

  function deleteOne(result_id) {
    if (confirm(`是否要刪除編號為 ${result_id} 的項目?`)) {
      location.href = `hearttest_result_delete.php?result_id=${result_id}`;
    }
  }
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>