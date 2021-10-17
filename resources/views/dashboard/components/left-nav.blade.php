<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
	<div class="position-sticky pt-3">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link {{ Request::is("dashboard") ? "active" : "" }}" aria-current="page" href="/dashboard">
					<i class="me-2 bi bi-house"></i>
					Dashboard
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ Request::is("dashboard/post") ? "active" : "" }}" href="/dashboard/post">
					<i class="me-2 bi bi-camera-video"></i>
					Post a Video
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ Request::is("dashboard/account") ? "active" : "" }}" href="/dashboard/account">
					<i class="me-2 bi bi-person"></i>
					Account
				</a>
			</li>
			<li class="nav-item">
                <a class="nav-link d-md-none" href="/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
			</li>
		</ul>
	</div>
</nav>
