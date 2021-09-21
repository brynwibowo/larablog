@section('title')
{{$judul}}
@endsection
@section('santri-active')
{{__('active')}}
@endsection
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs2" class="breadcrumbs2">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>{{$judul}}</h2>
            <p>oleh {{$author}}</p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{route('beranda')}}">Beranda</a></li>
          <li><a href="{{route('santri-menulis')}}">Santri-Menulis</a></li>
          <li>{{$judul}}</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="{{$photo}}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.html">{{$judul}}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="blog-single.html">{{$author}}</a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">{{$date}}</time></a></li>
                </ul>
              </div>

              <div class="entry-content text-justify">
                <!--isi konten -->
                <?php echo html_entity_decode($isikonten);?>
              </div>

              <div class="entry-footer clearfix">
                <div class="float-left">
                  
                </div>

                <div class="float-right share">
                  <a href="#" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                  <a href="#" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                  <a href="#" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                </div>

              </div>

            </article><!-- End blog entry -->

            

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Lihat juga :</h3>
              <br>
              

              <h3 class="sidebar-title">Santri Menulis Terpopuler</h3>
              <div class="sidebar-item recent-posts">

                @forelse($santriy as $post)
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

              <h3 class="sidebar-title">Berita Terbaru</h3>
              <div class="sidebar-item recent-posts">

              @forelse($contenty as $berita)
              <?php
                  $imgs = array_pad(explode('/', $berita->photo), 2, null);
                  $date = date("d M Y",strtotime($berita->published_at));
              ?>
                <div class="post-item clearfix">
                  <a href="/berita/{{$berita->slug}}">
                  <img src="/storage/{{$imgs[1]}}" alt="">
                  </a>
                  <h4><a href="/berita/{{$berita->slug}}">{{$berita->judul}}</a></h4>
                  <time datetime="2020-01-01">{{$date}}
                  <p>oleh {{$berita->name}}<p>
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