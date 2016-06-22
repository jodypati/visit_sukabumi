<ul class="nav navbar-nav">
	
	<li><a href="{{ url('users') }}">Parent</a></li>
	<li><a href="{{ url('children') }}">Children</a></li>
	<li><a href="{{ url('attributes') }}">Atrributes</a></li>
	<li><a href="{{ url('vaccineHistory') }}">Vaccine History</a></li>
	<li><a href="{{ url('reminders') }}">Reminder</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
	@if(auth()->guest())
		@if(!Request::is('auth/login'))
			<!-- <li><a href="{{ url('/auth/login') }}">Login</a></li> -->
			<li><a href="{{ url('login') }}">Login</a></li>
		@endif
		@if(!Request::is('auth/register'))
			<li><a href="{{ url('/auth/register') }}">Register</a></li>
		@endif
	@else
		@if((Request::is('users') ||( Request::is('users/*') && !Request::is('users/create'))))
			<li><a href="{{ url('/users/create') }}">Add New Parent</a></li>
		@endif
		@if((Request::is('children') ||( Request::is('children/*') && !Request::is('children/create'))))
			<li><a href="{{ url('/children/create') }}">Add New Children</a></li>
		@endif

		@if((Request::is('attributes') ||( Request::is('attributes/*') && !Request::is('attributes/create'))))
			<li><a href="{{ url('/attributes/create') }}">Add New Attributes</a></li>
		@endif
		@if((Request::is('vaccineHistory') ||( Request::is('vaccineHistory/*') && !Request::is('vaccineHistory/create'))))
			<li><a href="{{ url('/vaccineHistory/create') }}">Add New Vaccine Histories</a></li>
		@endif
		@if((Request::is('reminders') ||( Request::is('reminders/*') && !Request::is('reminders/create'))))
			<li><a href="{{ url('/reminders/create') }}">Add New Reminder</a></li>
		@endif
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
			</ul>
		</li>
	@endif
</ul>