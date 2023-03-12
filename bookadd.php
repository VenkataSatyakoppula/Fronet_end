<?php  include 'include/header.php';
  include 'include/loginCheck.php';
?>

<section class="in-center">
        
        <div class="card container custom bg-dark rounded-3">
            <div>
            <a class="btn btn-danger" href="find.php">Go Back</a>
            </div>
            <h1 class="card-title text-center text-light">Add Book</h1>
            <form id="book-form" method="post">
            
                    <div class="mb-3">
                        <label for="name" class="form-label text-light">Book Name</label>
                        <input type="text" class="form-control shadow-none" name="name" id="name" placeholder="Book Name">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label text-light">Author Name</label>
                        <input type="text" class="form-control shadow-none" name="author" id="author" placeholder="Author Name">
                    </div>
                <div class="mb-3">
                    <label for="book_location" class="form-label text-light">Book Location</label>
                    <input type="number" class="form-control shadow-none" name="book_location" id="book_location" placeholder="Book Location">
                  </div>
                <!-- <div class="mb-3">
                  <label for="book_color" class="form-label text-light">Book Color</label>
                  <input type="text" class="form-control shadow-none" name="book_color" id="book_color" placeholder="Book Color">
                </div> -->
                <div id="color-picker-component" class="mb-3">
                   <label for="book_color" class="form-label text-light ">Book Color</label>
                    <input type="color" value="#f6b73c" class="form-control p-1 shadow-none" name="book_color" id="book_color"/>
                    
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" value="true" name="isfav" id="isfav">
                  <label class="form-check-label text-light" for="isfav"  >Add to Favourite</label>
                </div>
                <div class="text-center " >
                    <button type="submit" class="btn btn-outline-light" id="submit">Add</button>
                    <button class="btn btn-outline-light d-none" type="button" disabled id="submit-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Adding
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
        var url = '<?php echo $backen_url; ?>';
    </script>
    <script src="assets/main.js">
      
    </script>
    </body>
</html>


