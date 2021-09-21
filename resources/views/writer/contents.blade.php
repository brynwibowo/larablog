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
                <h3>Content</h3>
              </div>
              @if($isContentList)
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="Search for...">
                    <select wire:model="kategoriOps" class="form-control">
                        <option value="judul" selected>Judul</option>
                        <option value="is_published">Status Publikasi</option>
                        <option value="published_at">Tanggal Publikasi</option>
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
                          <th>Penulis</th>
                          <th>Kunjungan</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1;?>
                      @forelse($contents as $row)
                    <?php
                        //convert time stamp to D M Y
                        if($row->published_at != '')
                        {
                        $time = strtotime($row->published_at);
                        $date = date("d M Y",$time);
                        }else{
                          $date = '-';
                        }

                        if($row->is_published)
                        {
                          $status = 'Publikasi';
                        }else{
                          $status = 'Draft';
                        }
                    ?>
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{ $date }}</td>
                          <td>{{ $row->judul }}</td>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->views }}</td>
                          <td>{{ $status }}</td>
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit</a>
                              @if(!$row->is_published)
                              <a class="dropdown-item" href="/content/preview/{{$row->slug}}" target="__blank"><i class="fa fa-eye"></i> Preview</a>
                              @else
                              <a class="dropdown-item" href="/santri-menulis/{{$row->slug}}" target="__blank"><i class="fa fa-eye"></i> View Content</a></div>
                              @endif
                          </div>
                          </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Data belum tersedia, untuk menambahkan klik tombol Tambah di atas...</td>
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

            @endif

            @if($isContentForm)
                @include('admin.contents-create')
            @endif

                @if($isContentEditor)
                @include('admin.contents-texteditor')
                @endif
            
    </div>

      @section('script-custom')

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