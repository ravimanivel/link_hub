@extends('layouts.admin')

@section('content')
@if(Session::has('login_success'))

@else
<script>window.location.href = "{{ route('login') }}";</script>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header   text-white" style="background-color:#5161ce">Admin Dashboard</div>

                <div class="card-body ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Total Users: {{ $userCount }}</p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i =1 ; @endphp
                            @foreach($user_det as $user)
                                <tr>
                                    <td>@php echo $i++ ; @endphp</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->views }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}" id="id">
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
@endsection
