    <!--========== Header ==============-->
    <header id="gen-header" class="gen-header-style-1 gen-has-sticky">
        <div class="gen-bottom-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="/">
                                <img class="img-fluid logo" src="/images/logo-1.png" alt="streamlab-image">
                            </a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div id="gen-menu-contain" class="gen-menu-contain">
                                    <ul id="gen-main-menu" class="navbar-nav ml-auto">
                                        <li class="menu-item">
                                            <a href="/" aria-current="page">Home</a>
                                        </li>
                                        <li class="menu-item d-md-none">
                                                <form role="search" method="get" class="search-form" action="/search">
                                                    <label>
                                                        <span class="screen-reader-text"></span>
                                                        <input type="search" class="search-field" placeholder="Search …"
                                                            value="" name="s">
                                                    </label>
                                                    <button type="submit" class="search-submit"><span
                                                            class="screen-reader-text"></span></button>
                                                </form>
                                        </li>
                                        <li class="menu-item d-md-none">
                                            <a href="/dashboard" aria-current="page">Dashboard</a>
                                        </li>
                                        <li class="menu-item d-md-none">
                                            <a href="/logout" aria-current="page">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="gen-header-info-box">
                                <div class="gen-menu-search-block">
                                    <a href="javascript:void(0)" id="gen-seacrh-btn"><i class="fa fa-search"></i></a>
                                    <div class="gen-search-form">
                                        <form role="search" method="get" class="search-form" action="/search">
                                            <label>
                                                <span class="screen-reader-text"></span>
                                                <input type="search" class="search-field" placeholder="Search …"
                                                    value="" name="s">
                                            </label>
                                            <button type="submit" class="search-submit"><span
                                                    class="screen-reader-text"></span></button>
                                        </form>
                                    </div>
                                </div>
                                @auth
                                <div class="me-3 text-danger">{{ Auth::user()->name }}</div>
                                @endauth
                                <div class="gen-account-holder">
                                    <a href="javascript:void(0)" id="gen-user-btn"><i class="fa fa-user"></i></a>
                                    <div class="gen-account-menu">
                                        <ul class="gen-account-menu">
                                            <!-- Pms Menu -->
                                            @auth
                                            <li>
                                                <a href="/dashboard">
                                                    <i class="fa fa-indent"></i>
                                                    Dashboard </a>
                                            </li>
                                            <li>
                                                <a href="/logout"><i class="fa fa-sign-out-alt"></i>
                                                    Logout </a>
                                            </li>
                                            @else
                                            <li>
                                                <a href="/login"><i class="fas fa-sign-in-alt"></i>
                                                    login </a>
                                                </li>
                                                <li>
                                                    <a href="/register"><i class="fa fa-user"></i>
                                                        Register </a>
                                                    </li>

                                            @endauth
                                            <!-- Library Menu -->
                                        </ul>
                                    </div>
                                </div>
                                {{-- <div class="gen-btn-container">
                                    <a href="register.html" class="gen-button">
                                        <div class="gen-button-block">
                                            <span class="gen-button-line-left"></span>
                                            <span class="gen-button-text">Subscribe</span>
                                        </div>
                                    </a>
                                </div> --}}
                            </div>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-bars"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--========== Header ==============-->
