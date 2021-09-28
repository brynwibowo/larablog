<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Add New Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
        <form >
		@csrf      
                <div class="form-group">
                    <label for="formName">Name <span class="required">*</span></label>
                    <input type="text" id="formName" maxlength=50 class="form-control" wire:model="name">
					@error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Jenis kelamin <span class="required">*</span></label>
                    <p>
					Pria:
						<input type="radio" class="flat" value="m" wire:model="sex"/> 
                    Wanita:
						<input type="radio" class="flat" value="f" wire:model="sex"/>
					</p>
                    @error('sex') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="formAlamat">Alamat <span class="required">*</span></label>
                    <textarea id="formAlamat" class="form-control" rows="3" maxlength=255 wire:model="address"></textarea>
					@error('address') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="formPhone">Telepon <span class="required">*</span></label>
                    <input id="formPhone" maxlength=12 class="form-control" wire:model="phone">
					@error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
				<div class="form-group">
                    <label for="formPosition">Jabatan <span class="required">*</span></label>
                    <select id="formPosition" class="form-control" wire:model="position">
						<option value="">--Pilih--</option>
						<option value="masyayikh">Masyayikh</option>
						<option value="asatidz">Asatidz</option>
                        <option value="mudir">Mudir</option>
					</select>
					@error('position') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="formKutip">Kutipan</label>
                    <textarea id="formKutip" class="form-control" rows="3" maxlength=255 wire:model="bio"></textarea>
                </div>
				
      </form>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" wire:click.prevent = "store()">Save changes</button>
        </div>
    </div>
  </div>
</div>