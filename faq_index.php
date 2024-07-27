<?php
// 連結到資料庫
$conn = new PDO("mysql:host=localhost:3306;dbname=take_pet_away", "root", "admin");
$title = "注意事項";
// 1
//從資料庫抓取所有FAQ
$sql = "SELECT * FROM faq_shopinfo";
$statement = $conn->prepare($sql);
$statement->execute();
$faqs = $statement->fetchAll();
?>
<!-- 前台會看到的畫面 -->
<!-- 包含CSS、JS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>

<!-- 引入上欄、側邊欄 -->
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<!-- show all FAQs in a panel -->
<h1 class="mt-4 ml-3 fw-bold lh-lg text-secondary fs-2">預覽注意事項</h1>
<ol class="breadcrumb mb-4 ml-3">
	<li class="breadcrumb-item"><a href="index_.php">首頁</a></li>
	<li class="breadcrumb-item active">預覽注意事項</li>
</ol>
<div class="container">
	<a href="faq_add.php" class="btn btn-info ml-3">回到新增頁面</a>
	<div class="row">
		<div class="col-md-12 accordion_one">
			<div class="panel-group mt-4">
				<?php foreach ($faqs as $faq) : ?>
					<div class="panel panel-default">

						<!-- button to show the question -->
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#faq-<?php echo $faq['question_id']; ?>" aria-expanded="false" class="collapsed">
									<?php echo $faq['small_question']; ?>
								</a>
							</h4>
						</div>

						<!-- accordion for answer -->
						<div id="faq-<?php echo $faq['question_id']; ?>" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
							<div class="panel-body">
								<div class="text-accordion">
									<?php echo $faq['faq_answer']; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<!-- apply some styles -->
<style>
	.accordion_one .panel-group {
		border: 1px solid #f1f1f1;
		/* margin-top: 100px */
	}

	a:link {
		text-decoration: none
	}

	.accordion_one .panel {
		background-color: transparent;
		box-shadow: none;
		border-bottom: 0px solid transparent;
		border-radius: 0;
		margin: 0
	}

	.accordion_one .panel-default {
		border: 0
	}

	.accordion-wrap .panel-heading {
		padding: 0px;
		border-radius: 0px
	}

	h4 {
		font-size: 18px;
		line-height: 24px
	}

	.accordion_one .panel .panel-heading a.collapsed {
		color: #999999;
		display: block;
		padding: 12px 30px;
		border-top: 0px
	}

	.accordion_one .panel .panel-heading a {
		display: block;
		padding: 12px 30px;
		background: #fff;
		color: #313131;
		border-bottom: 1px solid #f1f1f1
	}

	.accordion-wrap .panel .panel-heading a {
		font-size: 14px
	}

	.accordion_one .panel-group .panel-heading+.panel-collapse>.panel-body {
		border-top: 0;
		padding-top: 0;
		padding: 25px 30px 30px 35px;
		background: #fff;
		color: #999999
	}

	.img-accordion {
		width: 81px;
		float: left;
		margin-right: 15px;
		display: block
	}

	.accordion_one .panel .panel-heading a.collapsed:after {
		content: "\2b";
		color: #999999;
		background: #f1f1f1
	}

	.accordion_one .panel .panel-heading a:after,
	.accordion_one .panel .panel-heading a.collapsed:after {
		font-family: 'FontAwesome';
		font-size: 15px;
		width: 36px;
		line-height: 48px;
		text-align: center;
		background: #F1F1F1;
		float: left;
		margin-left: -31px;
		margin-top: -12px;
		margin-right: 15px
	}

	.accordion_one .panel .panel-heading a:after {
		content: "\2212"
	}

	.accordion_one .panel .panel-heading a:after,
	.accordion_one .panel .panel-heading a.collapsed:after {
		font-family: 'FontAwesome';
		font-size: 15px;
		width: 36px;
		height: 48px;
		line-height: 48px;
		text-align: center;
		background: #F1F1F1;
		float: left;
		margin-left: -31px;
		margin-top: -12px;
		margin-right: 15px
	}
</style>
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<?php include __DIR__ . '/parts/6_foot.php' ?>