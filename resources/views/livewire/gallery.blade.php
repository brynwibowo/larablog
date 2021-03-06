@section('title')
{{__('Galeri - Your Website')}}
@endsection
@section('galeri-active')
{{__('active')}}
@endsection
<div>
<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs2" class="breadcrumbs2">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>Galeri</h2>
            <p>vitae justo eget magna fermentum iaculis eu non diam phasellus</p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{route('beranda')}}">Beranda</a></li>
          <li>Galeri</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Gallery Section ======= -->
<section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row portfolio-container">
          
         @forelse($gallery as $row)
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
          {{$gallery->links()}}

        </div>

      </div>
    </section><!-- End Gallery Section -->


</main><!-- End #main -->
</div>
