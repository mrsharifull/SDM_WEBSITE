@extends('admin.layouts.master', ['pageSlug' => 'permission'])

@section('content')
    <div class="row px-3 pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <h4 class="card-title">{{ __('Edit Permission') }}</h4>
                        </div>
                        <div class="col-6 col-md-4 text-right">
                            @include('admin.partials.button', [
                                'routeName' => 'am.permission.permission_list',
                                'className' => 'btn-primary',
                                'label' => 'Back',
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('am.permission.permission_edit',$permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">

                            <label>{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                value="{{ $permission->name }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group">
                            <label>{{__('Prefix')}}</label>
                            <input type="text" name="prefix" class="form-control {{ $errors->has('prefix') ? ' is-invalid' : '' }}" placeholder="Enter prefix"
                                value="{{ $permission->prefix }}">
                            @include('alerts.feedback', ['field' => 'prefix'])
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
