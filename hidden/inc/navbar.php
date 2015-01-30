		<div id="top-nav" class="fixed">
            <a target='_blank' href='http://www.megablogging.org' class='brand'>
                <span><img src='<?PHP echo "$c_url/mgb-dir/assets/favicon.png"; ?>' height='35px' style='s'/></span>
                <span class="text-toggle" style='font-size:15px'> Megablogging</span>
            </a>    <!-- END : brand -->

            <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> <!-- END : Mobile toggle -->

            <ul class="nav-notification clearfix">
                <li class="profile dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <strong><?PHP echo $a_name; ?></strong>
                        <span><i class="fa fa-chevron-down"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="clearfix" href="javascript:void(0);">
                                <img src="<?PHP echo $a_image; ?>" alt="User Avatar">
                                <div class="detail">
                                    <strong><?PHP echo $a_username; ?></strong>
                                    <p class="grey"><?PHP echo $a_email; ?></p> 
                                </div>
                            </a>
                        </li>
						<li><a target='_blank' tabindex="-1" href="<?PHP echo $c_url; ?>" ><i class="fs fs-search fa-lg"></i> View Site</a></li>
                        <li><a tabindex="-1" href="add_post.mgb" ><i class="fa fa-plus fa-lg"></i> Add New Post</a></li>
						<li><a tabindex="-1" href="setting.mgb" class="main-link"><i class="fa fa-cog fa-lg"></i> Configuration Website</a></li>
                        <li><a tabindex="-1" href="edit_me.mgb" class="main-link"><i class="fa fa-edit fa-lg"></i> Edit My profile</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="logout.mgb?i=true" class="main-link"><i class="fa fa-power-off fa-lg"></i> Sign out</a></li>
                    </ul>
                </li>
            </ul>
        </div>  <!-- END : top-nav-->