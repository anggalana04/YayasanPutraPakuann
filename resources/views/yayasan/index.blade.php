@extends('layouts.app')

@push('styles')
    <style type="text/tailwindcss">
        @layer utilities {
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            }
            .text-shadow-lg {
                text-shadow: 0 4px 8px rgba(0,0,0,0.5);
            }
        }
    </style>
@endpush

@section('content')
@if (!empty($pageContent))
    {!! $pageContent !!}
@else
    @include('yayasan.partials.hero')
    @include('yayasan.partials.principals')
    @include('yayasan.partials.unit-schools')
    @include('yayasan.partials.core-values')
    @include('yayasan.partials.achievements')
    @include('yayasan.partials.news-preview')
@endif
@endsection
