<div class="p-3">
    <h5 class="fw-bold">Menu</h5>
    <ul class="menu list-unstyled">
        <li><a href="#" class="text-dark d-block py-1 text-decoration-none">Dashboard</a></li>
        <li><a href="{{ url('/') }}" class="d-block py-1 {{ Request::is('/')|| Request::is('check-score') ? 'fw-bold' : 'text-dark' }} text-decoration-none" >Search Scores</a></li>
        <li><a href="{{ route('report') }}" class="d-block py-1 {{ Route::currentRouteName() == 'report' ? 'fw-bold' : 'text-dark' }} text-decoration-none">Reports</a></li>
        <li><a href="#" class="text-dark d-block py-1 text-decoration-none">Settings</a></li>
    </ul>
</div>
