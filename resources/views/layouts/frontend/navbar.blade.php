<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Rajawali<span>Rent</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ (request()->segment(1) == '') ? 'active' : '' }}"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                <li class="nav-item {{ (request()->segment(1) == 'about') ? 'active' : '' }}"><a href="{{ url('/about') }}" class="nav-link">About</a></li>
                <!-- <li class="nav-item {{ (request()->segment(1) == 'paket') ? 'active' : '' }}"><a href="{{ url('/paket') }}" class="nav-link">Paket Harga</a></li> -->
                <li class="nav-item {{ (request()->segment(1) == 'cars') ? 'active' : '' }}"><a href="{{ url('/cars') }}" class="nav-link">Cars</a></li>
                <li class="nav-item {{ (request()->segment(1) == 'blog') ? 'active' : '' }}"><a href="{{ url('/blog') }}" class="nav-link">Blog</a></li>
                <li class="nav-item {{ (request()->segment(1) == 'contact') ? 'active' : '' }}"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>

                @if (auth()->check())
                <li class="nav-item"><a href="{{ url('admin/dashboard') }}" class="nav-link">Back Dashboard</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>