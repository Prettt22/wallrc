
    <script>
      if(localStorage.getItem("session_token")) {
        let h1 = document.getElementById("hide1");
        h1.style.display = 'none';
        let h2 = document.getElementById("hide2");
        h2.style.display = 'none';
        let h3 = document.getElementById("hide3");
        h3.style.display = 'none';
        let h4 = document.getElementById("hide4");
        h4.style.display = 'none';
        let s1 = document.getElementById("show1");
        s1.style.display = 'block';
        let s2 = document.getElementById("show2");
        s2.style.display = 'block';
        let s3 = document.getElementById("show3");
        s3.style.display = 'block';
        let s4 = document.getElementById("show4");
        s4.style.display = 'block';
      } else {
        let h1 = document.getElementById("hide1");
        h1.style.display = "block";
        let h2 = document.getElementById("hide2");
        h2.style.display = "block";
        let h3 = document.getElementById("hide3");
        h3.style.display = "block";
        let h4 = document.getElementById("hide4");
        h4.style.display = "block";
        let s1 = document.getElementById("show1");
        s1.style.display = "none";
        let s2 = document.getElementById("show2");
        s2.style.display = "none";
        let s3 = document.getElementById("show3");
        s3.style.display = "none";
        let s4 = document.getElementById("show4");
        s4.style.display = "none";
      }

      function home(){
        window.location.href="index.php";
      }
      function acura(){
        window.location.href="gallery.php?koleksi=acura";
      }
      function koenigsegg(){
        window.location.href="gallery.php?koleksi=koenigsegg";
      }
      function lamborghini(){
        window.location.href="gallery.php?koleksi=lamborghini";
      }
      function nissan(){
        window.location.href="gallery.php?koleksi=nissan";
      }
      function pagani(){
        window.location.href="gallery.php?koleksi=pagani";
      }
      function porsche(){
        window.location.href="gallery.php?koleksi=porsche";
      }
      function about(){
        window.location.href="about.php";
      }
      function login(){
        window.location.href="login.php";
      }
      function register(){
        window.location.href="register.php";
      }
      function upload() {
        window.location.href="admin/";
      }
      function logout() {
        if(confirm("Apakah kamu yakin ingin logout?")){
          sessionToken = localStorage.getItem("session_token");
          localStorage.removeItem("nama");
          const formData = new FormData();
          formData.append("session_token", sessionToken);
          axios
            .post("https://scenix-photo.000webhostapp.com/API/logout.php", formData)
            .then((response) => {
              if (response.data.status == "success") {
                localStorage.removeItem("nama");
                localStorage.removeItem("session_token");
                window.location.href = "index.php";
              } else {
                alert("Logout failed. Please try again.");
              }
            })
            .catch((error) => {
              console.error("Error during logout:", error);
            });
        }
      }
    </script>