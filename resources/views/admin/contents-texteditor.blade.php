					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>{{ $judul }}</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
									@csrf
										
										<div wire:ignore class="form-group">
  												<textarea wire:model="isikonten" class="form-control" rows="10" id="isikonten"></textarea>
										</div>
										@error('isikonten') <span class="text-danger">{{ $message }}</span>@enderror
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												@if($isNotProfil)
												<button class="btn btn-primary" wire:click="openContentList()" type="button">Cancel</button>
												@endif
												<button type="button" wire:click.prevent="store()" class="btn btn-success">Save and Post</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
                    <script>
                    const editor = CKEDITOR.replace('isikonten', {
        			filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        			filebrowserUploadMethod: 'form'
    					});
                    editor.on('change', function(event){
                    console.log(event.editor.getData())
                    @this.set('isikonten', event.editor.getData());
                            })
                    </script>
					
					