<!-- login+register -->
<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = '登入';
$pageName = 'login';

if (isset($_SESSION['admin'])) {
  header('Location: index_.php');
  exit;
}

?>
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<div id="signIn">
  <div class="row justify-content-center">
    <div class="col-6 col-lg-5 mx-auto my-auto">
      <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-body">
          <h5 class="text-center font-weight-light my-4">登入</h5>
          <form name="form1" onsubmit="sendData(event)">
            <div class="mb-3">
              <label for="email" class="form-label">電郵</label>
              <input type="text" class="form-control" id="email" name="email">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">密碼</label>
              <input type="password" class="form-control" id="password" name="password">
              <div class="form-text"></div>
            </div>
            <div class="text-center">還沒有帳號？&nbsp<a href="register.php" class="goRegister">註冊</a></div>
            <button type="submit" class="mx-auto d-block col-3 btn btn-primary">登入</button>

          </form>
          <!-- <div class="text-center mt-3">
            <button type="button" class="col-3 btn btn-secondary" onclick="show_hide()">註冊帳號</button>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">登入失敗</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          帳號或密碼錯誤
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續登入</button>
      </div>
    </div>
  </div>
</div>


  <?php include __DIR__ . '/parts/5_script.php' ?>
  <script>
    const {
      email: emailField,
      password: passwordField
    } = document.form1;

    function validateEmail(email) {
      const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }


    function sendData(e) {
      // 欄位的外觀要回復原來的狀態
      emailField.style.border = "1px solid #CCC";
      emailField.nextElementSibling.innerHTML = '';
      e.preventDefault(); // 不要讓有外觀的表單以傳統的方式送出
      let isPass = true; // 有沒有通過檢查, 預設值為 true

      // TODO: 檢查資料的格式

      // email 若有填才檢查格式, 沒填不檢查格式
      if (emailField.value && !validateEmail(emailField.value)) {
        isPass = false;
        emailField.style.border = "2px solid red";
        emailField.nextElementSibling.innerHTML = '請輸入正確的 Email';
      }

      // 如果欄位都有通過檢查, 才要發 AJAX
      if (isPass) {
        const fd = new FormData(document.form1);
        fetch('login-api.php', {
            method: 'POST',
            body: fd
          })
          .then(r => r.json())
          .then(result => {
            console.log(result);
            if (result.success) {
              location.href = 'index_.php';
            } else {
              failureModal.show();
            }
          })
          .catch(ex => {
            console.log(ex);
          })
      }

      // 如果欄位都有通過檢查, 才要發 AJAX
      if (isPass) {
        const fd = new FormData(document.form2);
        fetch('login-api.php', {
            method: 'POST',
            body: fd
          })
          .then(r => r.json())
          .then(result => {
            console.log(result);
            if (result.success) {
              location.href = 'index_.php';
            } else {
              failureModal.show();
            }
          })
          .catch(ex => {
            console.log(ex);
          })
      }

    }
    const failureModal = new bootstrap.Modal('#failureModal');

  
  </script>

  <?php include __DIR__ . '/parts/6_foot.php' ?>