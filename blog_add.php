<?php

require __DIR__ . '/parts/pdo-connect.php';

$title = '新增';
$pageName = 'add';
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
          <h5 class="text-center font-weight-light my-4">編輯</h5>
        </div>
        <div class="card-body">
          <form name="form1" onsubmit="sendData(event)">
            <div class="mb-3">
              <label for="pet_id" class="form-label">pet_id</label>
              <input type="text" class="form-control" id="pet_id" name="pet_id">
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">content</label>
              <textarea class="form-control" name="content" id="content" cols="30" rows="3"></textarea>
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <input type="file" id="previewImage" name="avatar" accept="image/jpeg,image/png" style="margin-bottom: 1rem;" />
              <br />
              <img id="show_image" src="" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  </ㄋ>
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
          <a href="blog.php" class="btn btn-primary">跳到列表頁</a>
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
          <a href="blog.php" class="btn btn-primary">跳到列表頁</a>
        </div>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/parts/4_footer.php' ?>
  <?php include __DIR__ . '/parts/5_script.php' ?>
  <script>
    const {
      pet_id: pet_idField,
      content: contentField,
    } = document.form1;



    function sendData(e) {

      pet_idField.style.border = "1px solid #CCC";
      pet_idField.nextElementSibling.innerHTML = '';
      contentField.style.border = "1px solid #CCC";
      contentField.nextElementSibling.innerHTML = '';

      e.preventDefault(); // 不要讓有外觀的表單以傳統的方式送出

      $isPass = true;


      if (contentField.value.length < 1) {
        $isPass = false;
        contentField.style.border = "2px solid red";
        contentField.nextElementSibling.innerHTML = '請輸入正確的內容';
      }
      if ($isPass) {
        const fd = new FormData(document.form1); // 看成沒有外觀的表單
        fetch('blog_add_api.php', {
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