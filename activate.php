<?php include 'include/header.php';   

if (isset($_SESSION['user_id'])) {
  header('Location: '.$client_url.'/find.php');
  exit;
}

?>

    <!-- section 1 -->
    <section class="in-center">
        
        <div class="card container custom bg-dark rounded-3">
            
            <div class="sucess-mail d-flex flex-column mt-5 d-none">
              <span class="text-center">
              <img src="assets/images/checkmark.png" height="120" width="120">
              </span>
              <h3 class="text-light mt-2 justify text-center">Activation Link has been sent Successfully</h3>
              <p class="mt-2 text-center"><a href="login.php" class="text-info"> Go to Login Page</a></p>
            </div>
            <div id="reset-body">
            <h1 class="card-title text-center text-light mb-3"> <i class="fa-regular fa-envelope"></i> Account Activate</h1>
            <p class="text-light">We'll Send a link to your mail for Account Activation if you have given valid email address during registration and if an account exists</p>
            <form id="reset-form" class="activation-form">
                <div class="mb-3">
                  <label for="email" class="form-label text-light">Registered Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-light " id="submit">Send</button>
                    <button class="btn btn-outline-light d-none" type="button" disabled id="submit-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Sending..
                    </button>
                </div>
                
              </form>
              <p class="text-light mt-3"><a href="register.php" class="text-info">No Account ? Create one</a></p>
              <p class="text-info"><a href="login.php" class="text-info">Already Activated ? Login</a></p>
              </div>

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
</body>
</html>