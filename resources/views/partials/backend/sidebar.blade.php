<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
		<a class="nav-link" href="{{ route('backend') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>{{ __('Dashboard') }}</span>
		</a>
	</li>

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-user-friends"></i>
			<span>{{ __('People Management') }}</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">{{ __('Basic:') }}</h6>
			<a class="dropdown-item" href="{{ route('users.index') }}">{{ __('Staffs') }}</a>
			<a class="dropdown-item" href="{{ route('suppliers.index') }}">{{ __('Suppliers') }}</a>
			<a class="dropdown-item" href="{{ route('consumers.index') }}">{{ __('Consumers') }}</a>
			<div class="dropdown-divider"></div>
			<h6 class="dropdown-header">{{ __('Related:') }}</h6>
			<a class="dropdown-item" href="{{ route('jobtitles.index') }}">{{ __('Job Titles') }}</a>
			<a class="dropdown-item" href="{{ route('discounts.index') }}">{{ __('Discounts') }}</a>
		</div>
	</li>

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-dolly-flatbed"></i>
			<span>{{ __('Stuffs Management') }}</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">{{ __('Basic:') }}</h6>
			<a class="dropdown-item" href="{{ route('materials.index') }}">{{ __('Materials') }}</a>
			<a class="dropdown-item" href="{{ route('products.index') }}">{{ __('Products') }}</a>
			<a class="dropdown-item" href="{{ route('produces.index') }}">{{ __('Produces') }}</a>
			<h6 class="dropdown-header">{{ __('Related:') }}</h6>
			<a class="dropdown-item" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
		</div>
	</li>

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fab fa-wpforms"></i>
			<span>{{ __('Orders Management') }}</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">{{ __('Basic:') }}</h6>
			<a class="dropdown-item" href="{{ route('purchase.index') }}">{{ __('Purchase Orders') }}</a>
			<a class="dropdown-item" href="{{ route('sales.index') }}">{{ __('Sales Orders') }}</a>
			<a class="dropdown-item" href="{{ route('return.index') }}">{{ __('Return Orders') }}</a>
            <a class="dropdown-item" href="{{ route('billing.index') }}">{{ __('Billing Statement') }}</a>
		</div>
	</li>

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>{{ __('System Management') }}</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">{{ __('Basic:') }}</h6>
			{{-- <a class="dropdown-item" href="#">{{ __('Web Setting') }}</a> --}}
			<a class="dropdown-item" href="{{ route('announcements.index') }}">{{ __('News') }}</a>
			<a class="dropdown-item" href="{{ route('contacts.index') }}">{{ __('Contacts') }}</a>
			<a class="dropdown-item" href="{{ route('information.edit', [1]) }}">{{ __('Information Image') }}</a>
			{{-- <a class="dropdown-item" href="#">{{ __('Log File') }}</a> --}}
		</div>
    </li>

	<li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-chart-bar"></i>
			<span>{{ __('Report') }}</span>
		</a>
		<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">{{ __('Sales Report') }}</h6>
			<a class="dropdown-item" href="{{ route('reports.sales.year') }}">{{ __('Annual Report') }}</a>
			<a class="dropdown-item" href="{{ route('reports.sales.daily') }}">{{ __('Daily Report') }}</a>
			{{-- <a class="dropdown-item" href="{{ route('reports.sales.profit') }}">{{ __('Gross Profit Report') }}</a> --}}
			<h6 class="dropdown-header">{{ __('Purchase Report') }}</h6>
			<a class="dropdown-item" href="{{ route('reports.purchase.year') }}">{{ __('Annual Report') }}</a>
			<a class="dropdown-item" href="{{ route('reports.purchase.daily') }}">{{ __('Daily Report') }}</a>
			<h6 class="dropdown-header">{{ __('Account Report') }}</h6>
			<a class="dropdown-item" href="{{ route('reports.account.payable') }}">{{ __('Accounts Payable Report') }}</a>
			<a class="dropdown-item" href="{{ route('reports.account.payable_daily.index') }}">{{ __('Accounts Payable Daily Report') }}</a>
			<a class="dropdown-item" href="{{ route('reports.account.receivable') }}">{{ __('Accounts Receivable Report') }}</a>
			<a class="dropdown-item" href="{{ route('reports.account.receivable_daily.index') }}">{{ __('Accounts Receivable Daily Report') }}</a>
		</div>
	</li>

</ul>
