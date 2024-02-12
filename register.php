<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Halaman Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="logo.jpg" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body class="screen">
    <div class="d-flex align-items-center min-vh-100 pt-3">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-4 col-lg-6 col-md-8 col-11 card shadow">
            <div class="card-body p-4">
              <form>
                <h1 class="post-title">Register</h1>
                <h5 class="mb-3 post-title">Mohon register terlebih dahulu</h5>
                <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" class="form-control rounded-pill mb-4" id="name" name="name" autocomplete="off" placeholder="Nama" />
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control rounded-pill mb-4" id="username" name="username" autocomplete="off" placeholder="Username" />
                </div>
                <label for="password" class="form-label">Password</label>
                <div class="input-group mb-4">
                  <input type="password" class="form-control" placeholder="Password" id="password" name="password" autocomplete="cc-csc" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;" />
                  <button type="button" class="input-group-text text-secondary" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;" onclick="showPassword()"><i id="iconPassword" class="ri-eye-fill"></i></button>
                </div>
                <button type="button" id="rgstr_btn" class="btn btn-primary w-100 mb-3 rounded-pill" onclick="register()">Register</button>
                <p class="mb-0">Sudah punya akun? <a href="login.php"><u>Klik disini</u></a></p>
              </form>
            </div>
          </div>
        <p class="text-center text-white mt-3 small">&copy;Copyright by 22552011054_&_22552011068_Kelompok 5_221PC_UASWEB1</p>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      function showPassword() {
        const inp = document.querySelector("#password");
        const icp = document.querySelector("#iconPassword");

        if (inp.type === "password") {
          inp.setAttribute("type", "text");
          icp.className = "ri-eye-off-fill";
        } else {
          inp.setAttribute("type", "password");
          icp.className = "ri-eye-fill";
        }
      }
      function register() {
        const name = document.getElementById("name").value;
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;
        const formData = new FormData();
        formData.append("name", name);
        formData.append("username", username);
        formData.append("password", password);
        
        axios
          .post("https://scenix-photo.000webhostapp.com/API/register.php", formData)
          .then((response) => {
            console.log(response);
            if (response.data.status == "success") {
              alert("Registrasi berhasil. Selanjutnya silahkan login.");
              window.location.href = "login.php";
            } else if(response.data.status == "Username sudah terdaftar") {
              alert("Username sudah terdaftar, coba gunakan username yang lain.");
            } else {
              alert("Registrasi gagal. Mohon coba lagi.");
            }
          })
          .catch((error) => {
            console.error("Error during registration:", error);
          });
      }
    </script>
  </body>
</html>
