<!DOCTYPE html>
<html data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="../logo.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css" />
  </head>

  <body>
    <?php include 'part/header.php'; ?>
            <div class="col-12 pt-3 pb-2 mb-3">
              <h3 class="fw-bold">Edit Profil</h3>
            </div>
            <div class="col-12 mb-3">
              <div class="card">
                <div class="card-body p-4">
                  <form action="" method="post">
                    <div class="mb-3"><div class="mb-3">
                      <label for="name" class="form-label">Nama</label>
                      <input type="text" class="form-control mb-4" id="name" name="name" autocomplete="off" placeholder="Nama" />
                    </div>
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control mb-4" id="username" name="username" autocomplete="off" placeholder="Username" />
                    </div>
                    <label for="password1" class="form-label">Password Lama</label>
                    <div class="input-group mb-4">
                      <input type="hidden" id="plama" name="plama">
                      <input type="password" class="form-control rounded" placeholder="Password Lama" id="password1" name="password1" autocomplete="cc-csc" />
                      <button type="button" class="input-group-text text-secondary" onclick="showPassword('password1', 'iconPassword1')"><i id="iconPassword1" class="ri-eye-fill"></i></button>
                    </div>
                    <label for="password2" class="form-label">Password Baru</label>
                    <div class="input-group mb-4">
                      <input type="password" class="form-control" placeholder="Password Baru" id="password2" name="password2" autocomplete="cc-csc" />
                      <button type="button" class="input-group-text text-secondary" onclick="showPassword('password2', 'iconPassword2')"><i id="iconPassword2" class="ri-eye-fill"></i></button>
                    </div>
                    <button type="button" id="rgstr_btn" class="btn btn-primary col-12 col-md-6 mt-3" onclick="editProfile()">Simpan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>
        <footer class="col-md-9 col-xl-10 ms-sm-auto bt-theme pt-3 pb-1 shadow-lg">
          <p class="text-center small">&copy;Copyright by 22552011054_&_22552011068_Kelompok 5_221PC_UASWEB1</p>
        </footer>
      </div>
    </div>
    <?php include 'part/footer.php'; ?>
    <script src="../assets/js/theme.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
      function showPassword(inputId, iconId) {
        const inp = document.querySelector(`#${inputId}`);
        const icp = document.querySelector(`#${iconId}`);

        if (inp.type === "password") {
          inp.setAttribute("type", "text");
          icp.className = "ri-eye-off-fill";
        } else {
          inp.setAttribute("type", "password");
          icp.className = "ri-eye-fill";
        }
      }
      function getProfile(){
        const nama = localStorage.getItem('nama');
        var formData = new FormData();
        formData.append('name', nama);
        axios
          .post("https://scenix-photo.000webhostapp.com/API/selectprofile.php", formData)
          .then(function(response) {
            document.getElementById('name').value = response.data.name;
            document.getElementById('username').value = response.data.username;
            document.getElementById('plama').value = response.data.password;
          })
          .catch(function(error) {
            console.error(error);
            alert("Error fetching asd data.");
          });
      }
      function editProfile() {
        const namayou = localStorage.getItem('nama');
        const name = document.getElementById("name").value;
        const username = document.getElementById("username").value;
        const password1 = document.getElementById("password1").value;
        const password = document.getElementById("password2").value;
        const plama = document.getElementById("plama").value;
        const p1 = CryptoJS.SHA1(password1).toString();

        if(p1 == plama){
          const formData = new FormData();
          formData.append("namayou", namayou);
          formData.append("name", name);
          formData.append("username", username);
          formData.append("password", password);
          
          axios
            .post("https://scenix-photo.000webhostapp.com/API/editprofile.php", formData)
            .then((response) => {
              console.log(response);
              if (response.data.status == "success") {
                alert("Profil berhasil diperbarui.");
                window.location.href = "dashboard.php";
              } else {
                alert("Registrasi gagal. Mohon coba lagi.");
              }
            })
            .catch((error) => {
              console.error("Error during registration:", error);
            });
        } else {
          if(!password1){
            alert("Password lama anda harus diisi untuk menyimpan perubahan.");
          } else {
            alert("Password lama anda salah.");
          }
        }
      }
      window.onload = getProfile();
      document.getElementById("profile").classList.add("active");
    </script>
  </body>
</html>