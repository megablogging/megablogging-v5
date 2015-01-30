	<div class='row' style='margin-top:10px'>
		<div class='col-md-12'>
			<div class='box1'>
				<div class='pull-right'><img height='50px' src='<?PHP echo "../mgb-dir/assets/favicon.png"; ?>'/></div>
				<h3>Website Configuration</h3>
				<hr class='colorgraph'/>
				<div class='alert alert-success'>
					Langkah ini merupakan pengaturan tambahan untuk mengubah  <b>url rewriting</b> di website anda, fungsi dari pengaturan ini membuat url website anda menjadi url yang lebih <b>SEO friendly</b>, namun pada dasarnya <i>megablogging</i> telah menerapkan default <b>SEO Friendly</b> yang sudah cukup bagus, jadi jika anda kurang mengerti tentang pengkonfigurasian ini silahkan tekan tombol <b>next</b> saja.
				</div>
				<form id='step3' action='?step=4' method='post'>
						<div class="form-group">
							<label class="control-label">Url Article</label>
							<div class="input-group">
								<span class="input-group-addon"><?PHP echo "$site_url/"; ?></span>
								<input class='form-control' type="text" name='uri_artikel_depan' value='<?PHP echo $uri_artikel_depan; ?>' autocomplete='off'>
								<span class="input-group-addon"><?PHP echo "/judul-artikel-yang-anda-buat"; ?></span>
								<input class="form-control" type="text" name='uri_artikel_belakang' value="<?PHP echo $uri_artikel_belakang; ?>" autocomplete='off'>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label">Url Category</label>
							<div class="input-group">
								<span class="input-group-addon"><?PHP echo "$site_url/"; ?></span>
								<input class='form-control' type="text" name='uri_category' value='<?PHP echo $uri_category; ?>' autocomplete='off'>
								<span class="input-group-addon"><?PHP echo "/nama-category"; ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Url Search</label>
							<div class="input-group">
								<span class="input-group-addon"><?PHP echo "$site_url/"; ?></span>
								<input class='form-control' type="text" name='uri_search' value='<?PHP echo $uri_search; ?>' autocomplete='off'>
								<span class="input-group-addon"><?PHP echo "/keyword-yang-di-masukan"; ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Url Page</label>
							<div class="input-group">
								<span class="input-group-addon"><?PHP echo "$site_url/"; ?></span>
								<input class='form-control' type="text" name='uri_paging_index' value='<?PHP echo $uri_paging_index; ?>' autocomplete='off'>
								<span class="input-group-addon"><?PHP echo "/20"; ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Url Pages</label>
							<div class="input-group">
								<span class="input-group-addon"><?PHP echo "$site_url/"; ?></span>
								<input class='form-control' type="text" name='uri_pages' value='<?PHP echo $uri_pages; ?>' autocomplete='off'>
								<span class="input-group-addon"><?PHP echo "/nama-halaman"; ?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Url Rss Feed</label>
							<div class="input-group">
								<span class="input-group-addon"><?PHP echo "$site_url/"; ?></span>
								<input class='form-control' type="text" name='uri_feed' value='<?PHP echo $uri_feed; ?>' autocomplete='off'>
								<span class="input-group-addon"><?PHP echo "/"; ?></span>
							</div>
						</div>
						<input type='hidden' name='stepform' value='3'/>
						<div>
							<a href='?step=2' class='btn btn-danger'>&larr; Back</a>
							<button class='btn btn-success' id='step3btn'>Next &rarr;</button>
						</div>
				</form>
			</div>
		</div>
	</div>	