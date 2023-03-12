<?php include 'include/header.php';  

if (isset($_SESSION['user_id'])) {
  header('Location: '.$client_url.'/find.php');
  exit;
}

?>

    <!-- section 1 -->
    <section class="in-center">
        
        <div class="card container custom bg-dark rounded-3 border-">
            <h1 class="card-title text-center text-light">Create Account</h1>
            <form id="register-form" method="post">
                <div class="d-flex">
                    <div class="mb-3">
                        <label for="first_name" class="form-label text-light">First Name</label>
                        <input type="text" class="form-control shadow-none" name="first_name" id="first_name" placeholder="First Name">
                    </div>
                    <div class="mb-3 ms-2">
                        <label for="last_name" class="form-label text-light">Last Name</label>
                        <input type="text" class="form-control shadow-none" name="last_name" id="last_name" placeholder="Last Name">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-light">Email</label>
                    <input type="email" class="form-control shadow-none" name="email" id="email" placeholder="example@domain.com">
                  </div>
                <div class="mb-3">
                  <label for="username" class="form-label text-light">Username (Used for login)</label>
                  <input type="text" class="form-control shadow-none" name="username" id="username" placeholder="Username">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label text-light">Password</label>
                  <input type="password" class="form-control shadow-none" name="password" id="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-light">Confirm Password</label>
                    <input type="password" class="form-control shadow-none" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                </div>
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label text-light" for="exampleCheck1">remeber me</label>
                </div> -->
                <div class="text-center " >
                    <button type="submit" class="btn btn-outline-light" id="submit">Submit</button>
                    <button class="btn btn-outline-light d-none" type="button" disabled id="submit-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Submitting
                    </button>
                </div>
     
              </form>
              <p class="text-light mt-3"><a href="login.php" class="text-info"> Already Registered ? Login</a></p>
        </div>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var url = '<?php echo $backen_url; ?>';
    </script>
    <script src="assets/main.js">
      
    </script>
</body>
</html>