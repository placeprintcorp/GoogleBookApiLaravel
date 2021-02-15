    <nav id="navbar" class="navbar navbar-expand-lg navbar-header p-0 navbar-light">
            <div class="navbar-container container">
                <!-- LOGO -->
                <div class="navbar-brand">
                    <a class="navbar-brand-logo" href="#top">
                        <img width="175" src="{{url('images/logo.png')}}">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
 
                    <ul class="navbar-nav menu-navbar-nav">
                    <li class="nav-item"> <a class="nav-link" title="index" href="{{url('/')}}"> Home </a> </li>
                        
                    </ul>
                    <ul class="navbar-nav menu-nav-action">
                        @if(isset(auth()->user()->id))
                        <li class="nav-item">
                            <a class="nav-link create-account-btn btn-custom" href="{{ route('logout') }}">Logout</a>
                        </li>
                       @else
                         <li class="nav-item">
                            <a class="nav-link create-account-btn btn-custom" href="{{ route('register') }}">Create Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link login-btn btn-custom" href="{{ route('login') }}"> Login</a>
                        </li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </nav>