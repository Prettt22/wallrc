<!DOCTYPE html>
<html data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kelola Wallpaper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="../logo.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css" />
  </head>

  <body>
    <?php include 'part/header.php'; ?>
            <div class="col-12 pt-3 pb-2 mb-3">
              <div class="d-flex justify-content-between flex-wrap align-items-center">
                <h3 class="fw-bold">Kelola Wallpaper</h3>
                <div class="btn-toolbar mb-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddNews">
                    Upload Wallpaper Baru
                  </button>
                </div>
              </div>
              <div class="modal fade" id="modalAddNews" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="addLabel">Upload Wallpaper Baru</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="addNewsForm">
                        <div class="mb-3">
                          <label for="judul" class="form-label">Judul</label>
                          <input type="text" class="form-control" maxlength="255" id="judul" name="judul" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="merek" class="form-label">Merek</label>
                          <input type="text" class="form-control" maxlength="50" id="merek" name="merek" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                          <label for="url_image" class="form-label">Wallpaper</label>
                          <input class="form-control" type="file" id="url_image" name="url_image" accept="image/*" required>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" onclick="addNews()">Upload</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="newsTable" class="table table-striped pt-4 w-100">
                      <thead>
                        <tr>
                          <th style="max-width: 25px;">No</th>
                          <th>Judul</th>
                          <th>Deskripsi</th>
                          <th>Merek</th>
                          <th>Ukuran</th>
                          <th>Resolusi</th>
                          <th style="max-width: 85px;">Tanggal</th>
                          <th style="max-width: 100px;">Wallpaper</th>
                          <th style="max-width: 60px;">Action</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>
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
    <script>
      $(document).ready(function() {
        $('#newsTable').DataTable( {
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "ajax": function(data, callback, settings){
            axios.get('https://scenix-photo.000webhostapp.com/API/listnews.php', {
              params: {
                key: data.search.value,
                nama: localStorage.getItem("nama")
              }
            })
            .then(function(response) {
              response.data.forEach(function(row, index) {
                row.no = index + 1;
              });
              callback({
                draw: data.draw,
                recordsTotal: response.data.length,
                recordsFiltered: response.data.length,
                data: response.data
              });
            })
            .catch(function(error){
              console.error(error);
              alert('Error fetching news data.');
            });
          },
          "columns": [
            {
              "data": "no"
            },
            {
              "data": "title"
            },
            {
              "data": "description"
            },
            {
              "data": "merk"
            },
            {
              "data": "size"
            },
            {
              "data": "resolution"
            },
            {
              "data": "upl_date"
            },
            {
              "data": "img",
              
              render: function(data, type, row) {
                return '<a href="'+data+'" target="_blank"><img src="'+data+'" style="max-width: 100px;"></a>';
              }
            },
            {
              "data": null,
              render: function(data, type, row) {
                return '<div class="d-flex align-items-center">'+
                '<form action="edit.php" method="post" class="m-0 me-2">'+
                '<input type="hidden" name="id" value="'+row.id+'">'+
                '<button type="submit" class="btn btn-outline-primary btn-sm"><i class="ri-edit-2-line"></i></button>'+
                '</form>'+
                '<button class="btn btn-outline-danger btn-sm" onclick="delNews('+row.id+')"><i class="ri-delete-bin-line"></i></button></div>';
              }
            }
          ]
        });
      });
      function addNews(){
        const judul = document.getElementById("judul").value;
        const deskripsi = document.getElementById("deskripsi").value;
        const merek = document.getElementById("merek").value;
        const uploader = localStorage.getItem('nama');
        const urlImageInput = document.getElementById("url_image");
        const url_image = urlImageInput.files[0];
        if(judul && deskripsi && merek && url_image){
          var formData = new FormData();
          formData.append('judul', judul);
          formData.append('deskripsi', deskripsi);
          formData.append('merek', merek);
          formData.append('uploader', uploader);
          formData.append('url_image', url_image);
          axios
            .post("https://scenix-photo.000webhostapp.com/API/addnews.php", formData, {
              header: {
                'Content-Type': 'multipart/form-data'
              }
            })
            .then(function(response) {
              console.log(response.data);
              console.log(formData);
              alert(response.data);
              document.getElementById('addNewsForm').reset();
              $("#newsTable").DataTable().ajax.reload();
            })
            .catch(function(error) {
              console.error(error);
              alert("Error adding news.");
            });
        }
      }
      function delNews(id){
        var formData = new FormData();
        formData.append('id', id);
        if(confirm("Are you sure you want to delete this news?")){
          axios
            .post("https://scenix-photo.000webhostapp.com/API/deletenews.php", formData)
            .then(function(response) {
              alert(response.data);
              $("#newsTable").DataTable().ajax.reload();
            })
            .catch(function(error) {
              console.error(error);
              alert("Error deleting news.");
            });
        }
      }
      document.getElementById("manage").classList.add("active");
    </script>
  </body>
</html>