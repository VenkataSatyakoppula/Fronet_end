$( document ).ready(function() {
    //let url = "http://127.0.0.1:8000";
    let isfavpage;
    function parseJwt (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    }
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    //****All Ajax Functions Implementation Start****

    //helper functions
    function placeholder(message){
      let html = ""
      html += `
      <span class="display-5" id="no-books">${message}</span>
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
        
      </div>`;

      return html;
    }
    function BookLoading() {
      let html = "";
      for (let i = 0; i < 3; i++) {
        html += `<div class="col" >
        <div class="card h-100">
          <img src="assets/images/placeholder_resize.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6 placeholder-lg"></span>
            </h5>
            <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6 placeholder-lg"></span>
            </h5>
            <p class="placeholder-glow">
              <span class="placeholder col-6"></span>
            </p>
            <ul class="list-group placeholder-glow">
              <li class="list-group-item placeholder col-12"> </li>
              <li class="list-group-item placeholder col-12"> </li>
            </ul>
           </div>
           <div class="m-2 text-center placeholder-glow">
            <span class="placeholder col-3 bg-warning"></span>
            <span class="placeholder col-2 bg-dark"></span>
            <span class="placeholder col-3 bg-dark"></span>
            <span class="placeholder col-3 bg-dark"></span>
           </div>
        </div>
        </div>
            `;
      }
      return html;
    }
    function CardUpdate(book) {
      let html = `
      <div class="card h-100">
        <img src="assets/images/book_img.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">${book.name.toUpperCase()}</h5>
          <p><strong>Author Name:</strong> ${book.author} </p>
          <ul class="list-group ">
            <li class="list-group-item"><strong>Book Location:</strong> ${book.book_location}</li>
            <li class="list-group-item"><strong>Book Color:</strong> &nbsp <i class="fa-solid fa-circle" style="color:${book.book_color}"></i> </li>
          </ul>
         </div>
         <div class="m-2 text-center">
         `
         if (book.isfav) {
          var fav = `<span class="border-end border-dark border-0 p-1  addfav" data-fav=${book.isfav} data-id=${book.id}><i class="fa-solid fa-star" id="star"></i><div class="spinner-grow spinner-grow-sm text-warning d-none" id="starspin" role="status"><span class="sr-only">Loading...</span>
        </div> Favourite </span>`   
         } else {
          var fav = `<span class="border-end border-dark border-0 p-1 addfav" data-fav=${book.isfav} data-id=${book.id}><i class="fa-regular fa-star"></i><div class="spinner-grow spinner-grow-sm text-warning d-none" id="starspin" role="status"><span class="sr-only">Loading...</span>
        </div> Add favourite</span>`
         }

          let foot = `<span class="m-1 border-end border-dark border-1 p-1 updatebook" data-id=${book.id} data-bs-target="#EditModal" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i> Edit</span>
          <span class="m-1 border-end border-dark border-1"  data-id=${book.id} data-bs-target="#FindBookModal" data-bs-toggle="modal">  <i class="fa-solid fa-lightbulb"></i> Find </span>
          <span class="m-1 deletebook" data-bs-target="#deleteModal" data-bs-toggle="modal" data-id=${book.id}> <i class="fa-solid fa-trash-can"  ></i> Delete</span> 
         </div>
         </div>`

      return html + fav + foot;

    }
    function RenderBooks(response,favouritePage){
      let finalhtml = "";
        response.forEach(function(book) {
          if(!favouritePage){
           var bookshtml = `<div class="col" id="${book.id}">
           <div class="card h-100">
            <img src="assets/images/book_img.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">${book.name.toUpperCase()}</h5>
              <p><strong>Author Name:</strong> ${book.author} </p>
              <ul class="list-group ">
                <li class="list-group-item"><strong>Book Location:</strong> ${book.book_location}</li>
                <li class="list-group-item"><strong>Book Color:</strong> &nbsp <i class="fa-solid fa-circle" style="color:${book.book_color}"></i> </li>
              </ul>
             </div>
             <div class="m-2 text-center">
             `
             if (book.isfav) {
              var fav = `<span class="border-end border-dark border-0 p-1  addfav" data-fav=${book.isfav} data-id=${book.id}><i class="fa-solid fa-star" id="star"></i><div class="spinner-grow spinner-grow-sm text-warning d-none" id="starspin" role="status"><span class="sr-only">Loading...</span>
            </div> Favourite </span>`   
             } else {
              var fav = `<span class="border-end border-dark border-0 p-1 addfav" data-fav=${book.isfav} data-id=${book.id}><i class="fa-regular fa-star"></i><div class="spinner-grow spinner-grow-sm text-warning d-none" id="starspin" role="status"><span class="sr-only">Loading...</span>
            </div> Add favourite</span>`
             }

              let foot = `<span class="m-1 border-end border-dark border-1 p-1 updatebook" data-id=${book.id} data-bs-target="#EditModal" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i> Edit</span>
              <span class="m-1 border-end border-dark border-1 findbook" data-id=${book.id} data-bs-target="#FindBookModal" data-bs-toggle="modal"> <i class="fa-solid fa-lightbulb"></i> Find </span>
              <span class="m-1 deletebook" data-bs-target="#deleteModal" data-bs-toggle="modal" data-id=${book.id}> <i class="fa-solid fa-trash-can"  ></i> Delete</span> 
             </div>
            
           </div>
           </div>`
           finalhtml += bookshtml + fav + foot;
          }
          else if(favouritePage && book.isfav){
            finalhtml += `<div class="col" id="${book.id}">
            <div class="card h-100">
              <img src="assets/images/book_img.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title" id="bookname">${book.name}</h5>
                <p>Author Name: ${book.author} </p>
                <ul class="list-group ">
                  <li class="list-group-item"><strong>Book Location:</strong>  ${book.book_location}</li>
                  <li class="list-group-item"><strong>Book Color:</strong>  <i class="fa-solid fa-circle" style="color:${book.book_color}"></i> </li>
                </ul>
               </div>
               <div class="m-2 text-center">
                <span class="border-end border-dark border-0 p-1 addfav" data-fav=${book.isfav} data-id=${book.id}><i class="fa-solid fa-star"  id="star"></i><div class="spinner-grow spinner-grow-sm text-warning d-none" id="starspin" role="status"><span class="sr-only">Loading...</span>
              </div> Favourite</span>
                <span class="m-1 border-end border-dark border-1 p-1 updatebook" data-id=${book.id} data-bs-target="#EditModal" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i> Edit</span>
                <span class="m-1 border-end border-dark border-1 findbook" data-id=${book.id} data-bs-target="#FindBookModal" data-bs-toggle="modal"> <i class="fa-solid fa-lightbulb"></i> Find </span>
                <span class="m-1 deletebook" data-bs-target="#deleteModal" data-bs-toggle="modal" data-id=${book.id}> <i class="fa-solid fa-trash-can" ></i> Delete</span> 
               </div>
              
            </div>
           </div>`
          }
      });
      return finalhtml;
    }
    //register function
    function Register(data) {
        var settings = {
            "url": `${url}/api/register/`,
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Content-Type": "application/json"
            },
            "data": data,
            beforeSend: function () {
                $("#submit").addClass("d-none");
                $("#submit-load").removeClass("d-none");
            },
            error: function(xhr, status, error){
                $("#submit-load").addClass("d-none");
                $("#submit").removeClass("d-none");
                $("#register-form").find('input').attr('disabled', false).css('opacity',1);
                if (xhr.status == 400) {
                    let json = JSON.parse(xhr.responseText);
                    for(var field in json){
                        toastr.error(json[field][0]);
                    }         
                } else {
                    console.log("Something went Wrong Try again..");
                }
            }
          };
          $.ajax(settings).done(function (response) {
            $("#submit-load").addClass("d-none");
            $("#submit").removeClass("d-none");

            toastr.success('User Created', 'Success');
            toastr.info("Redirecting, please wait...");
            setTimeout(function() {
                location.href = `./login.php?verify=${response.email}`
            }, 2000);
          });
    }
    //login function
    function Login(data) {
        var settings = {
            "url": `${url}/api/get_tokens/`,
            "method": "POST",
            "timeout": 0,
            "enctype": 'multipart/form-data',
            "headers": {
              "Content-Type": "application/json",
            },
            "data": data,
            beforeSend: function () {
                $("#submit").addClass("d-none");
                $("#submit-load").removeClass("d-none");
            },
            error: function(xhr, status, error){
                $('#login-form').find('input').attr('disabled', false).css('opacity',1);
                $("#submit-load").addClass("d-none");
                $("#submit").removeClass("d-none");
                if (xhr.status == 401) {
                    let json = JSON.parse(xhr.responseText);
                    for(var field in json){
                      toastr.options.timeOut =3000;
                        toastr.error(json[field]);
                    }         
                } else {
                    toastr.error("Something went Wrong Try again..");
                }
            } 
          };
          let remeber = false;  
          let res;
          var userdata; 

          $.ajax(settings).done(function (response) {
            
            $("#submit-load").addClass("d-none");
            $("#submit").removeClass("d-none");
            console.log(response);
            localStorage.setItem('access',response.access);
            
            res = parseJwt(response.access);
            localStorage.setItem("id",res.user_id);
            if($('#remeber').is(':checked')){
                remeber = true;
            }
            console.log(res);
            $.ajax({
              url: `${url}/api/get_user/${res.user_id}/`,
              type: 'GET',
              headers:{
                "Authorization":`Bearer ${response.access}`
              },
              dataType: 'json',
              success: function (userdata) {
                $.ajax({
                  url: './include/session.php',
                  type: 'POST',
                  data: {
                    id: res.user_id,
                    refresh_token: response.refresh,
                    remeber: remeber,
                    userData: userdata
                  },
                  dataType: 'json',
                  success: function (response) {
                    console.log(response);
                    if (response.success) {
                      location.href = "./find.php";
                    }                
                  },
                  error: function (errors) { 
                    console.log(errors);
                   }
                });
              },
              error: function (errors) { 
                console.log(errors);
               }
            });
            console.log(userdata);
            
          });
          
    }
    //Adding a New Book
    function AddBook(data) {
      var settings = {
        "url": `${url}/api/`,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem('access')}`,
          "Content-Type": "application/json"
        },
        "data": data,
        beforeSend: function () {
          $("#submit").addClass("d-none");
          $("#submit-load").removeClass("d-none");
        },
        error: function(xhr, status, error){
            $("#submit-load").addClass("d-none");
            $("#submit").removeClass("d-none");
            $("#book-form").find('input').attr('disabled', false).css('opacity',1);
            if (xhr.status == 400) {
                let json = JSON.parse(xhr.responseText);
                for(var field in json){
                    toastr.error(json[field][0]);
                }         
            } else {
                console.log("Something went Wrong Try again..");
            }
      }
      };
      $.ajax(settings).done(function (response) {
        $("#submit-load").addClass("d-none");
        $("#submit").removeClass("d-none");
        $("#book-form").find('input').attr('disabled', false).css('opacity',1);
        $("#book-form")[0].reset();
        toastr.success('Book Added!', 'Success');
        console.log(response);
      });
    }
    //Listing All the Books
    function LoadBooks(favouritePage) {
      var settings = {
        "url": `${url}/api/`,
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem('access')}`
        },
          error: function(xhr, status, error){
            if (xhr.status == 401) {
                let json = JSON.parse(xhr.responseText);
                for(var field in json){
                  toastr.options.timeOut =3000;
                    toastr.error(json[field]);
                }         
            } else {
                toastr.error("Something went Wrong Try again..");
            }
        },
        beforeSend: function () { 
          $("#books-list").html(BookLoading());
        }, 
      };
      $.ajax(settings).done(function (response) {
        finalhtml = RenderBooks(response,favouritePage);
        if (finalhtml != "") {
          $("#books-list").html(finalhtml);
          $("#no-books").addClass("d-none");
        }else{
          if (favouritePage) {
            $("#books-list").html(placeholder("No Books Added to Favourite!"));
          } else {
            $("#books-list").html(placeholder("Add Books To View Here..."));
          }
          
        }
        
      });
      isfavpage = favouritePage;
    }
    window.LoadBooks = LoadBooks;
    //search a book
    function SearchBook(keyword) {
      var settings = {
        "url": `${url}/api/search/?search=${keyword}`,
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`
        },
        beforeSend: function () { 
          $(".spinsearch").removeClass("d-none");
          $(".searchbtn").addClass("d-none");
        }, 
      };
      
      $.ajax(settings).done(function (response) {
        finalhtml = RenderBooks(response,false);
        $(".spinsearch").addClass("d-none");
        $(".searchbtn").removeClass("d-none");
        if (finalhtml != "") {
          $("#books-list").html(finalhtml);
          $("#no-books").addClass("d-none");
        }else{
            $("#books-list").html(placeholder("Book Not Found  :-("));  
        }
      });
    }
    //Delete a Book
    function DeleteBook(id) {
      var settings = {
        "url": `${url}/api/${id}`,
        "method": "DELETE",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem('access')}`
        },
        beforeSend: function () {
          
          $("#delete-load").removeClass("d-none");
        },
        error: function (xhr,error) { 
          console.log(xhr);
        },
      };
      
      $.ajax(settings).done(function (response) {
        console.log(response);
        $("#delete-load").addClass("d-none");
        $("#deletebookConfirm").removeClass("d-none");   
        $(`span[data-id="${id}"]`).parent().parent().parent().remove();
        
        $("#deleteModal .close").click();
        if($(`span[data-id]`).length === 0){
          if(isfavpage){
            $("#books-list").html(placeholder("No Books Added to Favourite!"));
          }else{
            $("#books-list").html(placeholder("Add Books To View Here..."));
          }
          
        }
        toastr.success('Success', 'Deleted Succesfully');

        
      });
    }
    //update book
    function UpdateBook(id,name,author,book_location,book_color) {
      var settings = {
        "url": `${url}/api/${id}/`,
        "method": "PUT",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`,
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "name": name,
          "author": author,
          "book_location": book_location,
          "book_color": book_color
        }),
        beforeSend: function(){
          $("#updateconfirm").addClass("d-none");
          $("#update-load").removeClass("d-none");
        }
      };
      
      $.ajax(settings).done(function (response) {
        $("#update-load").addClass("d-none");
        $("#updateconfirm").removeClass("d-none");
        toastr.success("success","Book Updated Successfully!");
        $(`#${id}`).html(CardUpdate(response));

      });
    }
    //Find Book using PI
    function LightOn(id){
      var settings = {
        "url": `${url}/api/light-on/${id}/`,
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`
        },
      };
      
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
    }

    function LightOff(id){
      var settings = {
        "url": `${url}/api/light-off/${id}/`,
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`
        },
      };
      
      $.ajax(settings).done(function (response) {
        console.log(response);
      });
    }
    //refresh token
    function RefreshToken(){
      $.ajax({
        "url": "./include/session.php",
        "method":"GET",
        "dataType":"json",
        "data": {"gettoken":"gettoken"},
        success : function(response){
          var settings = {
            "url": `${url}/api/refresh_token/`,
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Authorization": `Bearer ${localStorage.getItem("access")}`,
              "Content-Type": "application/json"
            },
            "data": JSON.stringify({
              "refresh": `${response.refresh}`
            }),
          };
          $.ajax(settings).done(function (response) {
            localStorage.setItem("access",response.access);
            $.ajax({
              "url": "./include/session.php",
              "method":"POST",
              "data": {"refresh_token":`${response.refresh}`},
              success: function(response){
                console.log(response)
              },
            });
          });

        }


      });
    }
    window.RefreshToken = RefreshToken;
    //add favourite
    function addfav(id,obj,fav){
      var settings = {
        "url": `${url}/api/${id}/`,
        "method": "PUT",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`,
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
        "isfav": !fav
        }),
        beforeSend: function () { 
          obj.children("i").eq(0).addClass("d-none");
          obj.children('div').eq(0).removeClass("d-none");

        }
      };
      
      $.ajax(settings).done(function (response) {
        obj.children('div').eq(0).addClass("d-none");
        if(response.isfav){
          obj.children("i").eq(0).removeClass("d-none").removeClass("fa-regular").addClass("fa-solid").attr("id","star");
        }else{
          obj.children("i").eq(0).removeClass("d-none").removeClass("fa-solid").addClass("fa-regular").removeAttr("id");
        } 
        if(isfavpage){
          obj.parent().parent().parent().remove();
          if($(`span[data-id]`).length === 0){
            $("#books-list").html(placeholder("No Books Added to Favourite!"));
          }
        }       
        
      });
    }
    
    function GetUser() {
      $.ajax({
        url:`./include/session.php`,
        method:"GET",
        data: {
          userdata:"userdata"
        },
        success: function(response){
          out = JSON.parse(response)
          $("input[name='first_name']").val(out.userData.first_name);
          $("input[name='last_name']").val(out.userData.last_name);
          $("input[name='email']").val(out.userData.email);
          $("input[name='username']").val(out.userData.username);

        }
      });
    }
    window.GetUser = GetUser;
    function UpdateUser(data) {

      var settings = {
        "url": `${url}/api/update_user/${localStorage.getItem("id")}/`,
        "method": "PATCH",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`,
          "Content-Type": "application/json"
        },
        "data": data,
        beforeSend: function () { 
          $("#submit").addClass("d-none");
          $("#submit-load").removeClass("d-none");
        },
        error: function(xhr, status, error){
          $("#submit-load").addClass("d-none");
          $("#submit").removeClass("d-none");
          $("#update-form").find('input').attr('disabled', false).css('opacity',1);
          if (xhr.status == 400) {
              let json = JSON.parse(xhr.responseText);
              for(var field in json){
                  toastr.error(json[field][0]);
              }         
          } else {
              console.log("Something went Wrong Try again..");
          }
          setTimeout(function () { 
            GetUser();
          },1000)
      }
      };
      $.ajax(settings).done(function (response) {
        $("#update-form").find('input').attr('disabled', false).css('opacity',1);
        $("#submit-load").addClass("d-none");
        $("#submit").removeClass("d-none");
        $("input[name='first_name']").val(response.first_name);
        $("input[name='last_name']").val(response.last_name);
        $("input[name='email']").val(response.email);
        $("input[name='username']").val(response.username);
        toastr.success("Updated Successfully!","Success");
        $.ajax({
          url:`./include/session.php`,
          method:"POST",
          data: {
            userData:response
          },
          success: function(res){
            $("a[href='profile.php']").html(response.username);
          }
        });
      });
    }
    function DeleteUser() {
      var settings = {
        "url": `${url}/api/delete_user/${localStorage.getItem("id")}/`,
        "method": "DELETE",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`
        },
        beforeSend: function () { 
          $("#deleteAccount").addClass("d-none");
          $("#delete-load").removeClass("d-none");
        },
        error: function(xhr, status, error){
          $("#delete-load").addClass("d-none");
          $("#deleteAccount").removeClass("d-none");
          if (xhr.status == 400) {
              let json = JSON.parse(xhr.responseText);
              for(var field in json){
                  toastr.error(json[field][0]);
              }         
          } else {
              console.log("Something went Wrong Try again..");
          }
        }
      };
      $.ajax(settings).done(function (response) {
        $("#delete-load").addClass("d-none");
        $("#deleteAccount").removeClass("d-none");
        location.href = "./logout.php"
      });
    }
    function ChangePassword(data) {
      var settings = {
        "url": `${url}/api/password-change/`,
        "method": "PATCH",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`,
          "Content-Type": "application/json"
        },
        "data": data,
        beforeSend: function () { 
          $("#submit").addClass("d-none");
          $("#submit-load").removeClass("d-none");
        },
        error: function (xhr,error) {
          $("#submit-load").addClass("d-none");
          $("#submit").removeClass("d-none");
          $("#changepass-form").find('input').attr('disabled', false).css('opacity',1);
          if (xhr.status == 401) {
              let json = JSON.parse(xhr.responseText);
              for(var field in json){
                  toastr.error(json[field]);
              }         
          } else {
              console.log("Something went Wrong Try again..");
          }
        }
      };
      
      $.ajax(settings).done(function (response) {
        $("#submit-load").addClass("d-none");
        $("#submit").removeClass("d-none");
        $("#changepass-form").find('input').attr('disabled', false).css('opacity',1);
        toastr.success("Updated Successfully!","Password Updated Successfully!");

      });
    }

    function ForgotPasswordAndActivate(data) {
      var settings = {
        "url": `${url}/api/forgot-password/`,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": data,
        beforeSend: function () { 
          $("#submit").addClass("d-none");
          $("#submit-load").removeClass("d-none");
        },
        error: function (xhr,error) {
          $("#submit-load").addClass("d-none");
          $("#submit").removeClass("d-none");
          $("#reset-form").find('input').attr('disabled', false).css('opacity',1);
          if (xhr.status == 400) {
              let json = JSON.parse(xhr.responseText);
              for(var field in json){
                  toastr.error(json[field][0]);
              }         
          } else {
              console.log("Something went Wrong Try again..");
          }
        }
      };
      
      $.ajax(settings).done(function (response) {
        $("#submit-load").addClass("d-none");
        $("#submit").removeClass("d-none");
        $(".sucess-mail").removeClass("d-none");
        $("#reset-body").addClass("d-none");
        toastr.info("Please check you Email Inbox");
      });
      
    }
    //****All Ajax Functions Implementation End****

    //Click Events Start

    //Delete Book
    $("body").on('click','.deletebook',function () { 
      let id = $(this).data("id");
      $("#deletebookConfirm").attr("data-id",id);
    });
    $("body").on('click','#deletebookConfirm',function () { 
      let id = $(this).attr('data-id');
      $(this).addClass("d-none");
      DeleteBook(id);
    });

    $("body").on('click','#deleteAccount',function () { 
      $("#deleteUserModal").modal("show");
    });
    $("body").on('click','#deleteUserConfirm',function () { 
      $("#deleteUserModal").modal("hide");
      DeleteUser();
    });


    $("body").on('click','.updatebook',function () { 
      let id = $(this).data("id");
      $("#updateconfirm").attr("data-id",id);
      var settings = {
        "url": `${url}/api/${id}`,
        "method": "GET",
        "timeout": 0,
        "headers": {
          "Authorization": `Bearer ${localStorage.getItem("access")}`
        },
        beforeSend: function(){
          $("div[id=editspinner]").removeClass("d-none");
        }
      };
      $.ajax(settings).done(function (response) {
        $("div[id=editspinner]").addClass("d-none");
        $("input[name=name]").val(response.name);
        $("input[name=author]").val(response.author);
        $("input[name=book_location]").val(response.book_location);
        $("input[name=book_color]").val(response.book_color);
        $("input[name=name]").next().remove("p");
        $("input[name=author]").next().remove("p");
      });
    });
    $("body").on('click','#updateconfirm',function () { 
      let id = $(this).attr('data-id');
      let name = $("input[name=name]").val();
      let author = $("input[name=author]").val();
      let book_location =  $("input[name=book_location]").val();
      let book_color = $("input[name=book_color]").val();
      $("input[name='name']").next().remove("p");
      $("input[name='author']").next().remove("p");
      let con1 = con2 = true;
      if(name.length<3 || !isNaN(name)){
        console.log("called")
        $("<p>At least 3 characters and No numbers</p>").insertAfter($("input[name='name']")).css("color","red");
        con1 = false;
      }
      if(author.length<3 || !isNaN(author)){
        console.log(author);
        $("<p>At least 3 characters and No numbers</p>").insertAfter($("input[name='author']")).css("color","red");
        con2 = false;
      }
      if(con1 && con2){
        UpdateBook(id,name,author,book_location,book_color); 
      }
        
    });

    $("body").on('click','.addfav',function () { 
      let id = $(this).attr('data-id');
      let fav = ($(this).attr('data-fav') === 'true');
      var obj = $(this);
      $(this).attr("data-fav",(!fav).toString());
      addfav(id,obj,fav);
      
      
    });
    $("body").on('keyup',"#search_book",function () { 
      var input = $(this).val();
      if(input != ""){
        SearchBook(input);
      }else{
        LoadBooks(false);
      }
    });

    $("body").on('click',".searchbtn",function () { 
      var input = $(this).val();
      if(input != ""){
        SearchBook(input);
      }else{
        LoadBooks(false);
      }
    });


    $("body").on("click","#bulb-on",function () {
      let dataid = $(this).attr("data-id"); 
      localStorage.setItem(`bulb-${dataid}`,false)
      $(this).addClass("d-none");
      $("#bulb-off").removeClass("d-none");
      LightOff(dataid);
    });

    $("body").on("click","#bulb-off",function () {
      let dataid = $(this).attr("data-id");
      localStorage.setItem(`bulb-${dataid}`,true)
      $(this).addClass("d-none");
      $("#bulb-on").removeClass("d-none");
      LightOn(dataid);
    });


    $("body").on('click','.findbook',function () { 
      let id = $(this).attr("data-id");
      console.log(localStorage.getItem(`bulb-${id}`))
      if (localStorage.getItem(`bulb-${id}`) === "true") {
        $("#bulb-on").removeClass("d-none");
        $("#bulb-off").addClass("d-none");
      }else{
        $("#bulb-on").addClass("d-none");
        $("#bulb-off").removeClass("d-none");
      }
      $("#bulb-on").attr("data-id",id);
      $("#bulb-off").attr("data-id",id);
    });




    //Click Events End

    //Forms Submit Start 

    $('#register-form').submit(function(e){ e.preventDefault(); }).validate({
        rules:{
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            email:{
                required: true,
                email: true
            },
            username:{
                required: true,
                minlength: 3
            },
            password:{
                required: true,
                minlength: 6
            },
            confirm_password:{
                required: true,
                minlength: 6,
                equalTo: '#password'
            }
        },
        messages: {
            first_name: {
                required: 'Please enter your first name'
            },
            last_name: {
                required: 'Please enter your last name'
            },
            email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address'
            },
            username: {
                required: 'Please enter a username',
                minlength: 'Your username must be at least 3 characters long'
            },
            password: {
              required: 'Please enter a password',
              minlength: 'Your password must be at least 6 characters long'
            },
            confirm_password: {
              required: 'Please confirm your password',
              minlength: 'Your password must be at least 6 characters long',
              equalTo: 'The passwords do not match'
            }
        },
        errorPlacement: function(error, element) {
              error.insertAfter(element).css("color","red");
        },
        submitHandler: function (form) {
            var formData = $(form).serializeArray();
            
            var formattedData = formData.reduce(function(acc, field) {
                acc[field.name] = field.value;
                return acc;
              }, {});
            var JSONformdata = JSON.stringify(formattedData);
            Register(JSONformdata);
            $(form).find('input').attr('disabled', true).css('opacity',0.5);
            return false;
        }
    });
    $('#login-form').submit(function(e){ e.preventDefault(); }).validate({
        rules: {
          username: {
            required: true,
            minlength: 3
          },
          password: {
            required: true,
            minlength: 6
          }
        },
        messages: {
          username: {
            required: 'Please enter a username',
            minlength: 'Your username must be at least 3 characters long'
          },
          password: {
            required: 'Please enter a password',
            minlength: 'Your password must be at least 6 characters long'
          }
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element).css("color","red");
        },
        submitHandler: function(form) {
            var formData = $(form).serializeArray();
            console.log(formData);
            var formattedData = formData.reduce(function(acc, field) {
                acc[field.name] = field.value;
                return acc;
              }, {});
            var JSONformdata = JSON.stringify(formattedData);
            Login(JSONformdata);
            $(form).find('input').attr('disabled', true).css('opacity',0.5);
            return false;
        }
    });
    $('#book-form').submit(function(e){ e.preventDefault(); }).validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        author: {
          required: true,
          minlength: 3
        },
        book_location:{
          required: true,
          number: true
        },
        book_color:{
          required: true,
        },

      },
      messages: {
        name: {
          required: 'Please enter a Book Name',
          minlength: 'Book Name must be at least 3 characters long'
        },
        author: {
          required: 'Please enter The Author Name',
          minlength: 'Author Name must be at least 3 characters long'
        },
        book_location:{
          required: 'Provide a Integer value',
          number: 'Please enter a valid integer'     
        },
        book_color:{
          required: 'Please select a color',
          minlength: 'color name must be in hexadecimal format'
        }

      },
      errorPlacement: function(error, element) {
          error.insertAfter(element).css("color","red");
      },
      submitHandler: function(form) {
          var formData = $(form).serializeArray();
          console.log(formData);
          var formattedData = formData.reduce(function(acc, field) {
              acc[field.name] = field.value;
              return acc;
            }, {});
          var JSONformdata = JSON.stringify(formattedData);
          AddBook(JSONformdata);
          console.log(JSONformdata);
          $(form).find('input').attr('disabled', true).css('opacity',0.5);
          return false;
      }
    });
    $('#update-form').submit(function(e){ e.preventDefault(); }).validate({
      rules:{
          first_name: {
              required: true,
              minlength: 2
          },
          last_name: {
              required: true,
              minlength: 2
          },
          email:{
              required: true,
              email: true
          },
          username:{
              required: true,
              minlength: 3
          },
      },
      messages: {
          first_name: {
              required: 'Please enter your first name'
          },
          last_name: {
              required: 'Please enter your last name'
          },
          email: {
              required: 'Please enter your email address',
              email: 'Please enter a valid email address'
          },
          username: {
              required: 'Please enter a username',
              minlength: 'Your username must be at least 3 characters long'
          },
      },
      errorPlacement: function(error, element) {
            error.insertAfter(element).css("color","red");
      },
      submitHandler: function (form) {
          var formData = $(form).serializeArray();
          
          var formattedData = formData.reduce(function(acc, field) {
              acc[field.name] = field.value;
              return acc;
            }, {});
          var JSONformdata = JSON.stringify(formattedData);
          UpdateUser(JSONformdata);
          $(form).find('input').attr('disabled', true).css('opacity',0.5);
          return false;
      }
    });
    $('#reset-form').submit(function(e){ e.preventDefault(); }).validate({
      rules:{
        email: {
          required: true,
          email: true
          },
      },
      messages: {
        email: {
          required: 'Please enter your email address',
          email: 'Please enter a valid email address'
        },
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element).css("color","red");
      },
      submitHandler: function (form) {
        var formData = $(form).serializeArray();
        var formattedData = formData.reduce(function(acc, field) {
            acc[field.name] = field.value;
            return acc;
          }, {});
        if($(form).attr('class')=="activation-form"){
          formattedData.action = 'verify'
        }else{
          formattedData.action = 'reset' 
        }
        var JSONformdata = JSON.stringify(formattedData);
        ForgotPasswordAndActivate(JSONformdata);
        $(form).find('input').attr('disabled', true).css('opacity',0.5);
        return false;
      }


    });
    $('#changepass-form').submit(function(e){ e.preventDefault(); }).validate({
      rules:{
        old_password: {
          required: true,
          minlength: 6
          },
          password:{
            required: true,
            minlength: 6
          },
          confirm_password:{
            required: true,
            minlength: 6,
            equalTo: '#password'
          },
      },
      messages: {
        old_password: {
          required: 'Please enter your old password',
          minlength: 'Your old password must be at least 6 characters long'
        },
        password:{
          required: 'Please enter your New password',
          minlength: 'Your new password must be at least 6 characters long'
        },
        confirm_password:{
          required: 'Please enter your old password',
          minlength: 'Your password must be at least 6 characters long',
          equalTo: 'The passwords do not match'
        },
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element).css("color","red");
      },
      submitHandler: function (form) {
        var formData = $(form).serializeArray();
            var formattedData = formData.reduce(function(acc, field) {
                acc[field.name] = field.value;
                return acc;
              }, {});
        var JSONformdata = JSON.stringify(formattedData);
        ChangePassword(JSONformdata);
        $(form).find('input').attr('disabled', true).css('opacity',0.5);
        return false;
      }


    });

    //Forms submit End
});


