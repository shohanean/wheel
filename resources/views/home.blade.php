@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    ভাগ্যবানদের তালিকা
                </div>

                <div class="card-body">
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
                                    <td>{{ $wheel->created_at->diffforhumans() }}</td>
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
