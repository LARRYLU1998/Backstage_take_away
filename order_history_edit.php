<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '編輯訂單狀態';
$pageName = 'order_history';

$orderId = isset($_GET["order_id"]) ? intval($_GET["order_id"]) : 0;


if (empty($orderId)) {
  header('Location: order_history.php');
  exit;
}
//有拿到資料

$r = $pdo->query("SELECT * FROM order_history WHERE order_id=$orderId")->fetch();
$sql = "SELECT * FROM order_history WHERE order_id = ?";


if (empty($r)) {
  header('Location: order_history.php');
  exit;
}
$select = $r['status'];
?>

<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<style>
  .input-style {
    background-color: #dee2e6;
    cursor: not-allowed;
  }
</style>



<section class="container mt-auto">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body container">
          <form name="form1" onsubmit="sendData(event)" class="mb-1" method="POST">
            <div class="row me-0">
              <h2 class="card-title col-md-10 mb-3 fw-bold">編輯訂單狀態</h2>
              <input class="col-md-2 btn btn-dark disabled " name="order_id" id="orderId" value="<?= $r['order_id'] ?>" readonly>
            </div>
            <div class="row">
              <div class="col-12 d-flex justify-content-between">
                <div class="col-5">
                  <label for="userId" class="form-label">會員編號</label>
                  <input type="text" class="form-control input-style mb-3" id="userId" name="user_id" value="<?= $r['user_id'] ?>" readonly>
                  <label for="orderDetailId" class="form-label">訂單詳情編號</label>
                  <input type="text" class="form-control input-style mb-3" id="orderDetailId" name="order_detail_id" value="<?= $r['order_detail_id'] ?>" readonly>
                  <label for="recipientName" class="form-label">收件人</label>
                  <input type="text" class="form-control input-style mb-3" id="recipientName" name="recipient_name" value="<?= $r['recipient_name'] ?>" readonly>
                  <label for="recipientPhone" class="form-label">收件人電話</label>
                  <input type="text" class="form-control input-style mb-3" id="recipientPhone" name="recipient_phone" value="<?= $r['recipient_phone'] ?>" readonly>
                  <label for="orderDate" class="form-label">訂單日期</label>
                  <input type="text" class="form-control input-style mb-3" id="orderDate" name="order_date" value="<?= $r['order_date'] ?>" readonly>
                  <label for="orderRemark" class="form-label">備註</label>
                  <input type="text" class="form-control input-style mb-3" id="orderRemark" name="order_remark" value="<?= $r['order_remark'] ?>" readonly>
                </div>
                <div class="col-6">
                  <label for="deliveryMethod" class="form-label">寄送方式</label>
                  <input type="text" class="form-control input-style mb-3" id="deliveryMethod" name="delivery_method" value="<?= $r['delivery_method'] ?>" readonly>
                  <label for="paymentMethod" class="form-label">付款方式</label>
                  <input type="text" class="form-control input-style mb-3" id="paymentMethod" name="payment_method" value="<?= $r['payment_method'] ?>" readonly>
                  <label for="recipientAddressDetail" class="form-label">寄送地址</label>
                  <input type="text" class="form-control input-style mb-3" id="recipientAddressDetail" name="recipient_address_detail" value="<?= $r['recipient_address_detail'] ?>" readonly>
                  <label for="status" class="form-label">訂單狀態</label>
                  <select class="form-select mb-3" aria-label="Default select example" name="status" id="status" value="<?= $r['status'] ?>">
                    <option value="未出貨" <?php if (!empty($select) && $select == '未出貨')  echo 'selected = "selected"'; ?>>未出貨</option>
                    <option value="已出貨" <?php if (!empty($select) && $select == '已出貨')  echo 'selected = "selected"'; ?>>已出貨</option>
                    <option value="運送中" <?php if (!empty($select) && $select == '運送中')  echo 'selected = "selected"'; ?>>運送中</option>
                    <option value="已送達" <?php if (!empty($select) && $select == '已送達')  echo 'selected = "selected"'; ?>>已送達</option>
                    <option value="訂單取消" <?php if (!empty($select) && $select == '訂單取消')  echo 'selected = "selected"'; ?>>訂單取消</option>
                  </select>
                  <label for="InvoiceNo" class="form-label">電子條碼</label>
                  <input type="text" class="form-control input-style mb-5" id="InvoiceNo" name="Invoice_no" value="<?= $r['Invoice_no'] ?>" readonly>
                  <button type="submit" class="btn btn-success col-md-12">修改結果類型</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- 3.Modal(互動視窗)資料新增成功 -->
  <!-- https://getbootstrap.com/docs/5.3/components/modal/ -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">資料修改結果</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- https://getbootstrap.com/docs/5.3/components/alerts/ -->
          <div class="alert alert-success" role="alert">
            資料修改成功
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續修改</button>
            <a href="order_history.php" class="btn btn-primary">跳到列表頁</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal 資料新增失敗 -->
  <div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">資料沒有修改</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger" role="alert">
            資料修改沒有成功
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續修改</button>
          <a href="order_history.php" class="btn btn-primary">跳到列表頁</a>
        </div>
      </div>
    </div>
  </div>

</section>





<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>

<script>
  let orderId = document.getElementById('orderId');



  function sendData(e) {

    e.preventDefault(); //不要讓表單以傳統的方式送出
    //建立檢查設定
    let isPass = true; //是否通過檢查 預設值為true

    //TODO:檢查資料的格式(前後端都要檢查)

    //欄位都有通過檢查 發AJAX取得值
    if (isPass) {
      const fd = new FormData(document.form1); //FormData看成沒有外觀的表單 主要功能是透過ajax傳送給後端

      fetch('order_history_edit-api.php', {
          method: 'POST',
          body: fd
        })
        .then(r => r.json())
        .then(result => {
          console.log(result);
          if (result.success) {
            successModal.show();
          } else {
            if (result.error) {
              failureInfo.innerHTML = result.error;
            } else {
              failureInfo.innerHTML = '資料新增沒有成功';
            }
            failureModal.show();
          }
        })
        .catch(ex => {
          console.log(ex);
          //alert('資料發生錯誤'+ex)
          failureInfo.innerHTML = '資料新增發生錯誤' + ex;
          failureModal.show();
        })
    }

  }
  const successModal = new bootstrap.Modal('#successModal');
  const failureModal = new bootstrap.Modal('#failureModal');
  const failureInfo = document.querySelector('#failureModal .alert-danger');
</script>

<?php include __DIR__ . '/parts/6_foot.php' ?>