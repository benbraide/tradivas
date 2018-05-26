<div class="tradivas-full-header">
    <div class="container tradivas-header">
        <div class="row align-items-center">
            <div class="col-4">
                <a href="/" class="tradivas-logo">
                    <img src="{{ asset('img/image1.png') }}" alt="Site Logo">
                </a>
            </div>
            <div class="col-8">
                <div class="tradivas-top-nav">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>
                            <a href="/account" class="dropdown-toggle tradivas-drop-down" data-toggle="dropdown"
                                role="button" aria-haspopup="true" aria-expanded="false"> My Account</a>
                                @guest
                                    <div class="dropdown-menu">
                                        <form method="POST" action="/loggingin" class="px-2 py-2">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input" id="dropdownCheck" checked>
                                                <label class="form-check-label" for="dropdownCheck">Remember me</label>
                                            </div>
                                            <button type="submit" class="btn login-btn tradivas-btn">Sign in</button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/register">Don't have an account? Sign up</a>
                                        <a class="dropdown-item" href="/password">Forgot your password?</a>
                                    </div>
                                @else
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                @endguest
                        </li>
                        <li><a href="/gcerts">Gift Certificates</a></li>
                        <li>Unused</li>
                        <li><a href="cart">View Cart</a></li>
                    </ul>
                    <form method="GET" action="/search" class="form-inline float-right tradivas-nav-search">
                        @csrf
                        <div class="form-group">
                            <input type="search" class="form-control form-control-sm" name="query" placeholder="Search for a product">
                        </div>
                        <button type="submit" class="tradivas-search-icon" title="Search" data-toggle="tooltip">
                            <span class="oi oi-magnifying-glass" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container tradivas-bottom-nav">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li><a href="/new-arrivals">Just In</a></li>
                    <li><a href="/dresses">Dresses</a></li>
                    <li><a href="/sets">Sets</a></li>
                    <li><a href="/bottoms">Bottoms</a></li>
                    <li><a href="/tops">Tops</a></li>
                    <li><a href="/swim">Swim</a></li>
                    <li><a href="/accessories">Accessories</a></li>
                    <li><a href="/bags">Bags</a></li>
                    <li><a href="/shoes">Shoes</a></li>
                    <li><a href="/curvy">Curvy</a></li>
                    <li><a href="/luxxy">Luxxy</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>