<div class="container">
        <div class="row">
			<?PHP 
			if ($posisi_widget == "left"){
			echo "<div class='col-md-4 col-lg-4'>";
				require_once(TEMPLATE_DIR."/widget.php");
			echo "</div>";
			}
			?>
            <div class="col-md-8 col-lg-8">
				<div id='article' itemscope itemtype="http://schema.org/Article">
					<!-- blog entry -->
					<?PHP
					if (!is_array($data_art)){echo"<meta http-equiv='refresh' content='0; url=$c_url'>";exit();}
					foreach($data_art as $a_data){
					$a_link = $a_data['link'];
					$a_title = $a_data['title'];
					$a_image = $a_data['image'];
					$a_shoot = $a_data['shoot'];
					$a_date = $a_data['date'];
					$a_cat = $a_data['category'];
					$a_id = $a_data['id'];
					$a_time = $a_data['time'];
					?>
					<div class='<?PHP echo "$ribbon_article_style $ribbon_article" ?> ribbon' itemprop="name"><?PHP echo $a_title; ?></div>
					<div class='well article'>
						<div class='row'>
							<div class='col-md-12 col-lg-12'>
								<div class="meta">
									<span class="date" itemprop="datePublished" content='<?PHP echo $a_date; ?>'><i class="fa fa-calendar"></i><?PHP echo TanggalIndonesiaString($a_date). " - $a_time"; ?></span>
									<span class="author" itemprop="author"><i class="fa fa-user"></i>By <?PHP echo $db->_author_this_post($a_id); ?></span>
									<span class="tag" itemprop="keywords"><i class="fa fa-tags"></i><?PHP echo $db->_get_category($a_cat); ?></span>
								</div>
								<hr>
								<div class='col-md-5 col-sm-4 col-xs-5'>
									<img itemprop="image" src="<?PHP echo $a_image ?>" class="img-responsive" width='100%'>
								</div>
								<div style='margin-left:20px' class='text-justify'>
									<?PHP echo $a_shoot; ?>
								</div>
								<div id='readmore' style='min-height:30px;margin-top:10px'>
									<a class="btn btn-primary pull-right" rel="bookmark" href="<?PHP echo $app->get_link($a_link); ?>">Selngkapnya... <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
							</div>
						</div>
					</div>
					<?PHP
					}
					?>
				</div>
                <!-- Pagination -->
				<div class="bp-docs-example" style='margin-top:0px'>
					<div class="pagination">
						<ul class='pagination'>
							<?PHP
							if(isset($page)){
							$totalPages = ceil($total_artikel / $c_perpage);
							if ($totalPages == 0){
							$totalPages = 1;
							}
							$show_page = 7;
							$i=1;
							if($page <=1 ){
							echo "<li class='active'><a title='NOW IS FIRTS PAGE' class='tipsy-atas'>Firts</a></li>";
							echo "<li class='active'><a title='NOW IS FIRTS PAGE' class='tipsy-atas'>Next</a></li>";
							}
							else{
							$j = $page - 1;
							echo "<li><a title='GOTO FIRTS PAGE' class='tipsy-atas' href='$paging/1'>Firts</a></li>";
							echo "<li><a title='GOTO PREV PAGE' class='tipsy-atas' href='$paging/$j'>Prev</a></li>";
							}
							
							if ($page >= $show_page){
							$total_prev = $page - 3; #4 5 6 7 8 9 10
							$total_next = $page + 3; #10
							if ($total_next >= $totalPages){
							$total_next = $totalPages;
							$total_prev = $total_next - 6;
							}
							$i = $total_prev;
							while ($i <= $total_next){
							if($i<>$page){
							echo "<li><a title='GOTO PAGE $i' class='tipsy-atas' href='$paging/$i'>$i</a></li>";
							}
							else{
							echo "<li class='active'><a title='NOW IS PAGE $i' class='tipsy-atas'>$i</a></li>";
							}
							$i++;
							}
							}else{
							while($i <= $show_page and $i < $totalPages + 1){
							
							if($i<>$page){
							echo "<li><a title='GOTO PAGE $i' class='tipsy-atas' href='$paging/$i'>$i</a></li>";
							}
							else{
							echo "<li class='active'><a title='NOW IS PAGE $i' class='tipsy-atas'>$i</a></li>";
							}
							$i++;
							}
								
							}
							if($page == $totalPages){
							echo "<li class='active'><a title='NOW IS LAST PAGE' class='tipsy-atas'>Next</a></li>";
							echo "<li class='active'><a title='NOW IS LAST PAGE' class='tipsy-atas'>Last</a></li>";
							}
							else{
							$j = $page + 1;
							echo "<li><a title='GOTO NEXT PAGE' class='tipsy-atas' href='$paging/$j'>Next</a></li>";
							echo "<li><a title='GOTO LAST PAGE' class='tipsy-atas' href='$paging/$totalPages'>Last</a></li>";
							}
								
							}
							?>
						</ul>
					</div>
				</div>
            </div>
			<?PHP 
			if ($posisi_widget == "right"){
			echo "<div class='col-md-4 col-lg-4'>";
				require_once(TEMPLATE_DIR."/widget.php");
			echo "</div>";
			}
			?>
        </div>
    </div>
    <!-- /.container -->