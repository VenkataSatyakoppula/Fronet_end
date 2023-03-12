<?php include 'include/header.php';   

if (isset($_SESSION['user_id'])) {
  header('Location: '.$client_url.'/find.php');
  exit;
}


?>

    <!-- section 1 -->
    <section class="in-center">
        
        <div class="card container custom bg-dark rounded-3 border-">
          <?php
          if(!empty($_GET['verify'])){
            
            ?>
            <span class = "alert alert-info"><i class="fa-solid fa-circle-info"></i>Activation link has been Sent to your Email address! <?php echo "<strong>".$_GET['verify']."</strong>" ?></span>
          <?php
          unset($_GET['verify']);
          }
          ?>
          
            <h1 class="card-title text-center text-light">Login</h1>
            <form id="login-form">
                <div class="mb-3">
                  <label for="username" class="form-label text-light">Username</label>
                  <input type="text" class="form-control " name="username" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label text-light">Password</label>
                  <input type="password" class="form-control " name="password" id="password" placeholder="Password">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input " id="remeber">
                  <label class="form-check-label text-light" for="exampleCheck1">remeber me</label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-light " id="submit">Login</button>
                    <button class="btn btn-outline-light d-none" type="button" disabled id="submit-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Logging in
                    </button>
                </div>
                
              </form>
              <p class="text-light mt-3"><a href="register.php" class="text-info"> No Account ? Create one</a></p>
              <p class="text-info"><a href="forgot.php" class="text-info"> Forgot Password or Username ? Reset</a></p>
              <p class="text-info"><a href="activate.php" class="text-info"> Resend account activation link</a></p>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var url = '<?php echo $backen_url; ?>'
    </script>
    <script src="assets/main.js">
      
    </script>
    <script> localStorage.clear();</script>
</body>
<?php
if(!empty($_SESSION["logout"])){
  echo "<script type='text/javascript'>toastr.success('Logged out!');</script>";
  unset($_SESSION["logout"]);
}

?>
</html>