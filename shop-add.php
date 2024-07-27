<?php
require __DIR__ . '/parts/pdo-connect.php';  #獲取資料庫連線資料

$title = '新增產品';
?>
<!-- 123 -->
<!-- 所有頁面的拼接順序 每一頁都主要是換掉section的部分 -->
<?php include __DIR__ . '/parts/1_head.php' ?>
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
<?php include __DIR__ . '/parts/2_nav.php' ?>
<?php include __DIR__ . '/parts/3_side_nav.php' ?>
<section>
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">新增商品</h3>
                </div>
                <div class="card-body">
                    <form name="form1" onsubmit="sendData(event)" enctype="multipart/form-data">
                        <div class="form-floating mb-4">
                            <input class="form-control" id="name" type="text" name="name" placeholder="name" />
                            <div class="form-text"></div>
                            <label for="name">產品名稱</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input class="form-control" id="brand_name" type="text" name="brand_name" placeholder="brand_name" />
                            <div class="form-text"></div>
                            <label for="brand_name">品牌名稱</label>
                        </div>
                        <div class="form-floating ">
                            <input class="form-control" id="price" type="text" name="price" placeholder="price" />
                            <div class="form-text"></div>
                            <label for="price">產品價格</label>
                        </div>

                        <label for="type">產品種類</label>
                        <select class="form-select form-select-sm me-lg-4" aria-label="Small select example" id="type" name="type">
                            <option selected value="產品種類">請選擇產品種類</option>
                            <option value="寵物飼料">寵物飼料</option>
                            <option value="寵物罐頭">寵物罐頭</option>
                            <option value="寵物零食">寵物零食</option>
                            <option value="寵物用品">寵物用品</option>
                            <option value="保健食品">保健食品</option>
                        </select>
                        <div class="form-text"></div>
                        <label for="species">適用物種</label>
                        <select class="form-select form-select-sm" aria-label="Small select example" id="species" name="species">
                            <option selected value="適用物種">請選擇適用物種</option>
                            <option value="狗寶貝">狗寶貝</option>
                            <option value="貓寶貝">貓寶貝</option>
                        </select>
                        <div class="form-text"></div>


                        <div class="mb-3  mt-3">
                            <label for="pic" class="form-label">產品圖片</label>
                            <input class="form-control" type="file" id="previewImage" name="avatar" accept="image/jpeg,image/png" />
                            <br />
                            <img id="show_image" src="" />
                        </div>
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">商品狀態</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        商品新增成功
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                    <a href="shop.php" class="btn btn-primary">前往產品列表</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">新增狀況</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        商品新增失敗
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">繼續新增</button>
                    <a href="shop.php" class="btn btn-primary">前往產品列表</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/parts/4_footer.php' ?>
<?php include __DIR__ . '/parts/5_script.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    const {
        name: nameEl,
        brand_name: brand_nameEl,
        price: priceEl,
    } = document.form1;

    let typeEl = document.getElementById("type");
    let speciesEl = document.getElementById("species");

    function sendData(e) {

        nameEl.style.border = "1px solid #CCC"
        nameEl.nextElementSibling.innerHTML = '';

        brand_nameEl.style.border = "1px solid #CCC"
        brand_nameEl.nextElementSibling.innerHTML = '';

        priceEl.style.border = "1px solid #CCC"
        priceEl.nextElementSibling.innerHTML = '';

        typeEl.style.border = "1px solid #CCC"
        typeEl.nextElementSibling.innerHTML = '';

        speciesEl.style.border = "1px solid #CCC"
        speciesEl.nextElementSibling.innerHTML = '';

        e.preventDefault();

        let isPass = true;

        if (nameEl.value.length < 2) {
            isPass = false;
            nameEl.style.border = "2px solid red"
            nameEl.nextElementSibling.innerHTML = '請輸入產品名稱';
        }
        if (brand_nameEl.value.length < 2) {
            isPass = false;
            brand_nameEl.style.border = "2px solid red"
            brand_nameEl.nextElementSibling.innerHTML = '請輸入品牌名稱';
        }
        if (priceEl.value.length < 2) {
            isPass = false;
            priceEl.style.border = "2px solid red"
            priceEl.nextElementSibling.innerHTML = '請輸入產品價格';
        }


        if (typeEl.value === "產品種類") {
            isPass = false;
            typeEl.style.border = "2px solid red"
            typeEl.nextElementSibling.innerHTML = '請選擇選項';
        }
        if (speciesEl.value === "適用物種") {
            isPass = false;
            speciesEl.style.border = "2px solid red"
            speciesEl.nextElementSibling.innerHTML = '請選擇選項';
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('shop-add-api.php', {
                    method: 'POST',
                    body: fd,
                })
                .then(r => r.json())
                .then(result => {
                    console.log(result);
                    if (result.success) {
                        successModal.show();
                    } else {
                        if (result.error) {
                            failureInfo.innerHTML = result.error
                        } else {
                            failureInfo.innerHTML = '產品新增失敗'
                        }
                        failureModal.show();
                    }
                })
                .catch(ex => {
                    console.log(ex);
                    failureInfo.innerHTML = '產品新增錯誤' + ex;
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
                    .css("width", "50%");
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