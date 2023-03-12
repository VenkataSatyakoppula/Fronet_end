<?php include 'include/header.php';   

?>

    <!-- section 1 -->
    <section class="in-center">
    
        <div class="card container custom bg-dark rounded-3 border-">
            <div>
            <a href="profile.php" class="btn btn-info" id="back">Go back</a>
            </div>
            <h1 class="card-title text-center text-light">Change Password</h1>
            
            <form id="changepass-form">
            <div class="mb-3">
                  <label for="old_password" class="form-label text-light">Old Password</label>
                  <input type="text" class="form-control" name="old_password" id="old_password" placeholder="Old password">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label text-light">New Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="New password">
                </div>
                <div class="mb-3">
                  <label for="confirm_password" class="form-label text-light">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-light " id="submit">Update</button>
                    <button class="btn btn-outline-light d-none" type="button" disabled id="submit-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating..
                    </button>
                </div>
                
              </form>
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