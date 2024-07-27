<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/pdo-connect.php';
$title = '新增預約';
$pageName = 'reserve';

?>
<?php include __DIR__ . '/parts/1_head.php' ?>
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
<div class="container">
    <div class="row d-flex justify-content-center my-a">
        <div class="col-6">
            <div class="card my-5 border border-3 border-secondary">
                <div class="card-body ">
                    <h3 class="card-title text-center fw-bold mb-3">線上預約</h3>
                    <form name="form1" onsubmit="sendData(event)" class="vstack">
                        <div class="mb-3">
                            <label for="user_id" class="form-label  fw-bold">預約人</label>
                            <input type="text" class="form-control text-center fw-bold" id="user_id" name="user_id" value="<?= $_SESSION['user']['name'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="pet_id" class="form-label text-center fw-bold">寵物</label>
                            <input type="text" class="form-control text-center fw-bold" id="pet_id" name="pet_id">
                            <div class="form-text"></div>
                        </div> -->
                        <div class="mb-3">
                            <label for="pet_id" class="form-label text-center fw-bold">寵物</label>
                            <select class="form-select text-center fw-bold" id="pet_id" name="pet_id">
                                <option selected>請選擇寵物</option>
                                <option value="10001">露露</option>
                                <option value="10002">馬克斯</option>
                                <option value="10003">寶貝</option>
                                <option value="10004">花花</option>
                                <option value="10008">小雪</option>
                                <option value="10009">皮皮</option>
                                <option value="10011">罐頭</option>
                                <option value="10012">嘟嘟</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label text-center fw-bold ">預約時間</label>
                            <input type="datetime-local" class="form-control my-2 text-center fw-bold" id="time" name="time">
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-secondary">確定送出</button>
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
                <h1 class="modal-title fs-5">資料新增結果</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    資料新增成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                <a href="reserveList.php" class="btn btn-primary">跳到列表頁</a>
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
                    資料新增沒有成功
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                <a href="reserveList.php" class="btn btn-primary">跳到列表頁</a>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script>
    const {
        user_id: nameField,
        pet_id: petField,
    } = document.form1;

    function sendData(e) {
        e.preventDefault(); // 不要讓有外觀的表單以傳統的方式送出
        // 欄位的外觀要回復原來的狀態
        nameField.style.border = "1px solid #CCC";
        nameField.nextElementSibling.innerHTML = '';
        petField.style.border = "1px solid #CCC";
        petField.nextElementSibling.innerHTML = '';

        let isPass = true; // 有沒有通過檢查, 預設值為 true


        // const petMap = {
        //     '露露': '10001',
        //     '馬克斯': '10002',
        //     '寶貝': '10003',
        //     '花花': '10004',
        //     '小雪': '10008',
        //     '皮皮': '10009',
        //     '罐頭': '10011',
        //     '嘟嘟': '10012',
        // };

        // if (petMap[petField.value]) {
        //     petField.value = petMap[petField.value];
        // }
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
            };

        // 如果欄位都有通過檢查, 才要發 AJAX
        if (userMap[nameField.value]) {
            const fd = new FormData(document.form1); // 看成沒有外觀的表單


            // if (userMap[nameField.value]) {
            //     fd.set('user_id', userMap[nameField.value]);
            // } else {
            //     isPass = false;
            //     nameField.style.border = "2px solid red";
            //     nameField.nextElementSibling.innerHTML = '此姓名未註冊,請先註冊';
            // }
            fd.set('user_id', userMap[nameField.value]);

            fetch('reserve-api.php', {
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
                    failureInfo.innerHTML = '資料新增發生錯誤';
                    failureModal.show();
                })
        }else {
            isPass = false;
            nameField.style.border = "2px solid red";
            nameField.placeholder = '此姓名未註冊,請先註冊';
            nameField.value = '';
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