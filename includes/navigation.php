<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    Developer Discussions
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
					<?php
						if(is_logged_in()){
					?>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><?= $user_data['name'] ?>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a class="nav-link" href="logout.php">Log out</a></li>
								</ul>
                            </li>
                        
                    </ul>
					
					<?php
						}else{
							
					?>
					
						<ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
							
							<li class="nav-item">
                                <a class="nav-link" href="login.php">
									Login
								</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">
									Register
								</a>
                            </li>
                        
                    </ul>
					
					<?php
						}
					?>
                </div>
            </div>
        </nav>