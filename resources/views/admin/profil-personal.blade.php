@section('vendorCss')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Personal</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="Search for...">
                    <select wire:model="kategoriOps" class="form-control">
                        <option value="name" selected>Nama</option>
                        <option value="position">Jabatan</option>
                        </select>
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
                    <button type="button" wire:click="export_excel()" class="btn btn-round btn-success">
                      <i class="fa fa-file-excel-o"></i> Export
                    </button>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
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
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Telepon</th>
                          <th>Jabatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;?>
                      @forelse($profils as $row)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->address }}</td>
                          <td>{{ $row->phone }}</td>
                          <td>{{ $row->position }}</td>
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit Profil</a>
                              <a class="dropdown-item" wire:click="openModalDelete({{$row->id}},'{{$row->name}}')"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                          </div>
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">Data belum tersedia, untuk menambahkan klik tombol Add di atas...</td>
                        </tr>
                    @endforelse
                      </tbody>
                      {{ $profils->links() }}
                    </table>
					
                  </div>
                </div>
            </div>

            </div>
                </div>
              </div>
              <!-- Modal Delete -->
              @include('admin.users-modal-delete')
              <!-- end modal -->

              <!-- modal create -->
              @include('admin.profil-personal-create')

        </div>

      @section('script-custom')

        <script>

          window.livewire.on('profilDeleted',()=>{
          $('#modalDelete').modal('hide'); 
          });

          window.livewire.on('showModalDelete',()=>{
          $('#modalDelete').modal('show'); 
          });

          window.livewire.on('profilAdded',()=>{
          $('#modalCreate').modal('hide'); 
          });

          window.livewire.on('showCreateModal',()=>{
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