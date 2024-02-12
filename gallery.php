<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WallRC - Wallpaper Racing Cars</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo.jpg" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body>
    <?php include 'assets/part/header.php'; ?>
    <div class="container min-vh-100 my-3">
      <h2 class="mt-5 fw-bold text-center text-capitalize">Koleksi Wallpaper <?= $_GET['koleksi']; ?></h2>
      <hr>
      <div id="rowWall" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4 mt-5"></div>
    </div>

    <footer class="bgt pt-3 pb-1 shadow-lg">
      <p class="text-center small">&copy;Copyright by 22552011054_&_22552011068_Kelompok 5_221PC_UASWEB1</p>
    </footer>

    <input type="hidden" id="merk" value="<?= $_GET['koleksi']; ?>">

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <?php include "assets/part/footer.php"; ?>
    <script>
      document.getElementById("gallery").classList.add("active");
      function getWall() {
        const merk = document.getElementById("merk").value; // Get the value of merk input
        axios
          .get("https://scenix-photo.000webhostapp.com/API/listwall.php?key=" + merk)
          .then(function(response) {
            response.data.forEach(row => {
              var colDiv = document.createElement('div');
              colDiv.className = 'col mb-4';
              colDiv.innerHTML = `
              <div class="card border-0">
                <div class="neon">
                  <a href="detail.php?id=${row.id}" class="card text-bg-dark border-0">
                    <img src="${row.img}" class="card-img" alt="mobil" />
                    <div class="card-img-overlay d-flex justify-content-center align-items-end">
                      <h5 class="card-title ffc">${row.title}</h5>
                    </div>
                  </a>
                </div>
              </div>`;
              document.getElementById('rowWall').appendChild(colDiv);
            });
          })
          .catch(function(error) {
            console.error(error);
            alert("Error fetching data.");
          });
      }
      window.onload = getWall;
    </script>
  </body>
</html>