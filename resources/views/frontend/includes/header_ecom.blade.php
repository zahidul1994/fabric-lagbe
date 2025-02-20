<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>

<body>

    <style>
        .flex-item {
            width: 20%;
            padding: 10px;
        }

        .full-width-video {
            width: 100%;
            height: 90vh;
            opacity: 0.8;
        }


        .responsive {
            width: 50px;
            height: auto;
            margin: 20px 20px;

        }

        .signInButton {

            background-color: #498f4c;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 20px 20px;
            cursor: pointer;
            border-radius: 16px;
        }


        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .buttonss {
            display: inline-block;
            margin: 4px 2px;
            background-color: #ffffff;
            font-size: 14px;
            padding-left: 32px;
            padding-right: 32px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            color: rgb(0, 0, 0);
            text-decoration: none;
            cursor: pointer;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .button:hover {
            transition-duration: 0.4s;
            -moz-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
            background-color: white;
            color: black;
        }

        .search-container {
            position: relative;
            display: inline-block;
            margin: 4px 2px;
            height: 50px;
            width: 50px;
            vertical-align: bottom;
        }

        .mglass {
            display: inline-block;
            pointer-events: none;
            -webkit-transform: rotate(-45deg) scale(2.5);
            -moz-transform: rotate(-45deg) scale(2.5);
            -o-transform: rotate(-45deg) scale(2.5);
            -ms-transform: rotate(-45deg) scale(2.5);
            margin: 0px 10px;
        }

        .searchbutton {
            position: absolute;
            font-size: 25px;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .search:focus+.searchbutton {
            transition-duration: 0.6s;
            -moz-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
            background-color: rgb(255, 255, 255);
            color: black;

        }

        .search {
            position: absolute;
            right: 49px;
            /* Button width-1px (Not 50px/100% because that will sometimes show a 1px line between the search box and button) */
            background-color: rgb(182, 177, 177);
            border-radius: 25px;
            outline: none;
            border: 1px;
            padding: 0;
            width: 0;
            height: 100%;
            z-index: 10;
            transition-duration: 0.4s;
            -moz-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
        }

        .search:focus {
            width: 363px;
            /* Bar width+1px */
            padding: 0 16px 0 0;
        }

        .expandright {
            left: auto;
            right: 49px;
            /* Button width-1px */
        }

        .expandright:focus {
            padding: 0 0 0 16px;
        }

        .testshadow {
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 5px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
            box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.5);
            transition: box-shadow 0.3s ease-in-out;
            width: 300px;
            height: 100px;
        }

        .testshadow:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        }

        .div_cat {
            width: 50%;
            text-align: left;
            margin: 0;
            padding: 0;

        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
            display: none;


        }

      


        /* for partner image */
       /* Container to hold the marquee content */
.marquee-container {
    width: 100%;
    overflow: hidden;
}

/* Content inside the container */
.marquee-content {
    display: inline-block;
    white-space: nowrap;
    animation: marquee-animation 20s linear infinite; /* Adjust the animation duration as needed */
}

/* Animation to move the content from left to right */
@keyframes marquee-animation {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-100%);
    }
}

/* Additional styling for the images */
.partnerImage {
    margin: 0 10px; /* Add some spacing between the images */
    border-radius: 20px;
}



    </style>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="" width="180" height="100">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-brand dropdown-toggle active" href="#" id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Home
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('about-us') }}">About us</a>
                        <a class="dropdown-item" href="{{ route('contact-us') }}">Contact us</a>

                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link navbar-brand dropdown-toggle active" href="#" id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('products.category', 'fabrics-UzVmS') }}">Woven</a>
                        <a class="dropdown-item" href="{{ route('products.category', 'handloom-products-WwGiT') }}">Handmade</a>
                        <a class="dropdown-item" href="{{ route('products.category', 'readymade-garments') }}">RMG</a>
                        <a class="dropdown-item" href="{{ route('suggestion.search', 'yarn') }}">Yarn</a>


                    </div>
                </li>
             

                <li class="nav-item">
                    <a class="nav-link navbar-brand active" href="{{ route('blog') }}">Blog</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link navbar-brand active" href="https://fabriclagbe.taplink.ws/">Process</a>
                </li>
            </ul>
            <!-- for search -->
            <div class="search-container">
                <form action="/search" method="get">
                    <input class="search" id="searchleft" type="search" name="q" placeholder="Search">
                    <label class="buttonss searchbutton" for="searchleft"><span class="mglass">&#9906;</span></label>
                </form>
            </div>
            <!-- for search -->
            <img src="{{ asset('frontend/images/shopping-cart.png') }}" class="responsive" alt="">
            <a href="{{ route('login') }}" class="button signInButton">Sign In</a>
        </div>
    </nav>


    <video class="full-width-video" preload="true" autoplay loop muted>
        <source src="{{ asset('uploads/ecom.mp4') }}" type="video/mp4">

        Your browser does not support the video tag.
    </video>
    <div class="container">
    <div class="marquee-container">
        <div class="marquee-content">
           

            @foreach ($priority_buyers as $priority_buyer)
                <a href="#"></a><img src="{{ url($priority_buyer->image) }}" alt="" width="128"
                height="78" class="partnerImage">
            @endforeach
        </div>
    </div>
</div>
    

    <div>

    </div>



</body>

</html>
