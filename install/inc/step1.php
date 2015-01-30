	<div class='row' style='margin-top:10px'>
		<div class='col-md-12'>
			<div class='box1'>
				<div class='pull-right'><img height='50px' src='<?PHP echo "../mgb-dir/assets/favicon.png"; ?>'/></div>
				<h3>Basic Configuration</h3>
				<hr class='colorgraph'/>
				<form id='step1' action='?step=2' method='post'>
					<input type='hidden' name='act' value='add'/>
						<div class="form-group">
							<label>Type Site *</label>
							<select name="type_site" class='form-control'>
								<option value="<?PHP echo $ins_type_site; ?>"><?PHP echo $ins_type_site; ?></option> 
								<option value="Offline">Offline (Only Localhost)</option>
								<option value="Online">Online (Internet Site)</option> 
							</select> 
						</div>
						<div class="form-group">
							<label>Site Title (Judul Website) *</label> ex : <i>Blog Megasoft Informer</i>
							<input autocomplete='off' type='text' name='title' class='form-control' placeholder='Blog Megasoft Informer' value='<?PHP echo $ins_title; ?>'/>
						</div>
						<div class="form-group">
							<label>Show Data of Post in Blog Perpage *</label>
							<input autocomplete='off' type='text' name='show' class='form-control' placeholder='10' value='<?PHP echo $ins_show; ?>'/>
						</div>
						<div class="form-group">
							<label>Show Data in Table Perpage *</label>
							<input autocomplete='off' type='text' name='max' class='form-control' placeholder='30' value='<?PHP echo $ins_max; ?>'/>
						</div>
						<div class="form-group">
							<label>Background Site * </label>
							<input autocomplete='off' type='text' name='background' class='form-control' value='<?PHP echo $ins_background; ?>'/>
						</div>
						<input type='hidden' name='stepform' value='1'/>
						<div>
							<button class='btn btn-success' id='step1btn'>Next &rarr;</button>
						</div>
				</form>
				
			</div>
		</div>
	</div>
