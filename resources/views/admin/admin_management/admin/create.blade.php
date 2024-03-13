@extends('admin.layouts.master', ['pageSlug' => 'admin'])

@section('content')
    <div class="row px-3 pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <h4 class="card-title">{{ __('Create Admin') }}</h4>
                        </div>
                        <div class="col-6 col-md-4 text-right">
                            @include('admin.partials.button', [
                                'routeName' => 'am.admin.admin_list',
                                'className' => 'btn-primary',
                                'label' => 'Back',
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('am.admin.admin_create') }}">
                        @csrf
                        <div class="form-group">

                            <label>{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                value="{{ old('name') }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group">
                            <label>{{__('Email')}}</label>
                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter email"
                                value="{{ old('email') }}">
                            @include('alerts.feedback', ['field' => 'email'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Role') }}</label>
                            <select name="role" class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}">
                                <option selected hidden>{{ __('Select Role') }}</option>
                                @foreach ($roles as $role)
                                    <option {{ old('role') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'role'])
                        </div>
                        <div class="form-group">
                            <label>{{__('Password')}}</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter new password">
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{__('Confirm Password')}}</label>
                            <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                placeholder="Confirm password">
                            @include('alerts.feedback', ['field' => 'password_confirmation'])
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
