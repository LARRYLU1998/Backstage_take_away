<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '編輯會員列表';
$pageName = 'user list edit';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
if (empty($user_id)) {
  header('Location: user.php');
  exit;
}

$r = $pdo->query("SELECT * FROM user WHERE user_id = $user_id")->fetch();
if (empty($r)) {
  header('Location: user.php');
  exit;
}


?>
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
<style>
  .form-text {
    color: red;
  }

  /* header 側nav */
  :root {
    --bs-dark-rgb: 83, 46, 28;
  }

  .sb-sidenav-dark {
    background-color: #8E806A;
  }

  .sb-sidenav-dark .sb-sidenav-footer {
    background-color: #8E806A;
  }

  /* 編輯表單 */

  .card-header {
    background-color: #D7C0AE;
  }

  .card-footer {
    background-color: #D7C0AE;
  }

  .modal-header {
    background-color: #967E76;
    color: white;
  }

  /* .form-control {
        border: 1px solid #b99549;
    } */
  /* .form-select {
        border: 1px solid #b99549;
    } */

  /* option{
        border: 1px solid #b99549;
        margin: 10% auto;
    } */
  .btn-primary {
    --bs-btn-bg: #D7C0AE;
    --bs-btn-border-color: #b99549;
    --bs-btn-hover-bg: #a16a38;
  }

  .row {
    --bs-gutter-x: 0rem;
  }
</style>
<section>
  <div class="row mt-2 mb-5 justify-content-center">
    <div class="col-lg-5">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
          <h4 class="text-center font-weight-light my-4">編輯會員資料</h4>
        </div>
        <div class="card-body">
          <form name="form1" onsubmit="sendData(event)">
            <input type="hidden" class="form-control" name="user_id" value="<?= $r['user_id'] ?>">
            <div class="mb-3">
              <label for="user_id" class="form-label">會員編號</label>
              <input type="text" class="form-control" id="user_id" name="user_id" value="<?= $r['user_id'] ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">姓名</label>
              <input type="text" class="form-control" id="name" name="name" value="<?= $r['name'] ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">手機</label>
              <input type="text" class="form-control" id="phone" name="phone" value="<?= $r['phone'] ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">電子郵件</label>
              <input type="text" class="form-control" id="email" name="email" value="<?= $r['email'] ?>">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="address_detail" class="form-label">地址</label>
              <textarea class="form-control" name="address_detail" id="address_detail" cols="30" rows="3"><?= $r['address_detail'] ?></textarea>
            </div>
            <!-- <label for="species">目前產品圖</label>
            <input class="form-control" type="text" name="pic" value="<?= $r['pic'] ?>" readonly /> -->
            <button type="submit" class="btn btn-primary mt-3">確認修改</button>
          </form>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    const {
      name: nameField,
      email: emailField,
    } = document.form1;

    function validateEmail(email) {
      const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    // function validateAccount(account) {
    //   const pattern = /^09\d{2}-?\d{3}-?\d{3}$/;
    //   return pattern.test(account);
    // }


    function sendData(e) {
      // 欄位的外觀要回復原來的狀態
      nameField.style.border = "1px solid #CCC";
      nameField.nextElementSibling.innerHTML = '';
      emailField.style.border = "1px solid #CCC";
      emailField.nextElementSibling.innerHTML = '';
      // accountField.style.border = "1px solid #CCC";
      // accountField.nextElementSibling.innerHTML = '';

      e.preventDefault();
      let isPass = true;

      // 檢查資料的格式
      // 姓名是必填, 長度要 2 以上
      if (nameField.value.length < 2) {
        isPass = false;
        nameField.style.border = "2px solid red";
        nameField.nextElementSibling.innerHTML = '請輸入正確的名字';
      }
      // email 若有填才檢查格式, 沒填不檢查格式
      if (emailField.value && !validateEmail(emailField.value)) {
        isPass = false;
        emailField.style.border = "2px solid red";
        emailField.nextElementSibling.innerHTML = '請輸入正確的 Email';
      }
      // mobile 若有填才檢查格式, 沒填不檢查格式
      // if (accountField.value && !validateAccount(accountField.value)) {
      //   isPass = false;
      //   accountField.style.border = "2px solid red";
      //   accountField.nextElementSibling.innerHTML = '請輸入正確的手機號碼';
      // }
      // 如果欄位都有通過檢查, 才要發 AJAX
      if (isPass) {
        const fd = new FormData(document.form1); // 看成沒有外觀的表單

        fetch('user-edit-api.php', {
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
            failureInfo.innerHTML = '資料修改發生錯誤' + ex;
            failureModal.show();
          })
      }
    }

    var imageProc = function(input) {
      if (input.files && input.files[0]) {
        // 建立一個 FileReader 物件
        var reader = new FileReader();
        // 當檔案讀取完後，所要進行的動作
        reader.onload = function(e) {
          // 顯示圖片
          $("#show_image")
            .attr("src", e.target.result)
            .css("height", "100px")
            .css("width", "100px");
          $("#pic").css("display", "none");
        };
        reader.readAsDataURL(input.files[0]);
      }
    };

    $(document).ready(function() {
      // 綁定事件
      $("#previewImage").change(function() {
        imageProc(this);
      });
    });

    const successModal = new bootstrap.Modal('#successModal');
    const failureModal = new bootstrap.Modal('#failureModal');
    const failureInfo = document.querySelector('#failureModal .alert-danger');
  </script>
  <?php include __DIR__ . '/parts/6_foot.php' ?>