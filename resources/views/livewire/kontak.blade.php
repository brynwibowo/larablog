@section('title')
{{__('Kontak - Your Website')}}
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
            <p>vitae ultricies leo integer malesuada nunc vel risus commodo viverra</p>
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
              <p>Jl.Kenangan Manis, Kabupaten Purbalingga, Jawa Tengah 53371</p>
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
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.5953612941653!2d109.34806241477571!3d-7.399153694661307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559b71e297d99%3A0x2751d5ec377568d6!2sPatung%20Jenderal%20Soedirman%20Purbalingga!5e0!3m2!1sid!2sid!4v1654066022467!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
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
              <x-honey recaptcha/>
              <div class="form-check">
									<input type="checkbox" wire:model="agreement" id="agreement" class="form-check-input" value=1> 
                  <label class="form-check-label" for="agreement">
                  Saya setuju
                  </label>
							</div>
              <div class="mb-3">
              <div wire:loading wire:target="store" class="text-primary">
                  Mengirim...
               </div>
               <span class="font-italic {{$cls}}">{{$status}}</span>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
            

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->