<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Homepage";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;
	
	// include header
	require_once "header.php";
	
?>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            Sample Skatepark Post
                        </h2>
                        <h3 class="post-subtitle">
                          Example Description
                        </h3>
                    </a>
                    <p class="post-meta">Posted by.. <a href="#">John Doe</a> on September 24, 2014</p>
                </div>
                <hr>

                <hr>

                <hr>

                <hr>
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<?php 
	
	// include footer
	require_once "footer.php"; 
	
?>
