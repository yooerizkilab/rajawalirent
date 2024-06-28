@extends('layouts.auth.app',[
'title' => 'Login'
])

@section('content')
<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Rajawali Rent !</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input name="email" required="" type="email" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid':'' }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="form-group">
                                    <input name="password" required="" type="password" class="form-control form-control-user {{ $errors->has('password') ? 'is-invalid':'' }}"" id=" exampleInputPassword" placeholder="Password">
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div> -->
                                <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection