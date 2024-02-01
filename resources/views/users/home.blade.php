@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    {{ __('User Profile') }} <a href="{{ route('profile.edit') }}"
                                        class="btn btn-primary float-end ajax-click-page">{{ __('Update Profile') }}</a>
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <h3>Welcome {{ auth()->user()->username ?? '' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
