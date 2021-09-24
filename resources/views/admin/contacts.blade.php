@section('vendorCss')
<!-- jquery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Messages</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="Search for...">
                    <select wire:model="kategoriOps" class="form-control">
                        <option value="name" selected>Name</option>
                        <option value="email">Email</option>
                        <option value="subject">Subject</option>
                        </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>   
           <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox ml-2">
                        <select class="form-control" wire:model="read_status">
                        <option value="" selected>tampilkan semua</option>
                        <option value=0>tampilkan belum dibaca</option>
                        <option value=1>tampilkan sudah dibaca</option>
                        </select>
                    </ul>
                    
                    <ul class="nav navbar-right panel_toolbox">
                        <select class="form-control" wire:model="urutan">
                        <option value="DESC" selected>urutkan dari yang terbaru</option>
                        <option value="ASC">urutkan dari yang terlama</option>
                        </select>
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
                          <th>Waktu pengiriman</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;?>
                      @forelse($messages as $row)
                    <?php
                        //convert time stamp to D M Y
                        $time = strtotime($row->created_at);
                        $date = date("d M Y, H:i",$time);
                        if($row->is_readed){
                          $stts = "sudah dibaca";
                          $cls = "font-italic";
                        }else{
                          $stts = "belum dibaca";
                          $cls = "font-weight-bold";
                        }
                        
                    ?>
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{ $date }}</td>
                          <td>{{ $row->name }}</td>
                          <td><a href="mailto:{{$row->email}}" target="__blank">{{ $row->email }}</a></td>
                          <td>{{ $row->subject }}</td>
                          <td><span class="{{$cls}}">{{$stts}}</span></td>
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" wire:click="openModalDetail({{$row->id}})"><i class="fa fa-eye"></i> View Message</a>
                              
                              <a class="dropdown-item" wire:click="openModalDelete({{$row->id}},'{{$row->name}}')"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                          </div>
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Belum ada pesan...</td>
                        </tr>
                    @endforelse
                      </tbody>
                      {{ $messages->links() }}
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
              @include('admin.contacts-modal')
            
    </div>

      @section('script-custom')

        <script>

          window.livewire.on('messageDeleted',()=>{
          $('#modalDelete').modal('hide'); 
          });

          window.livewire.on('showModalDelete',()=>{
          $('#modalDelete').modal('show'); 
          });

          window.livewire.on('showModalDetail',()=>{
          $('#modalDetail').modal('show'); 
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