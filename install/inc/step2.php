	<div class='row' style='margin-top:10px'>
		<div class='col-md-12'>
			<div class='box1'>
				<div class='pull-right'><img height='50px' src='<?PHP echo "../mgb-dir/assets/favicon.png"; ?>'/></div>
				<h3>Database Configuration</h3>
				<hr class='colorgraph'/>
				<form id='step2' action='?step=3' method='post'>
					<input type='hidden' name='act' value='add'/>
						<div class="form-group">
							<label>Host Name *</label> ex : <i>localhost</i>
							<input autocomplete='off' type='text' name='db_host' class='form-control' placeholder='localhost' value='<?PHP echo $ins_db_host; ?>'/>
						</div>
						<div class="form-group">
							<label>Username Host *</label> ex : <i>root</i>
							<input autocomplete='off' type='text' name='db_username' class='form-control' placeholder='root' value='<?PHP echo $ins_db_username; ?>'/>
						</div>
						<div class="form-group">
							<label>Password Database</label>
							<input type='password' name='db_password' class='form-control' placeholder='' value='<?PHP echo $ins_db_password; ?>'/>
						</div>
						<div class="form-group">
							<label>Database Name * </label> ex : <i>megablogging</i>
							<input autocomplete='off' type='text' name='db_name' class='form-control' placeholder='megablogging' value='<?PHP echo $ins_db_name; ?>'/>
						</div>
						<input type='hidden' name='stepform' value='2'/>
						<div>
							<a href='?step=1' class='btn btn-danger'>&larr; Back</a>
							<button class='btn btn-success' id='step2btn'>Next &rarr;</button>
						</div>
				</form>
			</div>
		</div>
	</div>	