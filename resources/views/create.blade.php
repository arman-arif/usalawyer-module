@extends(config('modules.is_module_layout') == true ? "lawyer::layouts.master" : 'layouts.master', ['backendLayout' => config('modules.is_backend_layout')])

@section('header-title', "Create lawyer")
@section('content')
    <h1>Create Blade</h1>

    <p>Module: {!! config('lawyer.config.name') !!}</p>
@endsection
