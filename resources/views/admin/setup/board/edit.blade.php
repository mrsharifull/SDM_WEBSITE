@extends('admin.layouts.master', ['pageSlug' => 'board'])
@section('title', 'Edit Board')
@section('content')
    <div class="row px-3 pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <h4 class="card-title">{{ __('Edit Board') }}</h4>
                        </div>
                        <div class="col-6 col-md-4 text-right">
                            @include('admin.partials.button', [
                                'routeName' => 'setup.board.board_list',
                                'className' => 'btn-primary',
                                'label' => 'Back',
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('setup.board.board_edit',$class->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">

                            <label>{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                value="{{ $class->name }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
