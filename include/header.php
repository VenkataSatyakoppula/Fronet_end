<?php include 'config.php'; 

$page = explode("/",$_SERVER['REQUEST_URI']);
    $new_page = $page[sizeof($page)-1];
    $cur_page = explode(".",$new_page)[0];
    // if(isset($_SESSION['user_id'])){
    //     var_dump($_SESSION['userData']);
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($cur_page == "index") { ?> 
        <title>Welcome | Book Shelf Project</title>
        <?php } else if ($cur_page == "login") {

        ?>
        <title>User Login</title>
        <?php } else if ($cur_page == "register") { ?>
            <title>User Registration</title>
    <?php } else if ($cur_page == "find") { ?>
        <title>Book Find</title>
        <?php }else if ($cur_page == "favourite") { ?>
            <title>Favourites</title>
        <?php } else if ($cur_page == "bookadd") {?>
            <title>New Book</title>
        <?php } else if ($cur_page == "profile") {?>
            <title>Update User</title>
        <?php } else if ($cur_page == "forgot") {?>
            <title>Reset Password</title>
        <?php } else if ($cur_page == "change_password") {?>
            <title>Change Password</title>
        <?php } else if ($cur_page == "activate") { ?>
            <title>Activate Account</title>
        <?php } ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        body{
            height: 100%;
        }
        .in-center{
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        <?php if($cur_page == "login" || $cur_page == "forgot" || $cur_page=="change_password" || $cur_page=="activate"  ){ ?>
        .custom{
            padding: 2rem;
            height: 60%;
            width: 30rem;
        }
        <?php }else if($cur_page == "register" || $cur_page == "bookadd" || $cur_page == "profile"){ ?>
        .custom{
            padding: 2rem;
            height: 60%;
            width: 30rem;
        }
        <?php }?>
            
        a{
            text-decoration: none;
            color: white;
        }
        a:hover{
            cursor: pointer;
            color: blue;
        }
        span{
            cursor: pointer;
        }
        #star{
            color: #FFC300;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
        <a href="index.php" class="navbar-brand">Book Shelf</a>
        <button 
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse" data-bs-target="#navmenu"
        > <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
        <?php  if(($cur_page == "index" || $cur_page == "") && !isset($_SESSION['user_id'])) { ?> 
            <ul class="navbar-nav ms-auto">
                
            <li class="nav-item">
                    <a href="login.php" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="nav-link">Register</a>
            </li>
        </ul>
        <?php } else if(($cur_page == "index" || $cur_page == "") && isset($_SESSION['user_id'])) { ?>
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                    <a href="find.php" class="nav-link">Find Book</a>
                </li>
            <li class="nav-item">
                    <a href="profile.php" class="nav-link"> <?php echo $_SESSION['userData']['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" style="color:red;">Logout</a>
            </li>
            </ul>
        <?php } else if($cur_page == "find") { ?>
        <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                    <a href="index.php" class="nav-link">Main Page</a>
                </li>
               <li class="nav-item">
                    <a href="favourite.php" class="nav-link">Favourites</a>
                </li>
            <li class="nav-item">
                    <a href="profile.php" class="nav-link"><?php echo $_SESSION['userData']['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" style="color:red;">Logout</a>
            </li>
            
        </ul>
        <?php } else if($cur_page == "favourite") { ?>
        <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                    <a href="index.php" class="nav-link">Main Page</a>
                </li>
        <li class="nav-item">
                    <a href="find.php" class="nav-link">Find Book</a>
                </li>
            <li class="nav-item">
                    <a href="profile.php" class="nav-link"><?php echo $_SESSION['userData']['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" style="color:red;">Logout</a>
            </li>
            
        </ul>
        <?php }else if($cur_page == "login"){ ?>
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">

                <a href="index.php" class="nav-link">Main Page</a>
            </li>
            <li class="nav-item">
                
                <a href="register.php" class="nav-link">Register</a>
            </li>
           </ul>
        <?php }else if($cur_page == "register"){ ?>
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">

                <a href="index.php" class="nav-link">Main Page</a>
            </li>
            <li class="nav-item">
                
                <a href="login.php" class="nav-link">Login</a>
            </li>
           </ul>
<?php }else if($cur_page == "bookadd"){ ?>
    <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Main Page</a>
            </li>
            <li class="nav-item">
            
                <a href="find.php" class="nav-link">Find Book</a>
            </li>
           </ul>
    <?php } else if($cur_page == "profile" || $cur_page=="change_password"){?>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Main Page</a>
            </li>
            <li class="nav-item">
                <a href="find.php" class="nav-link">Find Book</a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link"><?php echo $_SESSION['userData']['username']; ?></a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link" style="color:red;">Logout</a>
            </li>
           </ul>
           <?php } else if($cur_page == "forgot"){?>
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Main Page</a>
            </li>
            <li class="nav-item">
                <a href="login.php" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a href="register.php" class="nav-link">Register</a>
            </li>
           </ul>
            <?php }?>
        </div>
        </div>
    </nav>
    
