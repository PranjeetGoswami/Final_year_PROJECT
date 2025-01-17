<!-- PHP code -->
<?php
require 'config.php';

// Insert data into the table
if(isset($_POST['add_to_cart'])){
    $products_name=$_POST['products_name']; 
    $products_price=$_POST['products_price']; 
    $products_image=$_POST['products_image'];
    $product_quantity=1;

    //select cart data based on condition
    $select_cart = mysqli_query($conn,"Select * from `cart` where name='$products_name'");
    if(mysqli_num_rows($select_cart)>0){
        echo "<script> alert('This product is already added to cart') </script>";
    }else{
        // insert cart data in cart table
    $insert_products=mysqli_query($conn, "insert into `cart` (name, price, image, quantity) values
    ('$products_name', '$products_price', '$products_image', $product_quantity)");
    echo " <script>alert('Product is added to the cart'); </script>";
    }
}
?>

<!-- HTML Start -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Ethnic Diva - An Ecommerce Clothing Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fontawesome.com/releases/v6.m04.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
<!-- NAVBAR -->
    <section id="header">
        <a href="home.php"><img src="logo.png" alt="logo" height="50px"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>

                    <?php
                        $select_product = mysqli_query($conn,"Select * from `cart`") or die('query failed');
                        $row_count = mysqli_num_rows($select_product); 
                    ?>

                <li id="lg-bag"><a href="cart.php"><i class='bx bx-shopping-bag bag' style='color:#000000; font-size: 20px;' ></i><span><sup><?php echo $row_count; ?></sup></span></a></li>
                <li class="user"><a href="register.php"><i class="fa-solid fa-circle-user"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark" style="color: #000000; font-size: 25px;"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class='bx bx-shopping-bag' style='color:#000000' ></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

<!-- Header Shop -->
    <section id="page-header">
        <h2 data-aos="fade-up">#stayhome</h2>
        <p data-aos="fade-left">save more by using coupons & up to 70% off!</p><br>
    </section>

<!-- Shop body -->
    <section id="product1" class="section-p1">
        <div class="pro-container-1">
            <!-- Fetching data from the database -->
            <?php
                $select_products = mysqli_query($conn, "Select * from `products`");

                if(mysqli_num_rows($select_products)>0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
            ?>
        
    <div class="product" data-aos="fade-up">
        <form method="post" action="">
            <img src="images/<?php echo $fetch_product['image']; ?>" alt=""  >
            <div class="description">
                <span>GLAM Boutique</span>
                <h5><?php echo $fetch_product['name']; ?></h5>
                <div class="star">
                    <i class='bx bxs-star' style='color:#b3b318' ></i>
                    <i class='bx bxs-star' style='color:#b3b318' ></i>
                    <i class='bx bxs-star' style='color:#b3b318' ></i>
                    <i class='bx bxs-star' style='color:#b3b318' ></i>
                </div>
                <h4>₹<?php echo $fetch_product['price']; ?></h4>
                <input type="hidden" name="products_name" value="<?php echo $fetch_product['name']; ?>">
                <input type="hidden" name="products_price" value="<?php echo $fetch_product['price']; ?>">
                <input type="hidden" name="products_image" value="<?php echo $fetch_product['image']; ?>">
            </div>
            <div>
                <input type="submit" name="add_to_cart" class="submit_btn normal" value="Add to Cart">
                <input type="button" name="" class="view-d normal" value="Details" onclick="window.location.href='product-detail.php?id=<?php echo $fetch_product['id']; ?>'">
            </div>
        </form> 
    </div>
<?php
    }
}
?>    
    </div>
</section>


<!-- FOOTER -->
<footer class="section-p1">
        <div class="col">
            <img class="logo" src="logo.png" alt="logo" height="30"><br>
            <h4>Contact</h4>
            <p><b>Address:</b> 562 Wellington Road, Street 32, San Francisco</p>
            <p><b>Phone:</b>+01 2222 365/(+91)60035 16672</p>
            <p><b>Hours:</b>10:00 - 18:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a herf="#"><i class="fab fa-pinterest-p"></i></a>
                    <a herf="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="about.php">About Us</a>
            <a href="delivery.php">Delivery Information</a>
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms & Conditions</a>
            <a href="contact.php">Contact Us</a>
        </div>
        <div class="col">
        <h4>My Account</h4>
        <a href="login.php">Sign In</a>
        <a href="cart.php">View Cart</a>
        <a href="orders.php">Track My Order</a>
        <a href="help.php">Help</a>
        </div>
        <div class="col-install">
            <h4>Install App</h4>
            <p>From App Store or Google PlayStore</p>
            <div class="row">
                <img src="app.jpg">
                <img src="play.jpg">
            </div>
            <p>Secure Payment Gateways</p>
            <img src="pay.png">
        </div>
        <div class="copyright">
            <p>2024, Pranjeet etc - HTML CSS Ecommerce Tamplate</p>
        </div>
    </footer>

<!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="script.js"></script>
<!-- Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>