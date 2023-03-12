<?php include 'include/header.php';  

if (!isset($_SESSION['user_id'])) {
  header('Location: '.$client_url.'/login.php');
  exit;
}
?>
<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-dark">
        <div class=" text-light modal-header">
          <h5 class="text-light modal-title" id="ModalLabel">Confirm Account Delete?</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" class="bg-dark text-light">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="text-light modal-body">
          Warning: This Process cannot be Undone!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="deleteUserConfirm">Delete</button>
          <button class="btn btn-danger d-none" type="button" disabled id="delete-load">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Deleting
          </button>
        </div>
      </div>
    </div>
  </div>
    <!-- section 1 -->
    <section class="in-center">
        
        <div class="card container custom bg-dark rounded-3 border-">
            <h3 class="card-title text-center text-light">Update Account Details</h3>
            <form id="update-form" method="post">
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
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label text-light" for="exampleCheck1">remeber me</label>
                </div> -->
                <div class="mb-3">
                  <label for="username" class="form-label text-light">Change Password</label> <br>
                  <a href="change_password.php" class="btn btn-outline-light">Link</a>
                </div>
                
                
                <div class="text-center" >
                    <button type="submit" class="btn btn-outline-light w-50" id="submit">Update</button>
                    <button class="btn btn-outline-light d-none" type="button" disabled id="submit-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Updating
                    </button>
                </div>
              </form>
              <div class="text-center mt-3">
              <button type="button" class="btn btn-danger" id="deleteAccount">Delete Account</button>
              <button class="btn btn-outline-light d-none" type="button" disabled id="delete-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Deleting...
                </button>
              </div>
        </div>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var url = '<?php echo $backen_url; ?>';
    </script>
    <script src="assets/main.js"></script>
    <script>
       $(document).ready(function () {
        GetUser();
        setInterval(RefreshToken, 60000); //every 1mins
      });
    </script>
</body>
</html>