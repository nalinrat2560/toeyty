<?php
session_start(); 

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoping</title>

    <link rel="stylesheet" href="./dist/css/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./dist/js/dashboard.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    

    <nav>
        <div class="nav-container">
            <a href="dashboard.php">
                <img src="./imgs/ty.png" class="logonav">
            </a>
            <form action="logout.php" method="post" class="logout-form">
                <button type="submit" class="btn">Logout</button>
            </form>
            <div class="nav-profile">
                <p class="nav-profile-name"><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                <div onclick="openCart()" style="cursor: pointer;" class="nav-profile-cart">
                    <i class="fas fa-cart-shopping"></i>
                    <div id="cartcount" class="cartcount" style="display: none;">
                        0
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="sidebar">
            <input onkeyup="searchsomething(this)" id="txt_search" type="text" class="sidebar-search" placeholder="Search something...">
            
            <a onclick="searchproduct('all')" class="sidebar-items">
                All product
                </a>
            <a onclick="searchproduct('Notebook')" class="sidebar-items">
                Notebook
                </a>
            <a onclick="searchproduct('Keyboard')" class="sidebar-items">
                Keyboard
                </a>
            <a onclick="searchproduct('earphones')" class="sidebar-items">
                earphones
                </a>
            <a onclick="searchproduct('CaseComputer')" class="sidebar-items">
                Case Computer
                </a>
        </div>
        <div id="productlist" class="product">

            
            
        </div>
    </div>

    <div id="modalDesc" class="modal" style="display: none;">
        <div onclick="closeModal()" class="modal-bg"></div>
        <div class="modal-page">
            <h2>Detail</h2>
            <br>
            <div class="modaldesc-content">
                <img id="mdd-img" class="modaldesc-img" src="https://m.media-amazon.com/images/I/81KhtncsNAL._AC_SL1500_.jpg" alt="">
                <div class="modaldesc-detail">
                    <p id="mdd-name" style="font-size: 1.5vw;">Product name</p>
                    <p id="mdd-price" style="font-size: 1.2vw;">500 THB</p>
                    <br>
                    <p id="mdd-desc" style="color: #adadad;">Lorem iaudantium harum doloremque alias. Quae, vel ipsum quasi, voluptas, sit optio nemo magni numquam non dicta voluptates porro! Vero eveniet numquam sit aut vel eligendi officiis iste tenetur expedita. Delectus vero quibusdam adipisci in. Esse.</p>
                    <br>
                    <div class="btn-control">
                        <button onclick="closeModal()" class="btn">
                            Close
                        </button>
                        <button onclick="addtocart()" class="btn btn-buy">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCart" class="modal" style="display: none;">
        <div onclick="closeModal()" class="modal-bg"></div>
        <div class="modal-page">
            <h2>My cart</h2>
            <br>
            <div id="mycart" class="cartlist">

                
                
                
            </div>
            <div class="btn-control">
                <button onclick="closeModal()" class="btn">
                    Cancel
                </button>
                <button onclick="buynow()" class="btn btn-buy">
                    Buy
                </button>
            </div>
        </div>
    </div>
    
</body>
</html>