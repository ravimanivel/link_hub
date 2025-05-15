@extends('layouts.nav')
@section('content')
@if(Session::has('login_success'))

@else
<script>window.location.href = "{{ route('login') }}";</script>
@endif
<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color:#5161ce">
                    <h4 class="mb-0">Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <h5>Total Links</h5>
                                <h3>{{ $totalLinks }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <h5>Total Views</h5>
                                @foreach ($totalViews as $total)
                                    <h3>{{ $total->views }}</h3>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <h5>Top 5 Clicked Links</h5>
                                <ul class="list-unstyled">
                                    @foreach($mostClicked as $link)
                                        <li>{{ $link->link_title }} <span class="badge bg-primary" style="color:white;">{{ $link->views }} views</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">

                            <p class="alert alert-info"> Your Public Link <a href="{{ env('APP_URL') }}/{{ $user_name }}" target="_blank">{{ env('APP_URL') }}/{{ $user_name }}</a></p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mt-5">
                <div class="card-header text-white" style="background-color:#5161ce">
                    <h4 class="mb-0">links</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Link Title</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Views</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id =0;
                                    @endphp
                                    @foreach($lin_det as $link)
                                         @php
                                        $id++;
                                    @endphp
                                        @php $creator = json_decode($link->username); @endphp
                                        <tr>
                                            <td>{{ $id }}</td>

                                            <td>{{ $link->link_title ?? '-' }}</td>
                                            <td style="max-width: 200px;">
                                                <a href="{{ $link->link }}" target="_blank" class="d-inline-block text-truncate" style="max-width: 100%;">
                                                    {{ $link->link }}
                                                </a>
                                            </td>

                                            <td>{{ $link->link_description ?? '-' }}</td>
                                            <td>
                                                @if($link->link_images)
                                                    <img src="{{ $link->link_images }}" alt="Link Image" class="img-thumbnail" width="60">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $link->views }}</td>
                                            <td>{{ \Carbon\Carbon::parse($link->created_at)->format('d-m-Y H:i') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <a href="{{ route('links.create') }}" class="btn btn-success">Add New Link</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


