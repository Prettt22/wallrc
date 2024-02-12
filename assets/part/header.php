<nav class="navbar navbar-expand-lg bgt sticky-top shadow-sm">
      <div class="container justify-content-between">
        <a class="navbar-brand d-flex align-items-center fw-bold order-first me-auto me-lg-4" href="#" onclick="home()">
          <img src="logo.jpg" alt="logo" class="rounded me-2" width="35px" />
          WallRC
        </a>
        <button
          class="navbar-toggler p-1 border-0 order-2"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between order-3" id="navbarNavAltMarkup">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a id="home" class="nav-link mt-3 mt-lg-0" href="#" onclick="home()">Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <button id="gallery" class="nav-link dropdown-toggle bgt" type="button" data-bs-toggle="dropdown" aria-expanded="false">Koleksi</button>
              <ul class="dropdown-menu bgt mt-md-2">
                <li><h6 class="dropdown-header">Pilih Merek Mobil</h6></li>
                <li><a class="dropdown-item btn-bgt" href="#" onclick="acura()">Acura</a></li>
                <li><a class="dropdown-item btn-bgt" href="#" onclick="koenigsegg()">Koenigsegg</a></li>
                <li><a class="dropdown-item btn-bgt" href="#" onclick="lamborghini()">Lamborghini</a></li>
                <li><a class="dropdown-item btn-bgt" href="#" onclick="nissan()">Nissan</a></li>
                <li><a class="dropdown-item btn-bgt" href="#" onclick="pagani()">Pagani</a></li>
                <li><a class="dropdown-item btn-bgt" href="#" onclick="porsche()">Porsche</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a id="about" class="nav-link" href="#" onclick="about()">Tentang</a>
            </li>
            <hr class="nav-item border-bottom my-2" />
            <li id="hide1" class="nav-item">
              <a class="nav-link d-lg-none" href="#" onclick="login()">Login</a>
            </li>
            <li id="hide2" class="nav-item">
              <a class="nav-link d-lg-none" href="#" onclick="register()">Register</a>
            </li>
            <li id="show1" class="nav-item">
              <button type="button" class="nav-link d-lg-none" onclick="upload()">Upload</button>
            </li>
            <li id="show2" class="nav-item">
              <button type="button" class="nav-link d-lg-none" onclick="logout()">Logout</button>
            </li>
            <hr class="nav-item border-bottom my-2" />
          </ul>
          <form action="search.php" method="get" class="mx-auto my-3 my-lg-0 col-xl-7" role="search">
            <div class="input-group">
              <input class="form-control bgn" type="search" name="search" placeholder="Search" aria-label="Search" autocomplete="off" />
              <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
            </div>
          </form>
        </div>
        <div class="dropdown mt-1 me-1 me-md-2 order-1 order-lg-4 flex-end">
          <button class="btn dropdown-toggle border-0 fs-5 fs-md-6 px-1 me-1 bgt" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i id="iconActive" class="ri-contrast-line"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end mt-2 pt-1 bgt">
            <li><h6 class="dropdown-header">Theme</h6></li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center btn-bgt" type="button" data-bs-theme-value="light" onclick="changeIcon('ri-sun-line')">
                <i class="ri-sun-line me-2"></i>Light Theme
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center btn-bgt" type="button" data-bs-theme-value="dark" onclick="changeIcon('ri-moon-line')">
                <i class="ri-moon-line me-2"></i>Dark Theme
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center btn-bgt" type="button" data-bs-theme-value="auto" onclick="changeIcon('ri-contrast-line')">
                <i class="ri-contrast-line me-2"></i>Device Theme
              </button>
            </li>
          </ul>
        </div>
        <div class="d-none d-lg-inline order-5">
          <div class="d-flex">
            <a id="hide3" class="nav-link me-3" href="#" onclick="login()">Login</a>
            <a id="hide4" class="nav-link" href="#" onclick="register()">Register</a>
            <button type="button" id="show3" class="nav-link me-3" onclick="upload()">Upload</button>
            <button type="button" id="show4" class="nav-link" onclick="logout()">Logout</button>
          </div>
        </div>
      </div>
    </nav>