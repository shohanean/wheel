@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($wheels as $wheel)
                        <span class="badge bg-success">{{ $wheel->phone_number }}</span>
                        <p>Code: {{ $wheel->code }}</p>
                        <p>Status: {{ $wheel->used_status }}</p>
                        <p>Discount: {{ $wheel->discount }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
