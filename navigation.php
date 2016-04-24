<!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Skate View</a>
				<?php if (isset($_SESSION['user_name'])) echo "<span style=\"color:lightblue;\">".$_SESSION['user_name']."</span>"; ?>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="add_park.php">New Park</a>
                    </li>
                    <li>
                        <a href="search_parks.php">Parks Nearby</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
					<?php
					/*
						If the user is logged in, link to the logout page
						If not logged in, link to the login page
					*/
					if (isset($_SESSION['user_wk'])) // logged in
					{
						echo "
						<li>
							<a href=\"user_logout.php\">Logout</a>
						</li>
						";
					}
					else // not logged in
					{
						echo "
						<li>
							<a href=\"user_login.php\">Login</a>
						</li>
						";
					}
					?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
