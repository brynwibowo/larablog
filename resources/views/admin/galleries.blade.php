@section('vendorJs')
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@endsection
@section('vendorCss')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Gallery</h3>
              </div>
              @if($isContentList)
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="Search for...">
                    <select wire:model="kategoriOps" class="form-control">
                        <option value="judul" selected>Judul</option>
                        <option value="created_at">Publikasi</option>
                        </select>
                  </div>
                </div>
              </div>
              @endif
            </div>

            <div class="clearfix"></div>   
            @if($isContentList)
           <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <button type="button" wire:click="create()" class="btn btn-round btn-primary">
                      <i class="fa fa-plus"></i> Tambah
                    </button>

                    <ul class="nav navbar-right panel_toolbox">
                        <select class="form-control" wire:model="urutan">
                        <option value="DESC" selected>urutkan dari yang terbaru</option>
                        <option value="ASC">urutkan dari yang terlama</option>
                        </select>
                    </ul>

                    <div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Untuk hasil yang optimal, dimensi gambar lebar x tinggi pada teks editor = 100% x 100%. </strong>
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
                          <th>Publikasi</th>
                          <th>Judul</th>
                          <th>Kunjungan</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;?>
                      @forelse($contents as $row)
                    <?php
                        //convert time stamp to D M Y
                        $time = strtotime($row->created_at);
                        $date = date("d M Y",$time);
                    ?>
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{ $date }}</td>
                          <td>{{ $row->judul }}</td>
                          <td>{{ $row->views }}</td>
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit</a>
                              <a class="dropdown-item" href="/galeri/{{$row->slug}}" target="__blank"><i class="fa fa-eye"></i> View Gallery</a>
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
              <!-- end modal -->
            @endif

            @if($isContentForm)
                @include('admin.galleries-create')
            @endif

                @if($isContentEditor)
                @include('admin.contents-texteditor')
                @endif
            
    </div>

      @section('script-custom')

        <script>

          window.livewire.on('galleryDeleted',()=>{
          $('#modalDelete').modal('hide'); 
          });

          window.livewire.on('showModalDelete',()=>{
          $('#modalDelete').modal('show'); 
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