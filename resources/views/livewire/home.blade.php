@section('title')
{{__('Beranda - Your Website')}}
@endsection
@section('beranda-active')
{{__('active')}}
@endsection

<div>
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
        <?php $i=0; ?>
        @forelse($photoslide as $row)
            <?php
                $img = explode('/',$row->imageloc);
                $i++;
                if($i == 1)
                {
                    $active = "active";
                }else{
                    $active = "";
                }
            ?>
          <!-- Slide -->
          <div class="carousel-item {{$active}}" style="background: url(/storage/{{$img[1]}})">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">{{$row->judul}}</h2>
                <p class="animate__animated animate__fadeInUp">{{$row->teks}}</p>
              </div>
            </div>
          </div>
        @empty
          <!-- Slide empty -->
          <div class="carousel-item active" style="background-color: #d6f5d6;">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Selamat Datang</h2>
                <p class="animate__animated animate__fadeInUp">sit amet volutpat consequat mauris nunc congue nisi vitae suscipit tellus mauris a diam maecenas sed enim ut sem viverra</p>
                <a href="{{route('profil')}}" class="btn-get-started animate__animated animate__fadeInUp">Selengkapnya</a>
              </div>
            </div>
          </div>

          @endforelse

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="fade-in">

        <div class="text-center">
          <h3> {{$profile_judul}} </h3>
          <p> {{$profile_isi}} </p>
          <a class="cta-btn" href="{{route('profil')}}">selengkapnya</a>
        </div>

      </div>
    </section><!-- End Cta Section -->
    <br><br>
    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
        <a href="{{route('berita')}}"><h2>Berita</h2></a>
          <p>vitae ultricies leo integer malesuada nunc vel risus commodo viverra</p>
        </div>

        <div class="row">
          @forelse($beritaz as $postz)
              <?php
                  $imge = array_pad(explode('/', $postz->photo), 2, null);
                  $datez = date("d M Y",strtotime($postz->published_at));
                ?>
          <div class="col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up">
            <div class="card" style="background-image: url(/storage/{{$imge[1]}});">
              <div class="card-body">
                <h5 class="card-title"><a href="/berita/{{$postz->slug}}">{{$postz->judul}}</a></h5>
                <p class="card-text">{{Str::limit($postz->deskripsi, 100, $end='...')}}</p>
                <p class="kaki">{{$datez}}, oleh {{$postz->name}}</p>
                <div class="read-more"><a href="/berita/{{$postz->slug}}"><i class="icofont-arrow-right"></i> Baca selengkapnya...</a></div>
              </div>
            </div>
          </div>
          @empty
          <h5 class="font-italic">Untuk sementara konten ini belum tersedia...</h5>
          @endforelse
          
        </div>

      </div>
    </section><!-- End Features Section -->


    <!-- ======= Blog Section ======= -->
    <section id="blog2" class="blog2">
      <div class="container">
      <div class="section-title" data-aos="fade-up">
        <a href="{{route('santri-menulis')}}"><h2>Santri Menulis</h2></a>
          <p>vitae ultricies leo integer malesuada nunc vel risus commodo viverra</p>
       </div>

        <div class="row">
            @forelse($santrim as $santri)
              <?php
                  $s_img = array_pad(explode('/', $santri->photo), 2, null);
                  $s_date = date("d M Y",strtotime($santri->published_at));
                ?>

          <div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <article class="entry">

              <div class="entry-img">
                <img src="/storage/{{$s_img[1]}}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="/santri-menulis/{{$santri->slug}}">{{$santri->judul}}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i>{{$santri->name}}</li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time datetime="2020-01-01">{{$s_date}}</time></li>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                {{Str::limit($santri->deskripsi, 100, $end='...')}}
                </p>
                <div class="read-more">
                  <a href="/santri-menulis/{{$santri->slug}}">Baca selengkapnya</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          </div>
          @empty
          <h5 class="font-italic">Untuk sementara konten ini belum tersedia...</h5>
          @endforelse
          
        </div>

      </div>
    </section><!-- End Blog Section -->


    <!-- ======= Gallery Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

      <div class="section-title" data-aos="fade-up">
          <a href="{{route('galeri')}}"><h2>Galeri Album Foto</h2></a>
        </div>

        <div class="row portfolio-container">
          
        @forelse($albums as $row)
            <?php
                $img = explode('/',$row->photo);
            ?>
          <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="portfolio-wrap">
              <img src="/storage/{{$img[1]}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="/galeri/{{$row->slug}}"><h4>{{$row->judul}}</h4></a>
                <p>{{$row->deskripsi}}</p>
                <div class="portfolio-links">
                  <a href="/galeri/{{$row->slug}}" title="Lihat selengkapnya"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>
          @empty
          <h5 class="font-italic">Untuk sementara konten ini belum tersedia...</h5>
            @endforelse
          
        </div>

      </div>
    </section><!-- End Gallery Section -->

    

  </main><!-- End #main -->

</div>