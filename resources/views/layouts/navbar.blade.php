<nav class="navbar navbar-expand-lg navbar_custom navbar-dark bg-dark">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand navbar_logo" href="#">
            <img src="{{asset('image/logo.png')}}" alt="Logo">
        </a>


        <!-- Navbar toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav links_web">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reciters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>

            <!-- Sign In and Sign Up Links on the Right -->
            <ul class="navbar-nav ml-auto links_login">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn_sm_custom btn_sm_custom_one" href="#">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn_sm_custom btn_sm_custom_two" href="#">Sign Up</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

