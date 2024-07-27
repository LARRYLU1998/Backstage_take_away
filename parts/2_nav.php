<nav class=" sb-topnav navbar navbar-expand navbar-dark bg-dark" style="height: 60px;">
  <!-- Navbar Brand-->
  <a class="navbar-brand ps-3" href="index_.php">
    <img src="logo.png" style="width:50%; margin-left:10px" class="mt-3 mb-2" alt="">
  </a>

  <!-- Navbar Search-->
  <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    <input type="text" name="query" placeholder="Enter your search term">
    <button type="submit">Search</button>
  </form> -->
  <!-- Navbar-->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class=" navbar-nav me-auto mb-2 mb-lg-0">
    </ul>
    <ul class="navbar-nav mb-2 mb-lg-0">
      <?php if (isset($_SESSION['user'])) : ?>
        <li class="nav-item">
          <a class="nav-link"><?= $_SESSION['user']['name'] ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">登出</a>
        </li>
      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">登入</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">註冊</a>
        </li>
      <?php endif ?>
    </ul>
  </div>
</nav>