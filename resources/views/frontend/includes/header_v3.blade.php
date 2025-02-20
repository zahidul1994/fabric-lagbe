<style>
    /* Logo Styling */
    .navbar-brand img {
        height: 60px; /* Base logo height */
        width: auto; /* Maintain aspect ratio */
        margin-left: 20px; /* Move the logo to the right */
    }

    /* Search Bar Styling */
    .search-bar {
        max-width: 600px;
        margin: auto;
    }
    .search-bar .form-control, .search-bar .btn {
        border-radius: 100px; /* Rounded corners */
    }

    /* Font Family for Navbar Links */
    .navbar-nav .nav-link {
        font-family: 'Inter', sans-serif;
        font-weight: bold;
        color: #000;
    }

    /* Carousel Navigation Arrows */
    .owl-nav i {
        font-size: 2em;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .navbar-brand img {
            height: 40px; /* Smaller logo on mobile */
            margin-left: 10px; /* Adjust margin */
        }

        .search-bar {
            max-width: 100%; /* Full width on mobile */
            margin: 10px 0; /* Some vertical margin */
        }

        .navbar-collapse {
            text-align: center; /* Center the collapsed menu items */
        }

       

        .navbar-light .navbar-nav .nav-link {
            color: black !important;
        }
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('frontend/logo.png') }}" alt="Fabric Lagbe">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('getQuote') }}">Get a Quote</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('buyer.my-request.create') }}">Buy Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('job.registration.employer') }}">Become a Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog') }}">Blog & Media</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://fabriclagbe.com/job">Job Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('membership') }}">Become a member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Search Bar -->
    {{-- <div class="mt-4 search-bar">
        <form class="d-flex" action="{{ route('category.search') }}">
            <input class="form-control me-2" type="search" placeholder="What are you looking for?" aria-label="Search">
            <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div --}}

    <div class="mt-4 search-bar">
        <form class="d-flex" id="searchForm">
            <input class="form-control me-2" type="search" id="searchInput" placeholder="What are you looking for?" aria-label="Search">
            <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
    
    <a href="{{ route('suggestion.search', ':category') }}" id="searchLink"></a>
    

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
    
            var searchInput = document.getElementById('searchInput').value;
            var searchLink = document.getElementById('searchLink');
            var formAction = '{{ route('suggestion.search', ':category') }}'; // Placeholder for category
    
            // Replace the placeholder with the search input
            formAction = formAction.replace(':category', encodeURIComponent(searchInput));
    
            // Update the href attribute of the link
            searchLink.href = formAction;
    
            // Optionally, redirect to the link
            window.location.href = searchLink.href;
        });
    </script>
    