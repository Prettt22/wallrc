
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      function checkSession() {
        const formData = new FormData();
        formData.append("session_token", localStorage.getItem("session_token"));
        axios
          .post("https://scenix-photo.000webhostapp.com/API/session.php", formData)
          .then((response) => {
            console.log(response);
            if (response.data.status === "success") {
              const nama = response.data.hasil.name || "Default Name";
              localStorage.setItem("nama", nama);
            } else {
              alert("The session has ended, please log in again.");
              window.location.href = "../login.php";
            }
          })
          .catch((error) => {
            console.error("Error checking session:", error);
          });
      }
      checkSession();
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
                window.location.href = "../";
              } else {
                alert("Logout failed. Please try again.");
              }
            })
            .catch((error) => {
              console.error("Error during logout:", error);
            });
        }
      }
      function dashboard(){
        window.location.href="dashboard.php";
      }
      function manage(){
        window.location.href="manage.php";  
      }
      function profile(){
        window.location.href="profile.php";  
      }
      function utama(){
        window.open("../", "_blank");
      }
    </script>