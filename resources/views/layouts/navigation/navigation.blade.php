<ul class="main-menu">

	@can("dashboard-index")
	<li class="slide__category">
		<span class="category-name">Home</span>
	</li>

	<li class="slide {{ isActive("dashboard") ? "active" : null }}">
		<a href="{{ route("dashboard") }}" class="side-menu__item {{ isActive("dashboard") ? "active" : null }}">
			<i class="ti ti-dashboard side-menu__icon"></i>
			<span class="side-menu__label">Dashboard</span>
		</a>
	</li>
	@endcan

	@if (isLabel("event-index") || isLabel("sms-index"))
	<li class="slide__category">
		<span class="category-name">Announcements</span>
	</li>
	@endif

	@can("event-index")
	<li class="slide {{ isActive("events.index") ? "active" : null }}">
		<a href="{{ route("events.index") }}" class="side-menu__item {{ isActive("events.index") ? "active" : null }}"">
			<i class="ti ti-calendar-event side-menu__icon"></i>
			<span class="side-menu__label">Events</span>
		</a>
	</li>
	@endcan

	@can("sms-index")
	<li class="slide {{ isActive("sms.index") ? "active" : null }}">
		<a href="{{ route("sms.index") }}" class="side-menu__item {{ isActive("sms.index") ? "active" : null }}">
			<i class="ti ti-message-2 side-menu__icon"></i>
			<span class="side-menu__label">SMS</span>
		</a>
	</li>
	@endcan

	@if (isLabel("purok-index") || isLabel("position-index") || isLabel("resident-index") || isLabel("purok-leader-index"))
	<li class="slide__category">
		<span class="category-name">Informations</span>
	</li>
	@endif

	@can("purok-index")
	<li class="slide {{ isActive("puroks.index") ? "active" : null }}">
		<a href="{{ route("puroks.index") }}" class="side-menu__item {{ isActive("puroks.index") ? "active" : null }}">
			<i class="ti ti-map-pin side-menu__icon"></i>
			<span class="side-menu__label">Purok</span>
		</a>
	</li>
	@endcan

	@can("position-index")
	<li class="slide {{ isActive("positions.index") ? "active" : null }}">
		<a href="{{ route("positions.index") }}" class="side-menu__item {{ isActive("positions.index") ? "active" : null }}">
			<i class="ti ti-section side-menu__icon"></i>
			<span class="side-menu__label">Position</span>
		</a>
	</li>
	@endcan

	@can("resident-index")
	<li class="slide {{ isActive("residents.index|residents.create|residents.edit|residents.show") ? "active" : null }}">
		<a href="{{ route("residents.index") }}" class="side-menu__item {{ isActive("residents.index|residents.create|residents.edit|residents.show") ? "active" : null }}">
			<i class="ti ti-users side-menu__icon"></i>
			<span class="side-menu__label">Residents</span>
		</a>
	</li>
	@endcan

	@can("purok-leader-index")
	<li class="slide has-sub {{ isActive("purok-leaders.index|purok-leaders.active") ? "active open" : null }}">
		<a href="javascript:void(0);" class="side-menu__item {{ isActive("purok-leaders.index|purok-leaders.active") ? "active" : null }}">
			<i class="ti ti-map-2 side-menu__icon"></i>
			<span class="side-menu__label">Purok Leaders</span>
			<i class="ti ti-chevrons-right side-menu__angle"></i>
		</a>
		<ul class="slide-menu child1">
			<li class="slide side-menu__label1">
					<a href="javascript:void(0)">Purok Leaders</a>
			</li>
			<li class="slide {{ isActive("puroks-leaders.active") ? "active" : null }}">
				<a href="{{ route("purok-leaders.active") }}" class="side-menu__item {{ isActive("purok-leaders.active") ? "active" : null }}">Active Purok Leaders</a>
			</li>
			<li class="slide {{ isActive("purok-leaders.index") ? "active" : null }}">
				<a href="{{ route("purok-leaders.index") }}" class="side-menu__item {{ isActive("purok-leaders.index") ? "active" : null }}">Manage Purok Leaders</a>
			</li>
		</ul>
	</li>
	@endcan

	@can("blotter-index")
	<li class="slide__category">
		<span class="category-name">Incident</span>
	</li>

	<li class="slide {{ isActive("blotters.index|blotters.create|blotters.edit") ? "active" : null }}">
		<a href="{{ route("blotters.index") }}" class="side-menu__item {{ isActive("blotters.index|blotters.create|blotters.edit") ? "active" : null }}">
			<i class="ti ti-clipboard-text side-menu__icon"></i>
			<span class="side-menu__label">Blotter</span>
		</a>
	</li>
	@endcan

	@can("barangay-official-index")
	<li class="slide__category">
		<span class="category-name">Barangay Officials</span>
	</li>

	<li class="slide has-sub {{ isActive("officials.index|officials.active") ? "active open" : null }}">
		<a href="javascript:void(0);" class="side-menu__item {{ isActive("officials.index|officials.active") ? "active" : null }}">
			<i class="ti ti-user-circle side-menu__icon"></i>
			<span class="side-menu__label">Officials</span>
			<i class="ti ti-chevrons-right side-menu__angle"></i>
		</a>
		<ul class="slide-menu child1">
			<li class="slide side-menu__label1">
					<a href="javascript:void(0)">Officials</a>
			</li>
			<li class="slide {{ isActive("officials.active") ? "active" : null }}">
				<a href="{{ route("officials.active") }}" class="side-menu__item {{ isActive("officials.active") ? "active" : null }}">Active Officials</a>
			</li>
			<li class="slide {{ isActive("officials.index") ? "active" : null }}">
				<a href="{{ route("officials.index") }}" class="side-menu__item {{ isActive("officials.index") ? "active" : null }}">Manage Officials</a>
			</li>
		</ul>
	</li>
	@endcan

	@if (isLabel("clearance-certificate") || isLabel("birth-certificate") || isLabel("large-cattle-certificate") || isLabel("residence-certificate") || isLabel("residence-sports-certificate"))
	<li class="slide__category">
		<span class="category-name">Forms</span>
	</li>

	<li class="slide has-sub {{ isActive("certificate.index|certificate.birth|certificate.cattle|certificate.residence|certificate.sports") ? "active open" : null }}">
		<a href="javascript:void(0);" class="side-menu__item {{ isActive("certificate.index|certificate.birth|certificate.cattle|certificate.residence|certificate.sports") ? "active" : null }}">
			<i class="ti ti-forms side-menu__icon"></i>
			<span class="side-menu__label">Certificate</span>
			<i class="ti ti-chevrons-right side-menu__angle"></i>
		</a>
		<ul class="slide-menu child1">
			<li class="slide side-menu__label1">
					<a href="javascript:void(0)">Certificate</a>
			</li>
			@can("clearance-certificate")
			<li class="slide {{ isActive("certificate.index") ? "active" : null }}">
				<a href="{{ route("certificate.index") }}" class="side-menu__item {{ isActive("certificate.index") ? "active" : null }}">Clearance</a>
			</li>
			@endcan
			@can("birth-certificate")
			<li class="slide {{ isActive("certificate.birth") ? "active" : null }}">
				<a href="{{ route("certificate.birth") }}" class="side-menu__item {{ isActive("certificate.birth") ? "active" : null }}">Birth Certificate</a>
			</li>
			@endcan
			@can("large-cattle-certificate")
			<li class="slide {{ isActive("certificate.cattle") ? "active" : null }}">
				<a href="{{ route("certificate.cattle") }}" class="side-menu__item {{ isActive("certificate.cattle") ? "active" : null }}">Large Cattle</a>
			</li>
			@endcan
			@can("residence-certificate")
			<li class="slide {{ isActive("certificate.residence") ? "active" : null }}">
				<a href="{{ route("certificate.residence") }}" class="side-menu__item {{ isActive("certificate.residence") ? "active" : null }}">Residence Certificate</a>
			</li>
			@endcan
			@can("residence-sports-certificate")
			<li class="slide {{ isActive("certificate.sports") ? "active" : null }}">
				<a href="{{ route("certificate.sports") }}" class="side-menu__item {{ isActive("certificate.sports") ? "active" : null }}">Residence Sports Certificate</a>
			</li>
			@endcan
		</ul>
	</li>
	@endif

	@can("transaction-index")
	<li class="slide__category">
		<span class="category-name">Reports</span>
	</li>

	<li class="slide {{ isActive("transactions.index") ? "active" : null }}">
		<a href="{{ route("transactions.index") }}" class="side-menu__item {{ isActive("transactions.index") ? "active" : null }}">
			<i class="ti ti-license side-menu__icon"></i>
			<span class="side-menu__label">Transactions</span>
		</a>
	</li>
	@endcan

</ul>