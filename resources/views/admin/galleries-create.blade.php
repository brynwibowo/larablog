					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Form Gallery</h2>
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
									<form>
									@csrf
										
											<div class="form-group">
											<label for="f-judul">Judul Album<span>*</span></label>
												<input type="text" id="f-judul" required="required" class="form-control" wire:model="judul">
												@error('judul') <span class="text-danger">{{ $message }}</span>@enderror
												<br>
											</div>
										
											
											<div class="form-group">
											<label for="f-deskripsi">Deskripsi <span>*</span></label>
												<textarea id="f-deskripsi" wire:model="deskripsi" maxlength="255" rows="3" required="required" class="form-control"></textarea>
												@error('deskripsi') <span class="text-danger">{{ $message }}</span>@enderror
												<br>
											</div>
										
											
											<div class="form-group">
											<label for="f-photo">Sampul Album <span>*</span></label>
												<input id="f-photo" type="file" class="form-control" wire:model="photo">
												@error('photo') <span class="text-danger">{{ $message }}</span>@enderror
												<div wire:loading wire:target="photo" class="text-primary">
                                					Uploading image...
                            					</div>
												<br>
											</div>
										
											<div class="form-group">
												<button class="btn btn-primary" wire:click="openContentList()" type="button">Cancel</button>
												<button class="btn btn-primary" type="button" wire:click="resetInputFields()">Reset</button>
												<button type="button" wire:click="openContentEditor()" class="btn btn-success">Confirm</button>
											</div>
									</form>
								</div>
							</div>
						</div>
					</div>