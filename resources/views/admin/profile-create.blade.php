<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Optimasi Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
        <form >
		    @csrf   
                <div class="form-group">
									  <label for="f-judul">Judul <span>*</span></label>
										<input type="text" id="f-judul" wire:model="judul" class="form-control">
									@error('judul') <span class="text-danger">{{ $message }}</span>@enderror
										<br>
								</div>   
                <div class="form-group">
									  <label for="f-deskripsi">Deskripsi <span>*</span></label>
										<textarea id="f-deskripsi" wire:model="deskripsi" maxlength="255" rows="3" class="form-control"></textarea>
									@error('deskripsi') <span class="text-danger">{{ $message }}</span>@enderror
										<br>
								</div>   
                <div class="form-group">
                    <label for="formPhoto">Sampul Profil</label>
                    <input type="file" id="formPhoto" class="form-control" wire:model="photo">
					        @error('photo') <span class="text-danger">{{ $message }}</span>@enderror
                    <div wire:loading wire:target="photo" class="text-primary">
                       Uploading image...
                    </div>
                </div>
                
      </form>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" wire:click.prevent = "validasi()">Confirm</button>
        </div>
    </div>
  </div>
</div>