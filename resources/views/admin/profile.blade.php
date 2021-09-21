@section('vendorJs')
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection
@section('vendorCss')
<!-- Toastr files -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection

<div class="">
            <div class="page-title">
              <div class="title_left">
                
              </div>
            </div>
            <div class="clearfix"></div>   
            @if($isContentButton)
            <button type="button" wire:click="edit()" class="btn btn-round btn-primary">
                <i class="fa fa-bank"></i> Optimasi Profil
            </button>
            @endif

                @if($isContentEditor)
                @include('admin.contents-texteditor')
                @endif

              <!-- modal create -->
              @include('admin.profile-create')
            
    </div>

      @section('script-custom')
      <script>

      window.livewire.on('closeProfilModal',()=>{
      $('#modalCreate').modal('hide'); 
      });

      window.livewire.on('showCreateProfilModal',()=>{
      $('#modalCreate').modal('show'); 
      });

</script>
        <script>
              window.addEventListener('alert', event => { 
             toastr[event.detail.type](event.detail.message, 
             event.detail.title ?? ''), toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                }
            });
        </script>

      @endsection