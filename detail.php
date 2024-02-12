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
    <div id="rowWall" class="container my-5"></div>

    <footer class="bgt pt-3 pb-1 shadow-lg">
      <p class="text-center small">&copy;Copyright by 22552011054_&_22552011068_Kelompok 5_221PC_UASWEB1</p>
    </footer>

    <input type="hidden" id="id" value="<?= $_GET['id']; ?>">
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script>
      function download(urlImg) {
        const name = document.getElementById("name").value;
        const imgElement = document.getElementById("gambar");
        const imgUrl = imgElement.src;

        const downloadLink = document.createElement("a");
        downloadLink.href = imgUrl;
        downloadLink.download = name; // Use the name instead of id
        downloadLink.target = "_blank";
        downloadLink.style.display = "none";

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
      }

      
      function getWall() {
        const id = document.getElementById("id").value; // Get the value of id input
        axios
          .get("https://scenix-photo.000webhostapp.com/API/detailwall.php?id=" + id)
          .then(function(response) {
            const row = response.data[0]; // Assuming you're expecting only one row
            document.getElementById("rowWall").innerHTML = `
            <h2 class="fw-bold ffc">${row.title}</h2>
            <hr>
            <div class="card border-0 mt-5">
              <div class="neon">
                <img
                  id="gambar"
                  src="${row.img}"
                  class="card-img"
                  alt="mobil"
                />
              </div>
            </div>
            <div class="text-center mt-5">
              <h3 class="fw-bold">Info Detail</h3>
              <hr>
              <dl class="text-start">
                <dt>Nama</dt>
                  <dd class="ffc">${row.title}</dd>
                <dt>Merek</dt>
                  <dd class="ffc">${row.merk}</dd>
                <dt>Deskripsi</dt>
                  <dd>${row.description}</dd>
                <dt>Resolusi</dt>
                  <dd>${row.resolution}</dd>
                <dt>Ukuran</dt>
                  <dd>${row.size}</dd>
                <dt>Upload Oleh</dt>
                  <dd>${row.upl_by}</dd>
                <dt>Tanggal Upload</dt>
                  <dd>${row.upl_date}</dd>
              </dl>
              <button class="btn btn-primary col-12 col-md-6 col-lg-4" onclick="download()">Download</button>
            </div>
            <input type="hidden" id="name" value="${row.name}">
            `;
          })
          .catch(function(error) {
              console.error(error);
              alert("Error fetching data.");
          });
      }

      window.onload = getWall;

    </script>
    <?php include "assets/part/footer.php"; ?>
  </body>
</html>
