@extends('layout.app')
@section('content')
<div class="container mt-5">
    <h4>Select a Branch</h4>
    <form method="POST" action="{{ route('branches.set') }}">
        @csrf
        <div class="form-group">
            <label for="branch_id">Branch</label>
            <select name="branch_id" id="branch_id" class="form-control" required>
                <option value="">-- Select Branch --</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>  
        <button type="submit" class="btn btn-primary mt-3">Continue</button>
    </form>
</div>  
@endsection