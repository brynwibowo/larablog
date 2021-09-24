@section('title')
{{__('Kontak - PP Nurul Ummah Kebumen')}}
@endsection
@section('kontak-active')
{{__('active')}}
@endsection
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs2" class="breadcrumbs2">
      <div class="breadcrumb-hero">
        <div class="container">
          <div class="breadcrumb-hero">
            <h2>Kontak</h2>
            <p>Informasi kontak yang bisa dihubungi di Pondok Pesantren Nurul Ummah Kebumen</p>
          </div>
        </div>
      </div>
      <div class="container">
        <ol>
          <li><a href="{{route('beranda')}}">Beranda</a></li>
          <li>Kontak</li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Alamat Kami</h3>
              <p>Jl.Kaliputri KM.01 Mangunweni, Kecamatan Ayah, Kabupaten Kebumen, Jawa Tengah 54473</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Telepon</h3>
              <p></p>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.0522121375825!2d109.41540031438215!3d-7.677536294465225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6537b8a973d0d9%3A0xb4c3dd6621d6c14f!2sPondok%20pesantren%20NURUL%20UMMAH!5e0!3m2!1sid!2sid!4v1631326236598!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>
          <!-- form kontak -->
          <div class="col-lg-6">
            <form wire:submit.prevent="store" role="form" class="php-email-form">
              @csrf
              <div class="form-row">
                <div class="col form-group">
                  <input type="text" class="form-control" maxlength=50 placeholder="Your Name" wire:model="name" />
                  @error('name') <span class="text-danger font-italic">{{ $message }}</span>@enderror
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" maxlength=50 wire:model="email" placeholder="Your Email" />
                  @error('email') <span class="text-danger font-italic">{{ $message }}</span>@enderror
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" maxlength=50 wire:model="subject" placeholder="Subject" />
                @error('subject') <span class="text-danger font-italic">{{ $message }}</span>@enderror
              </div>
              <div class="form-group">
                <textarea class="form-control" maxlength=255 wire:model="text" rows="5" placeholder="Message"></textarea>
                @error('text') <span class="text-danger font-italic">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
								<label>
									<input type="checkbox" wire:model="agreement" value=1> Saya setuju
								</label>
							</div>
              <div class="mb-3">
              <div wire:loading wire:target="store" class="text-primary">
                  Mengirim...
               </div>
               <span class="font-italic">{{$status}}</span>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
            

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->