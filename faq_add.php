<?php
require __DIR__ . '/parts/admin-required.php';
// 連結到資料庫
$conn = new PDO("mysql:host=localhost:3306;dbname=take_pet_away", "root", "admin");
$title = "注意事項";
//判斷表單提交情形
if (isset($_POST["submit"])) {
    //創建 table 如果還未建立
    $sql = "CREATE TABLE IF NOT EXISTS faq_shopinfo(
        question_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        small_question VARCHAR(60) NOT NULL,
        faq_answer TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $statement = $conn->prepare($sql);
    $statement->execute();

    // 將問題存入faq_shopinfo
    $sql = "INSERT INTO faq_shopinfo (small_question, faq_answer) VALUES (?, ?)";
    $statement = $conn->prepare($sql);
    $statement->execute([$_POST["question"], $_POST["answer"]]);
}
// 1
// # 回應給用戶端的欄位 (格式 JSON)
// $output = [
//     'success' => false,
//     'postData' => $_POST, # 除錯用
//     'error' => '欄位資料不足',
//     'code' => 0, # 除錯或追踪程式碼
//   ];

//抓出所有faq並以降冪排序
$sql = "SELECT * FROM faq_shopinfo ORDER BY question_id DESC";
$statement = $conn->prepare($sql);
$statement->execute();
$faqs = $statement->fetchAll();
?>

<!-- 外部資源引入 -->
<!-- include bootstrap, font awesome and rich text library CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />

<!-- include jquer, bootstrap and rich text JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>

<!-- 引入上欄、側邊欄 -->
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
<!-- 新增FAQ表單 -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center">新增商城常見問題</h1>
            <!-- for to add FAQ -->
            <form method="POST" action="faq_add.php">
                <!-- 問題 -->
                <div class="form-group mb-3">
                    <label>輸入問題</label>
                    <input type="text" name="question" class="form-control" required />
                </div>
                <!-- 答案 -->
                <div class="form-group mb-3">
                    <label>輸入答案</label>
                    <textarea id="answer" name="answer" class="form-control" required></textarea>
                </div>
                <!-- 提交按鈕 -->
                <input type="submit" name="submit" class="btn btn-info" value="新增 FAQ" />
                <a href="faq_index.php" class="btn btn-info">預覽前台</a>
            </form>
        </div>
    </div>

    <!-- show all FAQs added -->
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <table class="table table-bordered">
                <!-- table heading -->
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>問題</th>
                        <th>答案</th>
                        <th>編輯/刪除</th>
                    </tr>
                </thead>
                <!-- table body -->
                <tbody>
                    <?php foreach ($faqs as $faq) : ?>
                        <tr>
                            <td><?php echo $faq["question_id"]; ?></td>
                            <td><?php echo $faq["small_question"]; ?></td>
                            <td><?php echo $faq["faq_answer"]; ?></td>
                            <td>
                                <!-- 編輯按鈕 -->
                                <a href="faq_edit.php?id=<?php echo $faq['question_id']; ?>" class="btn btn-warning btn-sm mb-3">編輯</a>
                                <!-- 刪除表單 -->
                                <form method="POST" action="faq_delete.php" onsubmit="return confirm('確定要刪除這個FAQ?');">
                                    <input type="hidden" name="id" value="<?php echo $faq['question_id']; ?>" required />
                                    <input type="submit" value="刪除" class="btn btn-danger btn-sm" />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
    //初始化 rt library
    window.addEventListener("load", function() {
        $("#answer").richText();
    });
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>