<?php include 'include/header.php'; include 'include/loginCheck.php';  ?>

    <!-- section 1 -->
    <div class="container mb-5">
     <!-- delete modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content bg-dark">
                <div class=" text-light modal-header">
                  <h5 class="text-light modal-title" id="ModalLabel">Confirm Delete?</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" class="bg-dark text-light">
                    <span aria-hidden="true" >&times;</span>
                  </button>
                </div>
                <div class="text-light modal-body">
                  This Process cannot be Undone!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-danger" id="deletebookConfirm">Delete</button>
                  <button class="btn btn-danger d-none" type="button" disabled id="delete-load">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      Deleting
                   </button>
                </div>
              </div>
            </div>
          </div>
          <!-- delete modal End -->
<!-- Edit book details -->
          <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="name" class="col-form-label">Book Name:</label>
                      <div class="spinner-border spinner-border-sm d-none"  id="editspinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                      <input type="text" class="form-control" name="name" id="name">

                    </div>
                    <div class="form-group">
                      <label for="author" class="col-form-label ">Author Name:</label>
                      <div class="spinner-border spinner-border-sm d-none" id="editspinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                      <input type="text" class="form-control" name="author" id="author">
                    </div>
                    <div class="form-group">
                      <label for="book_location" class="col-form-label">Book Location:</label>
                      <div class="spinner-border spinner-border-sm d-none"  id="editspinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                      <input type="number" class="form-control" name="book_location" id="book_location">
                    </div>
                    <div class="form-group">
                      <label for="book_color" class="col-form-label">Book Color:</label>
                      <div class="spinner-border spinner-border-sm d-none"  id="editspinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                      <input type="color" class="form-control" name="book_color" id="book_color">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-dark d-none" type="button" id="update-load" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Updating...
                  </button>
                  <button type="button" class="btn btn-dark" id="updateconfirm">Update</button>
                </div>
              </div>
            </div>
          </div>
<!-- Edit book details End-->
        <h1 class="display-4 fw-normal text-center mt-3"><i class="fa-solid fa-star" id="star"></i>My Favourites</h1>
        <a class="btn btn-danger mt-2" href="find.php">Go Back</a>
        <a class="btn btn-success mt-2" href="bookadd.php"> <i class="fa-solid fa-plus"></i> Add a Book</a>
<!-- All books List -->
<div class="p-2"></div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3" id="books-list">
                <div class="col" style="visibility:hidden">
                  <div class="card h-100">
                    <img src="assets/images/book_img.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title" id="bookname">Book name</h5>
                      <p>Author Name: </p>
                      <ul class="list-group ">
                        <li class="list-group-item">Book Location: </li>
                        <li class="list-group-item">Book Color: </li>
                      </ul>
                     </div>
                     <div class="m-2 text-center">
                      <span class="border-end border-dark border-0 p-1"><i class="fa-regular fa-star"></i> Add favourite</span>
                      <span class="m-1 border-end border-dark border-1 p-1"><i class="fa-solid fa-pen-to-square"></i> Edit</span>
                      <span class="m-1"> <i class="fa-solid fa-trash-can"></i> Delete</span> 
                     </div>
                    
                  </div>
                </div>

              <!-- Footer -->
</div>
    </div>
    <?php include 'include/footer.php' ?>
    <script>
      $(document).ready(function () {
        LoadBooks(true);
      });
    </script>