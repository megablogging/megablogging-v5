	<div class='row' style='margin-top:10px'>
		<div class='col-md-12'>
			<div class='box1'>
				<div class='pull-right'><img height='50px' src='<?PHP echo "../mgb-dir/assets/favicon.png"; ?>'/></div>
				<h3>Admin Configuration</h3>
				<hr class='colorgraph'/>
				<form id='step4' action='finish.php' method='post'>
						<input name="url" value='<?PHP echo $site_url; ?>' required="required" type="hidden" />
						<input name="path" value='<?PHP echo $root; ?>' required="required" type="hidden" />
						<div class="form-group">
							<label>Full Name *</label> ex : <i>Dewa Bagas Kara</i>
							<input autocomplete='off' type='text' name='admin_name' class='form-control'/>
						</div>
						<div class="form-group">
							<label>Username For Admin *</label> ex : <i>dewa</i>
							<input autocomplete='off' type='text' name='admin_username' class='form-control'/>
						</div>
						<div class="form-group">
							<label>Email For Admin *</label> ex : <i>dewa@megasoft-id.com</i>
							<input autocomplete='off' type='text' name='admin_email' class='form-control'/>
						</div>
						<div class="form-group">
							<label>New Password For Admin *</label>
							<input autocomplete='off' type='password' name='admin_password' class='form-control'/>
						</div>
						<div class="form-group">
							<label>Retype Password *</label>
							<input autocomplete='off' type='password' name='admin_password2' class='form-control'/>
						</div>
						<hr>
						<div class="form-group">
							<label>Admin Folder (optional -> for make your admin page more secure)</label>
							<input autocomplete='off' type='text' name='folder_admin' class='form-control' value='admin'/>
						</div>
						<div class="form-group">
							<div class="checkbox">
								<input type="checkbox" name="acceptTerms" /> Accept the terms and policies of <a target='_blank' href='//www.megablogging.org/copyright.html'>megablogging</a>
                            </div>
                        </div>
						
						<input type='hidden' name='stepform' value='4'/>
						<div>
							<a href='?step=3' class='btn btn-danger'>&larr; Back</a>
							<button class='btn btn-success' id='step4btn'>Install <i class='fa fa-thumbs-up'></i></button>
						</div>
				</form>
			</div>
		</div>
	</div>	