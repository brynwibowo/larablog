@section('title')
{{__('Profil | Sekilas Your Organization')}}
@endsection
@section('profil-active')
{{__('active')}}
@endsection

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs2" class="breadcrumbs2">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>{{$profile_judul}}</h2>
            <p></p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{route('beranda')}}">Beranda</a></li>
          <li>Profil</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="/storage/{{$profile_image}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content text-justify">
          <?php echo html_entity_decode($profile_isi);?>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


  </main><!-- End #main -->