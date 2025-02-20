<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabric Lagbe</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
            background-image: url('{{asset('/frontend/photos/bg.jpeg')}}'); /* Set the image as background */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .logo {
            margin-bottom: 20px;
            transform: translateX(-300px); /* Move logo to the left by 300px */
        }

        .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            align-items: flex-start; /* Align items at the start of the container */
            transform: translateX(-300px); /* Move container to the left by 300px */
        }

        .box {
            width: 45%;
            margin: 20px;
            padding: 20px;
            border: 2px solid #ce5353; /* light red solid border */
            border-radius: 20px; /* rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            transition: box-shadow 0.3s; /* smooth transition for box-shadow on hover */
            text-align: center; /* Center the text content */
            background-color: white; /* Add a background color to boxes */
        }

        .box:hover {
            box-shadow: 0 0 55px rgba(29, 110, 35, 1); /* hover effect with a stronger shadow */
        }

        .box h1, .box p {
            color: #2e3b2e; /* light green text color */
        }

        @media (max-width: 768px) {
            .logo,
            .container {
                transform: none; /* Remove the left translation */
                margin-left: 20px; /* Add margin for centering on small screens */
            }

            .box {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="logo">
    <!-- Your logo goes here -->
    <img src="{{asset('frontend/logo.png')}}" alt="Logo">
</div>

<div class="container">
    
    <div class="box">
        
        <a href="{{ route('index2') }}">
            <h1>Fabric Lagbe Wholesale(B2B)</h1>
        </a>
        <p>Enter to buy products in bulk amount and bid options</p>
    </div>

    <div class="box">
        <a href="https://fabriclagbe.shop/">
            <h1>Fabric Lagbe Retail <br> (B2C)</h1>
        </a>
        <p>Enter to buy products in retail price and amount</p>
    </div>
</div>

</body>
</html>
