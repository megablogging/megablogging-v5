<?PHP
include(dirname(dirname(dirname(__FILE__)))."/config.php");
include(dirname(dirname(__FILE__))."/_session.php");
include(dirname(dirname(__FILE__))."/anti_xss.php");
error_reporting(0);
$max_per_table = $c_max_per_table;
$total = $db->num_rows("select date from statistik");
if ($total == 0){
	echo "No Data Found!";
	exit();
}
if (isset($_POST['action'])){
	$action = $_POST['action'];
	$action_val = '"'."$action".'"';
}else{
	$action = 'all_stats';
	$action_val = '"all_stats"';
}
if (isset($_POST['q'])){
	$q = $_POST['q'];
	$q_val = '"'.$q.'"';
}else{
	$q = "";
}
if (empty($q)){
	$action = 'all_stats';
	$action_val = '"all_stats"';
}
?>
			<table class="table table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Hits</th>
                    </tr>
                  </thead>
                  <tbody>
				  <!-- mulai dari sini untuk type get statistiknya seperti apa -->
				  <?PHP
				  if ($action == "all_stats"){
				  ?>
				  <?PHP
					if(isset($_POST["page"])){
						$page = abs((int)$_POST["page"]);
						$no = 1 + $max_per_table * $page - $max_per_table;
					}
					else{
						$page = 1;
						$no = 1;
					}
					$calc = $max_per_table * $page;
					$start = $calc - $max_per_table;
					$data_art = $db->select('statistik', "date, hits", null, "statistik.date DESC", "$start, $max_per_table");
					foreach ($data_art as $data){
				  ?>
                   <tr>
                      <td><?PHP echo $data['date']; ?></td>
                      <td><?PHP echo $data['hits']." Times"; ?></td>
                    </tr>
				   <?PHP
				    $no++;
					}
				   ?>
                  </tbody>
                </table>
							<div class="bp-docs-example" style='margin-top:-30px;cursor:pointer;'>
									<div class="pagination">
									<ul class='pagination'>
										<?PHP
										if(isset($page)){
										$totalPages = ceil($total / $max_per_table);
										if ($totalPages == 0){
										$totalPages = 1;
										}
										$show_page = 7;
										$i=1;
										if($page <=1 ){
										echo "<li class='active'><a title='NOW IS FIRTS PAGE' class='tipsy-atas'>Firts</a></li>";
										}
										else{
										$j = $page - 1;
										echo "<li><a title='GOTO FIRTS PAGE' class='tipsy-atas' onclick='changePagination(1, $action_val)'>Firts</a></li>";
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
										echo "<li><a title='GOTO PAGE $i' class='tipsy-atas' onclick='changePagination($i, $action_val)'>$i</a></li>";
										}
										else{
										echo "<li class='active'><a title='NOW IS PAGE $i' class='tipsy-atas'>$i</a></li>";
										}
										$i++;
										}
										}else{
										while($i <= $show_page and $i < $totalPages + 1){
										
										if($i<>$page){
										echo "<li><a title='GOTO PAGE $i' class='tipsy-atas' onclick='changePagination($i, $action_val)'>$i</a></li>";
										}
										else{
										echo "<li class='active'><a title='NOW IS PAGE $i' class='tipsy-atas'>$i</a></li>";
										}
										$i++;
										}
										
										}
										if($page == $totalPages){
										echo "<li class='active'><a title='NOW IS LAST PAGE' class='tipsy-atas'>Last</a></li>";
										}
										else{
										$j = $page + 1;
										echo "<li><a title='GOTO NEXT PAGE' class='tipsy-atas' onclick='changePagination($j, $action_val)'>Next</a></li>";
										echo "<li><a title='GOTO LAST PAGE' class='tipsy-atas' onclick='changePagination($totalPages, $action_val)'>Last</a></li>";
										}
										
										}
										?>
									</ul>
									</div>
							</div>
						</ul>
						</div>
				</div>
				<?PHP
				}else if($action == 'search'){
				?>
				
				<!-- searching -->
				<?PHP
					if(isset($_POST["page"])){
						$page = abs((int)$_POST["page"]);
						$no = 1 + $max_per_table * $page - $max_per_table;
					}
					else{
						$page = 1;
						$no = 1;
					}
					$calc = $max_per_table * $page;
					$start = $calc - $max_per_table;
					$data_art = $db->select('statistik', "date, hits", "date like '%$q%'", "statistik.date DESC", "$start, $max_per_table");
					if (!is_array($data_art)){
						echo "No Data Found!";
						exit();
					}
					foreach ($data_art as $data){
				  ?>
                    <tr>
                      <td><?PHP echo $data['date']; ?></td>
                      <td><?PHP echo $data['hits']." Times"; ?></td>
                    </tr>
				   <?PHP
				    $no++;
					}
				   ?>
                  </tbody>
                </table>
							<div class="bp-docs-example" style='margin-top:-30px;cursor:pointer;'>
									<div class="pagination">
									<ul class='pagination'>
										<?PHP
										if(isset($page)){
										$total = $db->num_rows("select date from statistik where date like '%$q%'");
										$totalPages = ceil($total / $max_per_table);
										if ($totalPages == 0){
										$totalPages = 1;
										}
										$show_page = 7;
										$i=1;
										if($page <=1 ){
										echo "<li class='active'><a title='NOW IS FIRTS PAGE' class='tipsy-atas'>Firts</a></li>";
										}
										else{
										$j = $page - 1;
										echo "<li><a title='GOTO FIRTS PAGE' class='tipsy-atas' onclick='changePagination(1, $action_val, $q_val)'>Firts</a></li>";
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
										echo "<li><a title='GOTO PAGE $i' class='tipsy-atas' onclick='changePagination($i, $action_val, $q_val)'>$i</a></li>";
										}
										else{
										echo "<li class='active'><a title='NOW IS PAGE $i' class='tipsy-atas'>$i</a></li>";
										}
										$i++;
										}
										}else{
										while($i <= $show_page and $i < $totalPages + 1){
										
										if($i<>$page){
										echo "<li><a title='GOTO PAGE $i' class='tipsy-atas' onclick='changePagination($i, $action_val, $q_val)'>$i</a></li>";
										}
										else{
										echo "<li class='active'><a title='NOW IS PAGE $i' class='tipsy-atas'>$i</a></li>";
										}
										$i++;
										}
										
										}
										if($page == $totalPages){
										echo "<li class='active'><a title='NOW IS LAST PAGE' class='tipsy-atas'>Last</a></li>";
										}
										else{
										$j = $page + 1;
										echo "<li><a title='GOTO LAST PAGE' class='tipsy-atas' onclick='changePagination($totalPages, $action_val, $q_val)'>Last</a></li>";
										}
										}
										?>
									</ul>
									</div>
							</div>
						</ul>
						</div>
				</div>
				<?PHP } ?>