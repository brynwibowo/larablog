@section('vendorCss')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Foto Slide
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="Search for...">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>   
           <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <button type="button" wire:click="create()" class="btn btn-round btn-primary">
                      <i class="fa fa-plus"></i> Tambah
                    </button>

                    <div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Untuk hasil yang optimal, dimensi gambar lebar x tinggi = 1355x585 satuan pixel. </strong>
                    </div>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Judul</th>
                          <th>Kutipan</th>
                          <th>Foto Slide</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;?>
                      @forelse($contents as $row)
                        <?php
                        $img = explode('/',$row->imageloc);

                        ?>
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{ $row->judul }}</td>
                          <td>{{ $row->teks }}</td>
                          <td><a href="/storage/{{ $img[1] }}" target="__blank">lihat foto klik</a></td>
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit</a>
                              <a class="dropdown-item" wire:click="openModalDelete({{$row->id}},'{{$row->judul}}')"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                          </div>
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Data belum tersedia, untuk menambahkan klik tombol Tambah di atas...</td>
                        </tr>
                    @endforelse
                      </tbody>
                      {{ $contents->links() }}
                    </table>
					
                  </div>
                </div>
            </div>

            </div>
                </div>
              </div>
              <!-- Modal Delete -->
              @include('admin.contents-modal-delete')
              @include('admin.photoslide-create')
              <!-- end modal -->

             
    </div>

      @section('script-custom')

        <script>

          window.livewire.on('photoSlideDeleted',()=>{
          $('#modalDelete').modal('hide'); 
          });

          window.livewire.on('showModalDelete',()=>{
          $('#modalDelete').modal('show'); 
          });

          window.livewire.on('photoSlideAdded',()=>{
          $('#modalCreate').modal('hide'); 
          });

          window.livewire.on('showPhotoSlideForm',()=>{
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