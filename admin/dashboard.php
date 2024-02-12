<!DOCTYPE html>
<html data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="../logo.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/admin.css" />
  </head>

  <body>
    <?php include 'part/header.php'; ?>
            <div class="col-12 pt-3 pb-2 mb-3">
              <div class="d-flex justify-content-between flex-wrap align-items-center">
                <div class="d-block mb-4 mb-sm-0">
                  <h5 id="opening"></h5>
                  <h3 class="fw-bold">Dashboard</h3>
                </div>
                <div class="btn-toolbar">
                  <a href="manage.php" class="btn btn-primary">
                    <h6 class="mb-0"><i class="ri-image-fill"></i> Total Wallpaper: <span id="jumlahBerita" class="fw-bold">Loading..</span></h6>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-12 mb-3">
              <div class="card my-3">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                    <h4>Chart</h4>
                    <div class="d-flex">
                      <select class="form-control me-3" style="width: fit-content;" id="tahunSelect"></select>
                      <div class="dropdown">
                        <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ri-download-line me-2"></i>Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><button type="button" class="dropdown-item" onclick="downloadExcel()">Download Excel</button></li>
                          <li><button type="button" class="dropdown-item" onclick="downloadPDF()">Download PDF</button></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <h4 class="text-center mt-3">CHART JUMLAH WALLPAPER DALAM 1 TAHUN</h4>
                  <canvas id="newsChart" width="400" height="200"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script>
      if(localStorage.getItem("session_token")){
        document.getElementById("opening").innerText = "Selamat datang, " + localStorage.getItem('nama') + "😊";
      }
      document.getElementById("dashboard").classList.add("active");

      function fetchData(nama, tahun) {
        var formData = new FormData();
        formData.append('nama', nama);
        formData.append('tahun', tahun);

        return axios ({
          method: 'post',
          url: 'https://scenix-photo.000webhostapp.com/API/sum_beritatahun.php',
          data: formData,
          headers: {'Content-Type': 'multipart/form-data'}
        });
      }
      function createChart(data) {
        var ctx = document.getElementById('newsChart').getContext('2d');
        var existingChart = Chart.getChart(ctx);
        if(existingChart){
          existingChart.destroy();
        }
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.map(item=>item.bulan),
            datasets: [{
              label: 'Jumlah Wallpaper',
              data: data.map(item=>item.wallpaper),
              backgroundColor: '#9694ff77',
              borderColor: '#9694ffff',
              borderWidth: 2
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 1
                }
              }
            }
          }
        });
      }
      function populateSelectOptions(data) {
        var selectElement = document.getElementById('tahunSelect');
        data.forEach(item => {
          var option = document.createElement('option');
          option.value = item.year;
          option.text = item.year;
          selectElement.add(option);
        });
        var latestYear = data[0].year;
        document.getElementById('tahunSelect').value = latestYear;
        fetchData(localStorage.getItem('nama'), latestYear)
        .then(response=>{
          var chartData = response.data;
          createChart(chartData);
        })
        .catch(error=>{
          console.error('Error fetching data:', error);
        });
      }
      document.getElementById('tahunSelect').addEventListener('change',function() {
        var selectedYear = this.value;
        fetchData(localStorage.getItem('nama'), selectedYear)
        .then(response=>{
          var chartData = response.data;
          createChart(chartData);
        })
        .catch(error=>{
          console.error('Error fetching data:', error);
        });
      });
      axios.get('https://scenix-photo.000webhostapp.com/API/select_tahun.php')
        .then(response => {
          var tahunData = response.data;
          populateSelectOptions(tahunData);
        })
        .catch(error => {
          console.error('Error fetching years data', error);
        });
      axios.get('https://scenix-photo.000webhostapp.com/API/sum_berita.php?nama="'+localStorage.getItem('nama')+'"')
        .then(response => {
          var dataSumNews = response.data;
          var sumNewsElement = document.getElementById('jumlahBerita');
          sumNewsElement.innerHTML = dataSumNews[0].wallpaper;
        })
        .catch(error => {
          console.error('Error fetching data', error);
        });
      function downloadExcel(){
        var selectedYear = document.getElementById('tahunSelect').value;
        fetchData(localStorage.getItem('nama'), selectedYear)
        .then(response=>{
          var data = response.data;
          var ws = XLSX.utils.json_to_sheet(data);
          var wb = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(wb, ws, "Report");
          XLSX.writeFile(wb, "report_excel_"+selectedYear+".xlsx");
        })
        .catch(error => {
          console.error('Error fetching data for excel', error);
        });
      }
      function downloadPDF(){
        var canvas = document.getElementById('newsChart');
        var imgData = canvas.toDataURL('image/png');
        var selectedYear = document.getElementById('tahunSelect').value;
        var docDefinition = {
          content: [
            { text: 'Report ' + selectedYear, style: 'header' },
            { image: imgData, width: 500 },
          ],
          styles: {
            header: {
              fontSize: 18,
              bold: true,
              margin: [0, 0, 0, 10],
            },
          },
        };
        pdfMake.createPdf(docDefinition).download('report_pdf_'+selectedYear+'.pdf');
      }
    </script>
  </body>
</html>
