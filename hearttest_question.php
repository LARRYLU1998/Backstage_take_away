<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '心理測驗';
$pageName = 'list';



//5.計算資料總筆數
$t_sql = "SELECT COUNT(1) FROM psycological_test";
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];



//2-1.取得分頁資料//7-2.更改分頁筆數排序
$sql = sprintf("SELECT * FROM 
  psycological_test ");
//2.讀取資料表
$rows = $pdo->query($sql)->fetchAll();


?>

<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<section>
  <div class="container-fluid px-4">
    <h1 class="mt-4">測驗題目</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
      <li class="breadcrumb-item active">測驗題目</li>
    </ol>
    <div class="card mb-4">
      <div class="card-header">
        <i class="fas fa-table me-1"></i>
        題目與對應分數
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <!-- 13.新增刪除編輯的功能按鈕 -->
              <th><i class="fa-solid fa-trash"></i></th>
              <th>編號</th>
              <th>題目</th>
              <th>選項A</th>
              <th>選項B</th>
              <th>選項C</th>
              <th>選項D</th>
              <th class="text-nowrap">A 配分</th>
              <th class="text-nowrap">B 配分</th>
              <th class="text-nowrap">C 配分</th>
              <th class="text-nowrap">D 配分</th>
              <th>
                <!-- 完全新增一筆資料 將question_id設為空值 -->
                <a href="hearttest_question_add.php?question_id=" class="btn btn-primary btn-sm text-nowrap">新增題目</a>
              </th>
            </tr>
          </thead>
          <tbody>
            <!-- 4.用表格輸出資料 -->
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td>
                  <!-- 13-1. 符號設定-->
                  <a href="javascript: deleteOne(<?= $r['question_id'] ?>)">
                    <i class="fa-solid fa-trash btn btn-outline-danger"></i>
                  </a>
                </td>
                <td><?= $r['question_id'] ?></td>
                <td><?= $r['question_content'] ?></td>
                <td><?= $r['option_a'] ?></td>
                <td><?= $r['option_b'] ?></td>
                <td><?= $r['option_c'] ?></td>
                <td><?= $r['option_d'] ?></td>
                <td><?= $r['option_value_a'] ?></td>
                <td><?= $r['option_value_b'] ?></td>
                <td><?= $r['option_value_c'] ?></td>
                <td><?= $r['option_value_d'] ?></td>
                <!-- 13-2.符號設定 -->
                <td>
                  <a href="hearttest_question_edit.php?question_id=<?= $r['question_id'] ?>">
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


  function deleteOne(question_id) {
    if (confirm(`是否要刪除編號為 ${question_id} 的項目?`)) {
      location.href = `hearttest_question_delete.php?question_id=${question_id}`;
    }
  }

</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>