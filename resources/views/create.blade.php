@extends(config('modules.is_module_layout') == true ? "lawyerdirectory::layouts.master" : 'layouts.master', ['backendLayout' => config('modules.is_backend_layout')])

@section('header-title', "Create lawyerdirectory")
@section('content')
    <h1>Create Blade</h1>

    <p>Module: {!! config('lawyerdirectory.config.name') !!}</p>
@endsection
