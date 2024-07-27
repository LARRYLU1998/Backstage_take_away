<?php
require __DIR__ . '/parts/pdo-connect.php';
$title = '註冊';
$pageName = 'register';

if (isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

?>
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>

<div class="container">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">註冊</h5>
                    <form name="form1" onsubmit="sendData(event)">
                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="form-text"></div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="account" class="form-label">電話</label>
                            <input type="text" class="form-control" id="account" name="account">
                            <div class="form-text"></div>
                        </div> -->
                        <div class="mb-3">
                            <label for="email" class="form-label">電子信箱</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">確認密碼</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address_detail" class="form-label">通訊地址</label>
                            <input type="text" class="form-control" id="address_detail" name="address_detail">
                            <div class="form-text"></div>
                        </div>
                        <div class="text-center mb-3">已有帳號？&nbsp<a href="login.php" class="goLogin">登入</a></div>
                        <button type="submit" class="mx-auto d-block col-3 btn btn-primary">註冊</butto>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">資料新增結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    註冊成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                <a href="login.php" class="btn btn-primary">前往登入頁面</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">資料沒有新增</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    註冊沒有成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                <a href="login.php" class="btn btn-primary">前往登入頁面</a>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
    const {
        name: nameField,
        content: contentField,
    } = document.form1;



    function sendData(e) {

        e.preventDefault(); // 不要讓有外觀的表單以傳統的方式送出

        $isPass = true;


        if ($isPass) {
            const fd = new FormData(document.form1); // 看成沒有外觀的表單
            fetch('register-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        // alert('資料新增成功')
                        successModal.show();
                    } else {
                        // alert('資料新增失敗')
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
                    // alert('資料新增發生錯誤' + ex)
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