<div class="header-right">

    <form action="pages-search-results.html" class="search nav-form">
        <div class="input-group input-search">
            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <figure class="profile-picture">
                <img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
            </figure>
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                <span class="name">User</span>
                <span class="role">Login</span>
            </div>

            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li class="divider"></li>
                <li>
                    <a role="menuitem" tabindex="-1" href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="http://proyectof.test/user/profile"><i class="fa fa-user"></i> My Profile</a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="http://proyectof.test/logout"><i class="fa fa-power-off"></i> Salir</a>
                </li>
            </ul>
        </div>
    </div>
</div>
