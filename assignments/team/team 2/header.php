<div class="row">
	<ul class="main-nav">
		<li>
			<a href="home.php"<?php
					if($_SERVER['PHP_SELF'] == '/assignments/team/team 2/home.php') 
					{
						echo "style=\"color:yellow\"";
					}
				?>>
				HOME
			</a>
		</li>

		<li>
			<a href="about-us.php"<?php
					if($_SERVER['PHP_SELF'] == '/assignments/team/team 2/about-us.php') 
					{
						echo "style=\"color:yellow\"";
					}
				?>>ABOUT US</a>
		</li>

		<li>
			<a href="login.php"<?php
					if($_SERVER['PHP_SELF'] == '/assignments/team/team 2/login.php') 
					{
						echo "style=\"color:yellow\"";
					}
				?>>LOGIN</a>
		</li>
	</ul>
</div>