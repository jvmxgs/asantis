@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fas fa-user-plus"></i> {{ trans('asantis.Join to') }} {{ config('app.name', 'Asantis') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            <div class="col-sm-12 col-md-8">
                                <h3>{{ __('I am a') }}</h3>
                                <input type="hidden" value="{{ old('role') }}" name="role" id="role" />
                            </div>

                            <div class="col-sm-12 col-md-8 d-flex justify-content-center">

                                <div class="btn-group" role="group" data-toggle="button">
                                    <button type="button" class="btn btn-gray btn-gray-company">
                                        <i class="fas fa-user fa-7x"></i>
                                        <span class="">{{ trans('asantis.Company') }}</span>
                                    </button>
                                    <button type="button" class="btn btn-gray btn-gray-carrier">
                                      <i class="fas fa-truck fa-7x"></i>
                                      <span>{{ trans('asantis.Carrier') }}</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div id="hiddenForm" class="hide">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register me') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
$(document).ready(function() {
    @if(!$errors->any())
        $("#hiddenForm").hide();
    @endif
    });

    $(".btn-gray").click(function() {
        $("#hiddenForm").slideDown();
    });

    $(".btn-gray-company").click(function() {
        $("#role").val("company");
        $(".btn-gray-company").fadeTo( "slow", 1 );
        $(".btn-gray-carrier").fadeTo( "slow", 0.33 );
        console.log($("#role").val());
    });

    $(".btn-gray-carrier").click(function() {
        $("#role").val("carrier");
        $(".btn-gray-carrier").fadeTo( "slow", 1 );
        $(".btn-gray-company").fadeTo( "slow", 0.33 );
        console.log($("#role").val());
    });

</script>

@endsection
