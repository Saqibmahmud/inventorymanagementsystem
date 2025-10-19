 
  @extends('layout.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
    <div class="card shadow-lg text-center p-4" style="width: 400px;">
        <div class="card-body">
            <h1 class="card-title mb-4">Welcome to Inventory System</h1>
            <p class="card-text mb-4">Manage your brands, products, and sales efficiently</p>

            <a href="{{ route('login') }}" class="btn btn-primary btn-block mb-2">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-success btn-block">
                <i class="fas fa-user-plus"></i> Create Account
            </a>
        </div>
    </div>
</div>
@endsection
