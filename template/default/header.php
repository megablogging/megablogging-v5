<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
			<?PHP
			$sql_menu = "select * from menu order by menu.number ASC";
			$result_menu = $db->num_rows($sql_menu);
			if ($result_menu != 0){
				$q_data_menu = $db->fetch_multiple($sql_menu);
				foreach ($q_data_menu as $data_menu){
					$menu_id = $data_menu['id'];
					$menu_name = $data_menu['name'];
					$menu_link = $data_menu['link'];
					$menu_link = str_replace('$url_gue', $c_url, $menu_link);
					$menu_type = $data_menu['type'];
					$menu_target = $data_menu['target'];
					#for the type if 1 is only 1 menu. but if type is 2 so it have some submenu
					if ($menu_type == 1){
						echo "<li><a href='$menu_link' target='$menu_target'>$menu_name</a></li>";
					}
					else{
						$sql_submenu = "select * from submenu where menu='$menu_id'";
						$result_submenu = $db->num_rows($sql_submenu);
						echo "
						<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='$menu_link'>$menu_name <dewa class='fa fa-angle-down'></dewa></a>
						<ul class='dropdown-menu'>
						";
						if ($result_submenu != 0){
							$q_data_submenu = $db->fetch_multiple($sql_submenu);
							foreach ($q_data_submenu as $data_submenu){
								$submenu_id = $data_submenu['id'];
								$submenu_name = $data_submenu['name'];
								$submenu_link = $data_submenu['link'];
								$submenu_link = str_replace('$url_gue', $c_url, $submenu_link);
								$submenu_target = $data_submenu['target'];
								echo "
								<li><a href='$submenu_link' target='$submenu_target'>$submenu_name</a></li> 
								";
							}
						}
						echo "</li></ul>";
					}
				}
			}
			?>
        </ul>
		<ul class='pull-right'>
		<form action='<?PHP echo "$c_url/search.php"; ?>' method='get' class='hidden-sm hidden-xs'>
			<div class="input-group" style='width:160px;margin-top:5px;margin-bottom:-5px'>
                    <input class="form-control" reqired type="text" name='keyword' placeholder='Search...'>
                    <span class="input-group-btn">
                      <button class="btn btn-default"><i class='fa fa-search'></i></button>
                    </span>
            </div>
		</form>
		</ul>
        </div>
      </div>
    </div>