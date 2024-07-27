<?php
require __DIR__ . '/parts/admin-required.php';
//連結資料庫
$conn = new PDO("mysql:host=localhost:3306;dbname=take_pet_away", "root", "admin");
$title = "注意事項";
//確認如果FAQ存在
$sql = "SELECT * FROM faq_shopinfo WHERE question_id = ?";
$statement = $conn->prepare($sql);
$statement->execute([
    $_REQUEST["id"]
]);
$faq = $statement->fetch();
if (!$faq) {
    die("FAQ 沒有找到");
}
// 1
//確認修改表單有無提交
if (isset($_POST["submit"])) {
    //update the FAQ in database
    $sql = "UPDATE faq_shopinfo SET small_question = ?, faq_answer = ? WHERE question_id = ?";
    $statement = $conn->prepare($sql);
    $statement->execute([
        $_POST["question"],
        $_POST["answer"],
        $_POST["id"]
    ]);
    // redirect back to previous page
    header("Location:" . $_SERVER["HTTP_REFERER"]);
}
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

<!-- 修改FAQ的表單 -->
<div class="container mt-3">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center">修改 FAQ</h1>
            <!-- form to edit FAQ -->
            <form action="faq_edit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $faq['question_id']; ?>" required />
                <!-- question auto-pop -->
                <div class="form-group">
                    <label>輸入問題</label>
                    <input type="text" name="question" class="form-control" value="<?php echo $faq['small_question']; ?>" required />
                </div>
                <!-- answer auto-pop -->
                <div class="form-group">
                    <label>輸入答案</label>
                    <textarea name="answer" id="answer" class="form-control" required><?php echo $faq['faq_answer']; ?></textarea>
                </div>
                <!-- 提交按紐 -->
                <input type="submit" name="submit" class="btn btn-warning" value="確認編輯" />
                <a href="faq_add.php" class="btn btn-info ml-3">回到新增頁面</a>
            </form>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
    // 初始化 rt library
    window.addEventListener("load", function() {
        $("#answer").richText();
    });
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>