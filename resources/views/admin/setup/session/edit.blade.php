@extends('admin.layouts.master', ['pageSlug' => 'session'])
@section('title', 'Edit Bloodgroup')
@section('content')
    <div class="row px-3 pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <h4 class="card-title">{{ __('Edit Session') }}</h4>
                        </div>
                        <div class="col-6 col-md-4 text-right">
                            @include('admin.partials.button', [
                                'routeName' => 'setup.session.session_list',
                                'className' => 'btn-primary',
                                'label' => 'Back',
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('setup.session.session_edit',$class->id) }}">
                        @csrf
                         
                        <div class="form-group">

                            <label>{{__('Session')}}</label>
                            <input type="text" name="session" class="form-control {{ $errors->has('session') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                value="{{ $class->session }}">
                            @include('alerts.feedback', ['field' => 'session'])
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
