<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = '編輯線上認養';
$pageName = 'adoptEdit';

$adopt_id = isset($_GET['adopt_id']) ? intval($_GET['adopt_id']) : 0;


$r = $pdo->query("SELECT * FROM online_virtual_adoption_form WHERE adopt_id= $adopt_id")->fetch();

$method = $r['donation_method'];
$payment = $r['payment'];
$donation = $r['donation'];
$address = $r['donate_address'];
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
  <div class="row d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="card my-5 border border-3 border-secondary">

        <div class="card-body">
          <h3 class="card-title text-center fw-bold mb-3">線上認養</h3>

          <form name="form1" onsubmit="sendData(event)" class="vstack">

            <input type="hidden" name="adopt_id" value="<?= $r['adopt_id'] ?>">
            <div class="mb-3">
              <label for="name" class="form-label text-center fw-bold">#</label>
              <input type="text" class="form-control text-center fw-bold" value="<?= $r['adopt_id'] ?>" disabled>
            </div>

            <div class="mb-3">
              <label for="user_id" class="form-label">預約人</label>
              <input type="text" class="form-control text-center fw-bold" id="user_id" name="user_id" value="<?= Name($r['user_id'])  ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="pet_id" class="form-label text-center fw-bold">預約寵物</label>
              <select class="form-select text-center fw-bold" id="pet_id" name="pet_id">
                <option value="">請選擇寵物</option>
                <option value="10001" <?= $r['pet_id'] == '10001' ? 'selected' : '' ?>>露露</option>
                <option value="10002" <?= $r['pet_id'] == '10002' ? 'selected' : '' ?>>馬克斯</option>
                <option value="10003" <?= $r['pet_id'] == '10003' ? 'selected' : '' ?>>寶貝</option>
                <option value="10004" <?= $r['pet_id'] == '10004' ? 'selected' : '' ?>>花花</option>
                <option value="10008" <?= $r['pet_id'] == '10008' ? 'selected' : '' ?>>小雪</option>
                <option value="10009" <?= $r['pet_id'] == '10009' ? 'selected' : '' ?>>皮皮</option>
                <option value="10011" <?= $r['pet_id'] == '10011' ? 'selected' : '' ?>>罐頭</option>
                <option value="10012" <?= $r['pet_id'] == '10012' ? 'selected' : '' ?>>嘟嘟</option>
              </select>
              <div class="form-text"></div>
            </div>

            <div class="d-flex flex-column">
              <label for="donation_method">捐款方式</label>
              <select class="py-2 text-center fw-bold" name="donation_method" id="donation_method" style="border-radius: 5px; margin: 10px 0px ">
                <option value="單次捐贈" <?= $r['donation_method'] == '單次捐贈' ? 'selected' : '' ?>>單次捐贈</option>
                <option value="定期扣款" <?= $r['donation_method'] == '定期扣款' ? 'selected' : '' ?>>定期扣款</option>
              </select>
              <div class="form-text"></div>
            </div>

            <div class="mb-3">
              <label for="amount" class="form-label">捐款金額</label>
              <input type="text" class="form-control text-center fw-bold my-1" id="amount" name="amount" value="<?= $r['amount'] ?>">
              <div class="form-text"></div>
            </div>
            <div class="d-flex flex-column">
              <label for="payment">付款方式</label>
              <select class="py-2 text-center fw-bold" name="payment" id="payment" style="border-radius: 5px; margin: 13px 0px ">
                <option value="銀行轉帳" <?= $r['payment'] == '銀行轉帳' ? 'selected' : '' ?>>銀行轉帳</option>
                <option value="超商繳費" <?= $r['payment'] == '超商繳費' ? 'selected' : '' ?>>超商繳費</option>
              </select>
              <div class="form-text"></div>
            </div>
            <div class="d-flex flex-column">
              <label for="donation">捐款用途</label>
              <select class="py-2 text-center fw-bold" name="donation" id="donation" style="border-radius: 5px; margin: 15px 0px ">
                <option value="不指定" <?= $r['donation'] == '不指定' ? 'selected' : '' ?>>不指定</option>
                <option value="需要緊急" <?= $r['donation'] == '需要緊急' ? 'selected' : '' ?>>需要緊急</option>
                <option value="絕孕計畫" <?= $r['donation'] == '絕孕計畫' ? 'selected' : '' ?>>絕孕計畫</option>
              </select>
              <div class="form-text"></div>
            </div>

            <div class="d-flex flex-column">
              <label for="donate_address">捐贈證明寄送</label>
              <select class="py-2 text-center fw-bold" name="donate_address" id="donate_address" style="border-radius: 5px; margin: 15px 0px ">
                <option value="地址" <?= $r['donate_address'] == '地址' ? 'selected' : '' ?>>地址</option>
                <option value="信箱" <?= $r['donate_address'] == '信箱' ? 'selected' : '' ?>>信箱</option>
              </select>
              <div class="form-text"></div>
            </div>
            <button type="submit" class="btn btn-secondary">修改</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">資料修改結果</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          資料修改成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續修改</button>
        <a href="javascript: location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">資料沒有修改</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          資料沒有修改成功
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續修改</button>
        <a href="javascript: location.href=document.referrer" class="btn btn-primary">跳到列表頁</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
  const {
    pet_id: petField,
    user_id: userField,
    amount: amountField,
  } = document.form1;


  function sendData(e) {
    e.preventDefault(); // 不要讓有外觀的表單以傳統的方式送出

    let isPass = true; // 有沒有通過檢查, 預設值為 true
    if (userField.value.length < 2) {
      isPass = false;
      userField.style.border = "2px solid red";
      userField.nextElementSibling.innerHTML = '請輸入正確的姓名';
    }

    if (petField.value === "") {
      isPass = false;
      petField.style.border = "2px solid red";
      petField.nextElementSibling.innerHTML = '請選擇想領養的寵物';
    } else if (petField.value.length < 2) {
      isPass = false;
      petField.style.border = "2px solid red";
      petField.nextElementSibling.innerHTML = '請選擇想領養的寵物';
    } else {
      petField.style.border = "";
      petField.nextElementSibling.innerHTML = '';
    }

    if (amountField.value.length < 2 || isNaN(amountField.value)) {
      isPass = false;
      amountField.style.border = "2px solid red";
      amountField.placeholder = "請填寫捐款金額 (必須是數字)";
      amountField.value = "";
    } else if (parseFloat(amountField.value) > 10000) {
      isPass = false;
      amountField.placeholder = "金額過大,請聯繫動物之家人員";
      amountField.style.border = "2px solid red";
      amountField.value = "";
    } else {
      amountField.style.border = "";
    }
    const userMap = {
      'dana': '10001',
      '白賢祐': '10002',
      '洪海仁': '10003',
      '洪秀哲': '10004',
      '千多慧': '10005',
      '洪凡資': '10006',
      '全峰藹': '10007',
      '白斗關': '10008',
      '尹殷盛': '10009',
      '羅彩妍': '10010',
      '金陽基': '10011',
    }
    const mappedUserId = userMap[userField.value.trim()];

    // 如果欄位都有通過檢查, 才要發 AJAX
    if (mappedUserId) {
      const fd = new FormData(document.form1); // 看成沒有外觀的表單

      fd.set('user_id', mappedUserId);

      fetch('adoptEdit-api.php', {
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
              failureInfo.innerHTML = '資料沒有修改成功';
            }
            failureModal.show();
          }
        })
        .catch(ex => {
          console.log(ex);
          // alert('資料新增發生錯誤' + ex)
          failureInfo.innerHTML = '資料修改發生錯誤';
          failureModal.show();
        })
    }else {
            isPass = false;
            userField.style.border = "2px solid red";
            userField.placeholder = '此姓名未註冊,請先註冊';
            userField.value = '';
        }

        // Prevent form submission if validation fails
        if (!isPass) {
            return false;
        }
  }


  const successModal = new bootstrap.Modal('#successModal');
  const failureModal = new bootstrap.Modal('#failureModal');
  const failureInfo = document.querySelector('#failureModal .alert-danger');
</script>
<?php include __DIR__ . '/parts/6_foot.php' ?>