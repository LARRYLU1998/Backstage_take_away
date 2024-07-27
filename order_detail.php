<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '訂單詳情';
$pageName = 'order_detail';

$orderDetailId = isset($_GET["order_detail_id"]) ? intval($_GET["order_detail_id"]) : 0;


$sql = "SELECT od.*, c.name
        FROM order_detail od
        JOIN commodity c ON od.commodity_id = c.commodity_id
        WHERE od.order_detail_id = ?";

// 準備 SQL 查詢
$r = $pdo->prepare($sql);

// 執行 SQL 查詢
$r->execute([$orderDetailId]);

// 檢查是否有結果
$row = $r->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    // 如果沒有結果，可能是因為未找到符合條件的訂單詳細資料
    echo "No order detail found for order detail ID: $orderDetailId";
} else {
    // 在這之後可以使用 $row 來取得查詢結果的資料
    var_dump($row);
}

?>

<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<section class="container mt-auto">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body container">
                    <form name="form1" onsubmit="sendData(event)" class="mb-1" method="POST">
                        <div class="row me-0">
                            <h2 class="card-title col-md-10 mb-3 fw-bold">訂單詳情</h2>
                            <input class="col-md-2 btn btn-dark disabled " name="order_detail_id" id="orderDetailId" value="<?= $row['order_detail_id'] ?>" readonly>
                        </div>
                        <div>
                            <label for="commodityId" class="form-label">商品編號</label>
                            <input type="text" class="form-control input-style mb-3" id="commodityId" name="commodity_id" value="<?= $row['commodity_id'] ?>" readonly>
                            <label for="commodityName" class="form-label">商品名稱</label>
                            <input type="text" class="form-control input-style mb-3" id="commodityName" name="name" value="<?= $row['name'] ?>" readonly>

                            <label for="amount" class="form-label">購買數量</label>
                            <input type="text" class="form-control input-style mb-3" id="amount" name="amount" value="<?= $row['amount'] ?>" readonly>
                            <label for="unitPrice" class="form-label">單價</label>
                            <input type="text" class="form-control input-style mb-3" id="unitPrice" name="unit_price" value="<?= $row['unit_price'] ?>" readonly>
                            <label for="totailPrice" class="form-label">總額</label>
                            <input type="text" class="form-control input-style mb-3" id="totailPrice" name="totail_price" value="<?= $row['totail_price'] ?>" readonly>
                        </div>
                        <a href="order_history.php" class="btn btn-success col-12">回上一頁</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
