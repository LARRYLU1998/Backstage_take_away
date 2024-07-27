<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = "Blog";



#page轉換整數
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

#page輸入小於1,則直接到page=1的頁面
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

# 每一頁有幾筆
$perPage = 10;

# 計算總筆數
$total_sql = "SELECT COUNT(1) FROM blog";
$total_stmt = $pdo->query($total_sql);
$totalRows = $total_stmt->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); # 總頁數
$rows = []; # 預設值為空陣列


if ($totalRows > 0) {
  # 有資料時, 才往下進行
  if ($page > $totalPages) {
    header('Location: ?page=' . $totalPages);
    exit;
  }
  $sql = sprintf("SELECT * FROM blog ORDER BY blog_id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll();
}

?>






<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>





<!-- 資料表顯示 -->
<div class="container">
  <div class="row">
    <h3 class="text-center mt-5 fw-bold lh-lg text-secondary fs-2">線上認養紀錄</h3>
    <div class="col">
      <table class="table table-striped table-hover mt-2 border border-3 border-secondary">
        <thead>
          <tr class="text-center">
            <th>blog_id</th>
            <th>pet_id</th>
            <th>content</th>
            <th>picture</th>
            <th>time</th>
            <th><i>編輯</i></th>
            <th><i>刪除</i></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <?php /*
          # PHP 區塊註解
          */ ?>
          <?php foreach ($rows as $r) : ?>
            <tr class="text-center">
              <td><?= $r['blog_id'] ?></td>
              <td><?= $r['pet_id'] ?></td>
              <td><?= $r['content'] ?></td>
              <td>
                <div><img style="width: 50px;" src="uploads/<?= $r['pic'] ?>" alt=""> </div>
              </td>
              <td><?= $r['time'] ?></td>
              <td>
                <a href="blog_edit.php?blog_id=<?= $r['blog_id'] ?>">
                  <i class="fa-solid fa-file-pen"></i>
                </a>
              </td>
              <td>
                <a href="javascript: deleteOne(<?= $r['blog_id'] ?>)">
                  <i class="fa-solid fa-trash"></i>
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
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>

<script>
  function deleteOne(blog_id) {
    if (confirm(`是否要刪除編號為 ${blog_id} 的項目?`)) {
      location.href = `blog_delete.php?blog_id=${blog_id}`;
    }
  }
</script>

<?php include __DIR__ . '/parts/6_foot.php' ?>