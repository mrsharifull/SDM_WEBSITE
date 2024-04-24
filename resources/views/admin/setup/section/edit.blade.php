@extends('admin.layouts.master', ['pageSlug' => 'section'])
@section('title', 'Edit Section')
@section('content')
    <div class="row px-3 pt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <h4 class="card-title">{{ __('Edit Section') }}</h4>
                        </div>
                        <div class="col-6 col-md-4 text-right">
                            @include('admin.partials.button', [
                                'routeName' => 'setup.section.section_list',
                                'className' => 'btn-primary',
                                'label' => 'Back',
                            ])
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('setup.section.section_edit',$section->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>{{ __('Class') }}</label>
                            <select name="class_id" class="form-control {{ $errors->has('class_id') ? ' is-invalid' : '' }}">
                                <option selected hidden>{{ __('Select Class') }}</option>
                                @foreach ($classes as $class)
                                    <option {{ $section->class_id == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                        {{ $class->name }}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'class_id'])
                        </div>
                        <div class="form-group">

                            <label>{{__('Name')}}</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter name"
                                value="{{ $section->name }}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
