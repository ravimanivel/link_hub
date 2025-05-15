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
                        <h4 class="mb-0">Profile</h4>
                    </div>
                    <div class="card-body">
                    <h5 class="text-center mb-4">User Profile Details</h5>

                        <div class="row">
                            @foreach($profile_det as $profile)
                                <div class="col-md-6 col-lg-12 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm " style="border-color:#5161ce">
                                        <div class="card-header text-white"  style="background-color:#5161ce">
                                            Username :  <strong>{{ ucfirst($profile['username']) }}</strong>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Name:</strong> {{ $profile['name'] }}</p>
                                            <p><strong>Email:</strong> {{ $profile['email'] }}</p>
                                            <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($profile['created_at'])->format('d-m-Y H:i') }}</p>
                                            <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($profile['updated_at'])->format('d-m-Y H:i') }}</p>
                                            <p><strong>Email Verified:</strong>
                                                @if($profile['email_verified_at'])
                                                    Verified
                                                @else
                                                    Not Verified
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
