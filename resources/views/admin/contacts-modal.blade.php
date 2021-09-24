<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Detail Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" wire:click="resetInputFields" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="modal-body">
            <div class="form-group">
				<label for="f-p">Pengirim :</label>
				<input type="text" id="f-p" class="form-control" wire:model="name" readonly>
			</div>

            <div class="form-group">
				<label for="f-e">Email :</label>
				<input type="email" id="f-e" class="form-control" wire:model="email" readonly>
			</div>

            <div class="form-group">
				<label for="f-s">Subject :</label>
				<input type="text" id="f-s" class="form-control" wire:model="subject" readonly>
			</div>
										
			<div class="form-group">
				<label for="f-t">Isi pesan :</label>
				<textarea id="f-t" wire:model="text" rows="3" class="form-control" readonly></textarea>
			</div>
        
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="resetInputFields" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>