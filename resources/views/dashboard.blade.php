@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">Dashboard</h4>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Logout
                </button>
            </form>
        </div>
        <div class="card-body text-center">
            @if(auth()->user()->usertype === 'admin')
                <h5 class="mb-3">Admin Quick Links</h5>
                <a href="{{ route('menu.manage') }}" class="btn btn-success me-2">
                    Manage Menus
                </a>
                <a href="{{ route('customers.index') }}" class="btn btn-info">
                    View Customers
                </a>
            @else
                <h5 class="mb-3">User Quick Links</h5>
                <a href="{{ route('menu.pax') }}" class="btn btn-success me-2">
                    Enter Pax & Budget
                </a>
                <a href="{{ route('customers.create') }}" class="btn btn-info">
                    Enter Customer Info
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
