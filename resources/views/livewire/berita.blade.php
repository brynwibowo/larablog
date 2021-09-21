@section('title')
{{__('Berita - PP Nurul Ummah Kebumen')}}
@endsection
@section('berita-active')
{{__('active')}}
@endsection
<div>
<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs2" class="breadcrumbs2">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>Berita</h2>
            <p>Informasi dan kegiatan Pondok Pesantren Nurul Ummah Kebumen</p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{route('beranda')}}">Beranda</a></li>
          <li>Berita</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
  <div class="container">

    <div class="row">

      <div class="col-lg-8 entries">

        @forelse($contents as $row)
            <?php
                  $img = array_pad(explode('/', $row->photo), 2, null);
                  $date = date("d M Y",strtotime($row->published_at));
            ?>
        <article class="entry">

          <div class="entry-img">
            <img src="/storage/{{$img[1]}}" alt="" class="img-fluid">
          </div>

          <h2 class="entry-title">
            <a href="/berita/{{$row->slug}}">{{$row->judul}}</a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="">{{$row->name}}</a></li>
              <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">{{$date}}</time></a></li>
            </ul>
          </div>

          <div class="entry-content">
            <p>
              {{$row->deskripsi}}
            </p>
            <div class="read-more">
              <a href="/berita/{{$row->slug}}">Baca Selengkapnya</a>
            </div>
          </div>

        </article><!-- End blog entry -->
        @empty
        <h4>Untuk sementara belum tersedia...</h4>
        @endforelse
        {{$contents->links()}}

      </div><!-- End blog entries list -->

      <div class="col-lg-4">

        <div class="sidebar">

        <h3 class="sidebar-title">Search</h3>
          <div class="sidebar-item search-form">
            <form>
              <input type="text" wire:model="cari" placeholder="live search...">
              <button type="button"><i class="icofont-search"></i></button>
            </form>

          </div><!-- End sidebar search formn-->
          <h3 class="sidebar-title">Lihat juga :</h3>
          <br>
          <h3 class="sidebar-title">Santri Menulis Terbaru</h3>
              <div class="sidebar-item recent-posts">

                @forelse($santris as $post)
                <?php
                  $imgz = array_pad(explode('/', $post->photo), 2, null);
                  $dates = date("d M Y",strtotime($post->published_at));
                ?>
                <div class="post-item clearfix">
                  <a href="/santri-menulis/{{$post->slug}}">
                  <img src="/storage/{{$imgz[1]}}" alt="">
                  </a>
                  <h4><a href="/santri-menulis/{{$post->slug}}">{{$post->judul}}</a></h4>
                  <time datetime="2020-01-01">{{$dates}}
                  <p>oleh {{$post->name}}<p>
                  </time>
                  
                </div>
                @empty
                <div class="post-item clearfix">
                  <h4><a href="#">Belum Tersedia</a></h4>
                </div>
                @endforelse
               
              </div><!-- End sidebar recent posts-->

          

        </div><!-- End sidebar -->

      </div><!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Section -->

</main><!-- End #main -->
</div>
