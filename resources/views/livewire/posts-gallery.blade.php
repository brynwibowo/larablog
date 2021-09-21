@section('title')
{{$judul}}
@endsection
@section('galeri-active')
{{__('active')}}
@endsection
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs2" class="breadcrumbs2">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>{{$judul}}</h2>
            <p><time datetime="2020-01-01">{{$date}}</time></p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{route('beranda')}}">Beranda</a></li>
          <li><a href="{{route('galeri')}}">Galeri</a></li>
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
                <br><br>
              <div class="entry-content text-justify">
                <!--isi konten -->
                <?php echo html_entity_decode($isikonten);?>
              </div>

              <div class="entry-footer clearfix">
                <div class="float-left">
                  
                </div>

                <div class="float-right share">
                  <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                  <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                  <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                </div>

              </div>

            </article><!-- End blog entry -->

            

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Album Galeri</h3>
              <div class="sidebar-item search-form">
                <form>
                  <input type="text" wire:model="search" placeholder="live search...">
                  <button type="button"><i class="icofont-search"></i></button>
                </form>

              </div><!-- End sidebar search formn-->
              <div class="sidebar-item recent-posts">

                @forelse($album as $post)
                <?php
                  $imgz = array_pad(explode('/', $post->photo), 2, null);
                  $dates = date("d M Y",strtotime($post->created_at));
                ?>
                <div class="post-item clearfix">
                  <a href="/galeri/{{$post->slug}}">
                  <img src="/storage/{{$imgz[1]}}" alt="">
                  </a>
                  <h4><a href="/galeri/{{$post->slug}}">{{$post->judul}}</a></h4>
                  <time datetime="2020-01-01">{{$dates}}</time>
                  
                </div>
                @empty
                <div class="post-item clearfix">
                  <h4><a href="#">Belum Tersedia</a></h4>
                </div>
                @endforelse
                <br>
                {{$album->links()}}
              </div><!-- End sidebar recent posts-->

              
            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->