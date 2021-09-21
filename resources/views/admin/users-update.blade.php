<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">{{$modalTitle}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
        <form >
		@csrf    @if($isChangeProfil)
                <div class="form-group">
                    <label for="formName">Name</label>
                    <input type="text" id="formName" class="form-control" wire:model="name">
					@error('name') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="formEmail">Email</label>
                    <input type="email" id="formEmail" class="form-control" wire:model="email">
					@error('email') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="formLevel">Level</label>
                    <select id="formLevel" class="form-control" wire:model="level">
                        <option value="">--Pilih--</option>
						<option value="guest">Guest</option>
						<option value="writer">Writer</option>
					</select>
					@error('level') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                @else
				<div class="form-group">
                    <label for="formPassword">Password</label>
                    <input type="password" id="formPassword" class="form-control" wire:model="password">
					@error('password') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
				<div class="form-group">
                    <label for="formConfirmPassword">Confirm Password</label>
                    <input type="password" id="formConfirmPassword" class="form-control" wire:model="confirmPassword">
					@error('confirmPassword') <span class="text-danger">{{ $message }}</span>@enderror
                </div>
                @endif
      </form>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" wire:click.prevent = "store()">Save changes</button>
        </div>
    </div>
  </div>
</div>