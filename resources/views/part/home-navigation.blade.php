<header id="header">
    <div class="container d-flex">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="{{route('home')}}"><span>Your Organization</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="@yield('beranda-active')"><a href="{{route('beranda')}}">Beranda</a></li>

          <li class="drop-down @yield('profil-active')"><a href="#">Profil</a>
            <ul>
              <li><a href="{{route('profil')}}">Sekilas Your Organization</a></li>
              <li><a href="#">Masyayikh</a></li>
              <li><a href="#">Asatidz</a></li>
              <li><a href="#">Mudir</a></li>
            </ul>
          </li>

          <li class="drop-down @yield('pendidikan-active')"><a href="#">Pendidikan</a>
            <ul>
              
              <li class="drop-down"><a href="#">Madrasah</a>
                <ul>
                  <li><a href="#">MI</a></li>
                  <li><a href="#">MTS</a></li>
                  <li><a href="#">MA</a></li>
                </ul>
              </li>
              <li><a href="#">Ngaji Kitab</a></li>
            </ul>
          </li>
          <li class="@yield('galeri-active')"><a href="{{route('galeri')}}">Galeri</a></li>
          <li class="@yield('berita-active')"><a href="{{route('berita')}}">Berita</a></li>
          <li class="@yield('santri-active')"><a href="{{route('santri-menulis')}}">Santri Menulis</a></li>
          <li class="@yield('kontak-active')"><a href="{{route('kontak')}}">Kontak Kami</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->