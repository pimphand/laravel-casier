@extends('layouts.app')
@section('page-header')
    @include('components.admin.page-header', [
        'breadcrumb' => [
            [
                'label' => 'Dashboard',
                'url' => route('dashboard'),
                'icon' => 'pe-7s-home',
            ],
        ],
    ])
@endsection

@section('content')

@endsection
