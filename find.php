<?php include 'include/header.php';
include 'include/loginCheck.php';
?>

<!-- section 1 -->
<div class="container">
  <div class="d-flex flex-column mt-5">
    <h1 class="mb-3"> Welcome, <?php echo $_SESSION['userData']["first_name"]; ?> !</h1>
    <h1 class="mb-3 text-center">Find your Book</h1>
    <div class="mb-3">
      <label for="book" class="form-label  fw-bold">Search :</label>
      <input type="text" class="form-control" id="search_book" placeholder="A Song of Ice and Fire">
      <button class="btn btn-dark mt-2 searchbtn"> <i class="fa-solid fa-lightbulb"></i> Search</button>
      <button class="btn btn-dark mt-2 spinsearch d-none" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Searching...
      </button>
      <a class="btn btn-success mt-2" href="bookadd.php"> <i class="fa-solid fa-plus"></i> Add a Book</a>
      <a class="btn btn-outline-info mt-2 text-dark" href="favourite.php"> <i class="fa-regular fa-star"></i>Favourites</a>
    </div>
  </div>
  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-dark">
        <div class=" text-light modal-header">
          <h5 class="text-light modal-title" id="ModalLabel">Confirm Delete?</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" class="bg-dark text-light">
            <span aria-hidden="true">&times;</span>
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
<!-- Edit book details  End-->
<!-- Light-on book details -->
<div class="modal fade" id="FindBookModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-dark">
        <div class=" text-light modal-header">
          <h5 class="text-light modal-title" id="ModalLabel">Light up the book</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" class="bg-dark text-light">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="text-light modal-body">
          Light Status : <span id="light-status">ON</span>
          <br>
          <br>
          <span class="d-flex justify-content-center">
          <span id="light-status" class="text-center" >
          <svg version="1.0" class="d-none" id="bulb-on" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
            width="5rem" height="5rem" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
          <g>
            <path fill="#FFFF00" d="M41.15,44H36V25c0-1.104,0.896-2,2-2s2,0.896,2,2c0,0.553,0.447,1,1,1s1-0.447,1-1c0-2.209-1.791-4-4-4
              c-1.201,0-2.267,0.541-3,1.381C34.267,21.541,33.201,21,32,21s-2.267,0.541-3,1.381C28.267,21.541,27.201,21,26,21
              c-2.209,0-4,1.791-4,4c0,0.553,0.447,1,1,1s1-0.447,1-1c0-1.104,0.896-2,2-2s2,0.896,2,2v19h-5.15C15.271,40.525,10,32.883,10,24
              c0-12.15,9.85-22,22-22s22,9.85,22,22C54,32.883,48.729,40.527,41.15,44z"/>
            <g>
              <path fill="#394240" d="M32,0C18.745,0,8,10.746,8,24c0,9.684,5.743,18.006,14,21.801V60c0,2.211,1.789,4,4,4h12
                c2.211,0,4-1.789,4-4V45.801C50.257,42.006,56,33.684,56,24C56,10.746,45.255,0,32,0z M40,60c0,1.105-0.896,2-2,2H26
                c-1.104,0-2-0.895-2-2v-2h16V60z M40,56H24v-4h16V56z M40,50H24v-4h16V50z M30,44V25c0-1.104,0.896-2,2-2s2,0.896,2,2v19H30z
                M41.15,44H36V25c0-1.104,0.896-2,2-2s2,0.896,2,2c0,0.553,0.447,1,1,1s1-0.447,1-1c0-2.209-1.791-4-4-4
                c-1.201,0-2.267,0.541-3,1.381C34.267,21.541,33.201,21,32,21s-2.267,0.541-3,1.381C28.267,21.541,27.201,21,26,21
                c-2.209,0-4,1.791-4,4c0,0.553,0.447,1,1,1s1-0.447,1-1c0-1.104,0.896-2,2-2s2,0.896,2,2v19h-5.15C15.271,40.525,10,32.883,10,24
                c0-12.15,9.85-22,22-22s22,9.85,22,22C54,32.883,48.729,40.527,41.15,44z"/>
              <path fill="#394240" d="M32,6c-0.553,0-1,0.447-1,1s0.447,1,1,1c4.418,0,8.418,1.791,11.313,4.688c0,0,0.944,1.055,1.687,0.312
                s-0.271-1.729-0.271-1.729C41.471,8.016,36.971,6,32,6z"/>
            </g>
            <g>
              <path fill="#B4CCB9" d="M24,60c0,1.105,0.896,2,2,2h12c1.104,0,2-0.895,2-2v-2H24V60z"/>
              <rect x="24" y="52" fill="#B4CCB9" width="16" height="4"/>
              <rect x="24" y="46" fill="#B4CCB9" width="16" height="4"/>
            </g>
            <path fill="#F9EBB2" d="M34,44h-4V25c0-1.104,0.896-2,2-2s2,0.896,2,2V44z"/>
          </g>
          </svg>

          <svg version="1.0"  id="bulb-off" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="5rem" height="5rem" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#000000">

          <g id="SVGRepo_bgCarrier" stroke-width="0"/>

          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

          <g id="SVGRepo_iconCarrier"> <g> <path fill="#ffffff" d="M41.15,44H36V25c0-1.104,0.896-2,2-2s2,0.896,2,2c0,0.553,0.447,1,1,1s1-0.447,1-1c0-2.209-1.791-4-4-4 c-1.201,0-2.267,0.541-3,1.381C34.267,21.541,33.201,21,32,21s-2.267,0.541-3,1.381C28.267,21.541,27.201,21,26,21 c-2.209,0-4,1.791-4,4c0,0.553,0.447,1,1,1s1-0.447,1-1c0-1.104,0.896-2,2-2s2,0.896,2,2v19h-5.15C15.271,40.525,10,32.883,10,24 c0-12.15,9.85-22,22-22s22,9.85,22,22C54,32.883,48.729,40.527,41.15,44z"/> <g> <path fill="#394240" d="M32,0C18.745,0,8,10.746,8,24c0,9.684,5.743,18.006,14,21.801V60c0,2.211,1.789,4,4,4h12 c2.211,0,4-1.789,4-4V45.801C50.257,42.006,56,33.684,56,24C56,10.746,45.255,0,32,0z M40,60c0,1.105-0.896,2-2,2H26 c-1.104,0-2-0.895-2-2v-2h16V60z M40,56H24v-4h16V56z M40,50H24v-4h16V50z M30,44V25c0-1.104,0.896-2,2-2s2,0.896,2,2v19H30z M41.15,44H36V25c0-1.104,0.896-2,2-2s2,0.896,2,2c0,0.553,0.447,1,1,1s1-0.447,1-1c0-2.209-1.791-4-4-4 c-1.201,0-2.267,0.541-3,1.381C34.267,21.541,33.201,21,32,21s-2.267,0.541-3,1.381C28.267,21.541,27.201,21,26,21 c-2.209,0-4,1.791-4,4c0,0.553,0.447,1,1,1s1-0.447,1-1c0-1.104,0.896-2,2-2s2,0.896,2,2v19h-5.15C15.271,40.525,10,32.883,10,24 c0-12.15,9.85-22,22-22s22,9.85,22,22C54,32.883,48.729,40.527,41.15,44z"/> <path fill="#394240" d="M32,6c-0.553,0-1,0.447-1,1s0.447,1,1,1c4.418,0,8.418,1.791,11.313,4.688c0,0,0.944,1.055,1.687,0.312 s-0.271-1.729-0.271-1.729C41.471,8.016,36.971,6,32,6z"/> </g> <g> <path fill="#B4CCB9" d="M24,60c0,1.105,0.896,2,2,2h12c1.104,0,2-0.895,2-2v-2H24V60z"/> <rect x="24" y="52" fill="#B4CCB9" width="16" height="4"/> <rect x="24" y="46" fill="#B4CCB9" width="16" height="4"/> </g> <path fill="#ffffff" d="M34,44h-4V25c0-1.104,0.896-2,2-2s2,0.896,2,2V44z"/> </g> </g>

          </svg>
          </span>
          </span>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
  </div>
  <!-- Light-on book details END -->
  <!-- All books List -->

  <div id="books-list" class="row row-cols-1 row-cols-md-3 g-4 mt-3 mb-5">
    <div class="col" style="visibility:hidden" id="replace">
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
  </div>

</div>
<?php include 'include/footer.php' ?>

<script>
  $(document).ready(function() {
    LoadBooks(false);
  });
</script>