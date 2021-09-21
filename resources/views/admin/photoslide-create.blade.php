<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Photo Slide Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
        <form enctype="multipart/form-data">
		@csrf      
        <div class="form-group">
											<label for="f-judul">Judul Foto Slide</label>
												<input type="text" id="f-judul" required="required" class="form-control" wire:model="judul">
												
												<br>
											</div>
										
											
											<div class="form-group">
											<label for="f-teks">Teks Kutipan</label>
												<textarea id="f-teks" wire:model="teks" maxlength="255" rows="3" required="required" class="form-control"></textarea>
												
												<br>
											</div>
										
											
											<div class="form-group">
											<label for="f-imageloc">Foto Slide <span>*</span></label>
												<input id="f-imageloc" type="file" class="form-control" wire:model="imageloc">
												@error('imageloc') <span class="text-danger">{{ $message }}</span>@enderror
												<div wire:loading wire:target="imageloc" class="text-primary">
                                					Uploading image...
                            					</div>
												<br>
											</div>
                
      </form>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" wire:click.prevent = "store()">Save changes</button>
        </div>
    </div>
  </div>
</div>