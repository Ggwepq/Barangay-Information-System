<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Links -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <a href="#" class="logo"> <i class="fas fa-shopping-basket"></i> Barangay 73 </a>

        <!-- <nav class="navbar"> -->
        <!--     <a href="#Home">home</a> -->
        <!--     <a href="#features">features</a> -->
        <!--     <a href="#products">products</a> -->
        <!--     <a href="#categories">categories</a> -->
        <!--     <a href="#review">review</a> -->
        <!--     <a href="#blogs">blogs</a> -->
        <!-- </nav> -->

        <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>

            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->userRole == 1)
                        <a href="{{ route('home') }}" id="login-btn"><i class="fas fa-user"></i>
                            Home</a>
                    @else
                        <a href="{{ route('user-home') }}" id="login-btn"><i class="fas fa-user"></i>
                            Home</a>
                    @endif
                @else
                    <a href="{{ route('login') }}"id="login-btn"><i class="fas fa-user"></i> Login</a>

                    <!-- @if (Route::has('register'))
    -->
                    <!--     <a href="{{ route('register') }}" id="login-btn"><i class="fas fa-user"></i> -->
                    <!--         Register</a> -->
                    <!--
    @endif -->
                @endauth
        </div>
        @endif
        </div>

        <form action="" class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </form>

        <div class="shopping-cart">
            <div class="box">
                <i class="fas fa-trash"></i>
                <img src="image/cart-img-1.png" alt="">
                <div class="content">
                    <h3>Water
                    </h3>
                    <span class="price">$4.99/-</span>
                    <span class="quantity">qty : 1</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-trash"></i>
                <img src="image/cart-img-2.png" alt="">
                <div class="content">
                    <h3> 🥪 bread </h3>
                    <span class="price">$4.99/-</span>
                    <span class="quantity">qty : 1</span>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-trash"></i>
                <img src="image/cart-img-3.png" alt="">
                <div class="content">
                    <h3> juice </h3>
                    <span class="price">$4.99/-</span>
                    <span class="quantity">qty : 1</span>
                </div>
            </div>
            <div class="total"> total : $19.69/- </div>
            <a href="#" class="btn">checkout</a>
        </div>

        <form action="" class="login-form">
            <h3>login now</h3>
            <input type="email" placeholder="Email" class="box">
            <input type="password" placeholder="Password" class="box">
            <p>forget your password <a href="#">click here</a></p>
            <p>don't have an account <a href="#">create now</a></p>
            <input type="submit" value="login now" class="btn">
        </form>

    </header>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="content">
            <h3><span>SAD </span>Progress Report</h3>
            <p>Barangay Information System Progress Report</p>
        </div>

    </section>

    <!-- home section ends -->


    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>
