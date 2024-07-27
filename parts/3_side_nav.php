<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <!-- <a class="nav-link collapsed" href="#" aria-expanded="false" aria-controls="collapsePagesUser"> -->
          <div class="sb-sidenav-menu-heading">會員專區</div>
          <!-- 會員下拉式選單 -->
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePagesUser" aria-expanded="false" aria-controls="collapsePagesUser" onclick="toggleCollapse('collapsePagesUser')">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-user"></i>
            </div>
            會員專區
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div class="collapse" id="collapsePagesUser" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="collapsePagesUser">
              <a class="nav-link collapsed" href="login.php">
                登入/註冊
              </a>
              <a class="nav-link collapsed" href="user.php">
                會員專區
              </a>
              <a class="nav-link collapsed" href="user-add.php">
                新增會員資料
              </a>
              <a class="nav-link collapsed" href="adoptList.php">
                線上認養紀錄
              </a>
              <a class="nav-link collapsed" href="reserveList.php">
                預約紀錄
              </a>
              <a class="nav-link collapsed" href="logout.php">
                登出
              </a>
            </nav>
          </div>

          <!-- 下拉式選單 -->
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePagesAnimal" aria-expanded="false" aria-controls="collapsePagesAnimal" onclick="toggleCollapse('collapsePagesAnimal')">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-paw"></i>
            </div>
            收容動物
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div class="collapse" id="collapsePagesAnimal" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="collapseContentAnimal">
              <a class="nav-link collapsed" href="pet_list.php">
                基本資訊
              </a>
              <a class="nav-link collapsed" href="pet_add.php">
                新增寵物資料
              </a>
              <a class="nav-link collapsed" href="blog.php">
                寵物貼文
              </a>
              <a class="nav-link collapsed" href="blog_add.php">
                新增寵物貼文
              </a>
              <a class="nav-link collapsed" href="adopt.php">
                線上認養
              </a>
              <a class="nav-link collapsed" href="reserve.php">
                線上預約
              </a>
            </nav>
          </div>
          <div class="sb-sidenav-menu-heading">商城專區</div>
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePagesShop" aria-expanded="false" aria-controls="collapsePagesShop" onclick="toggleCollapse('collapsePagesShop')">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-store"></i>
            </div>
            產品資料
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div class="collapse" id="collapsePagesShop" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="collapseContentShop">
              <a class="nav-link collapsed" href="shop.php">
                商城產品
              </a>
              <a class="nav-link collapsed" href="shop-edit.php">
                產品編輯
              </a>
              <a class="nav-link collapsed" href="shop-add.php">
                新增商品
              </a>
          </div>
          <a class="nav-link" href="order_history.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            訂單紀錄
          </a>
          <div class="sb-sidenav-menu-heading">其他資訊</div>
          <a class="nav-link" href="faq_add.php">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-circle-exclamation"></i>
            </div>
            注意事項
          </a>
          <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#heartContentCollapse" aria-expanded="false" aria-controls="heartContentCollapse" onclick="toggleCollapse('heartContentCollapse')">
            <div class="sb-nav-link-icon">
              <i class="fa-solid fa-heart-circle-check"></i>
            </div>
            心理測驗
            <div class="sb-sidenav-collapse-arrow">
              <i class="fas fa-angle-down"></i>
            </div>
          </a>
          <div class="collapse" id="heartContentCollapse" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav accordion" id="heartContentPages">
              <a class="nav-link collapsed" href="hearttest_question.php">
                測驗題目
              </a>
              <a class="nav-link collapsed" href="hearttest_result.php">
                測驗結果
              </a>
            </nav>
          </div>
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">專題製作</div>
        Take Pet Away
      </div>

    </nav>
  </div>
  <div id="layoutSidenav_content">


    <script>
      function toggleCollapse(targetId) {
        // 取得目標折疊面板的元素
        const targetCollapse = document.getElementById(targetId);
        // 取得所有折疊面板的元素
        const allCollapses = document.querySelectorAll('.collapse');
        // 迴圈遍歷所有折疊面板，將非目標折疊面板摺疊起來
        allCollapses.forEach(function(collapse) {
          if (collapse !== targetCollapse) {
            collapse.classList.remove('show');
          }
        });
      }
    </script>