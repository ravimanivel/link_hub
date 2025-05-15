@extends('layouts.nav')
@section('content')
    @if (Session::has('login_success'))
    @else
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card shadow">
                    <div class="card-header text-white" style="background-color:#5161ce">
                        <h4 class="mb-0">Manage Links</h4>
                    </div>
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn text-center" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="text-center mb-4">Add New Link</h5>
                        <form action="{{ route('links.store') }}" method="post">
                            @csrf
                            <div class="row g-3">
                                <!-- Link Title -->
                                <div class="col-md-6 mt-2">
                                    <label for="link" class="form-label">Link Title</label>
                                    <input type="text" class="form-control" name="link_title" id="link_title" required>
                                </div>

                                <!-- Link -->
                                <div class="col-md-6 mt-2">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="url" class="form-control" name="link" id="link" required>
                                </div>

                                <!-- Link Description -->
                                <div class="col-md-6 mt-2">
                                    <label for="link_description" class="form-label">Link Description</label>
                                    <input type="text" class="form-control" name="link_description" value=" "
                                        id="link_description">
                                </div>

                                <!-- Link Images -->
                                <div class="col-md-6 mt-2">
                                    <label for="link_images" class="form-label">Link Image URL</label>
                                    <input type="text" class="form-control" name="link_images" value=" " id="link_images">
                                </div>

                                <!-- Created By -->
                                <div class="col-md-6 mt-2">
                                    <label for="link_created_by" class="form-label">Created By</label>
                                    <input type="text" class="form-control" name="link_created_by" id="link_created_by"
                                        value="{{ $user_email ?? '-'}}" readonly>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-2 text-end">
                                    <button type="submit" class="btn btn-primary">Submit Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center mb-4">Uploaded Link</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle text-nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Link Title</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Delete</th>
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
                                            <td>{{ $creator->email ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($link->created_at)->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <form action="{{ route('links.delete') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $link->id }}">
                                                    <button type="submit" class="btn btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                        </svg>
                                                    </button>
                                                </form>
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
    </div>
@endsection
