@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2 text-center mb-3">
            <div class="card">
                <div class="card-header bg-info">
                    Total
                </div>
                <div class="card-body">
                    <h4>{{ $wheels->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-center mb-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Used
                </div>
                <div class="card-body">
                    <h4>{{ $wheels->where('used_status', true)->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-center mb-3">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    Unused
                </div>
                <div class="card-body">
                    <h4>{{ $wheels->where('used_status', false)->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Summary
                </div>
                <div class="card-body">
                    @foreach (App\Models\Wheel::where('discount', '!=', NULL)->groupBy('discount')->selectRaw('count(*) as total, discount')->get() as $item)
                        <button type="button" class="btn btn-primary m-1">
                            {{ $item->discount }} <span class="badge bg-secondary">{{ $item->total }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    ভাগ্যবানদের তালিকা
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Interested In</th>
                                <th scope="col">Code</th>
                                <th scope="col">Used Status</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Code Generated At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wheels as $wheel)
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->index+1 }}</th>
                                    <td><i class="lni lni-phone"></i> {{ $wheel->phone_number }}</td>
                                    <td>
                                        <i class="{{ ($wheel->course_type == 'online') ? 'lni lni-headphone-alt':'lni lni-map' }}"></i>
                                        {{ $wheel->course_type }}
                                    </td>
                                    <td>
                                        <script>
                                            function copytoclipboard(e) {
                                                var copyText = e.value;
                                                navigator.clipboard.writeText(copyText);
                                            }
                                        </script>
                                        {{ $wheel->code }}
                                        <button value="{{ $wheel->code }}" onclick="copytoclipboard(this)" class="btn btn-outline-primary"><i class="lni lni-files"></i></button>
                                    </td>
                                    <td>
                                        @if ($wheel->used_status)
                                            <span class="badge bg-success">Used</span>
                                        @else
                                            <span class="badge bg-danger">Not Used Yet</span>
                                        @endif
                                    </td>
                                    <td>{{ $wheel->discount ?? '-' }}</td>
                                    <td>
                                        <div class="badge bg-info text-dark">
                                            {{ $wheel->created_at->timezone('Asia/Dhaka')->diffforhumans() }}
                                        </div>
                                        <br>
                                        Date: {{ $wheel->created_at->timezone('Asia/Dhaka')->format('d/m/Y') }}
                                        <br>
                                        Time: {{ $wheel->created_at->timezone('Asia/Dhaka')->format('H:i:s A') }}
                                    </td>
                                    <td>
                                        @if (!$wheel->used_status)
                                            <a href="{{ url('resend/code') }}/{{ $wheel->id }}" class="btn btn-sm btn-warning">Resend Code</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
