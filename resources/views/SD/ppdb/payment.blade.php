@extends('layouts.SD.ppdb')

@section('ppdb-content')
@php
    $step2Label = 'Berkas Dokumen';
@endphp
@include('partials.ppdb-payment-form', [
    'school'      => $school,
    'application' => $application,
    'homepage'    => $homepage ?? null,
    'step2Label'  => $step2Label,
])
@endsection

@section('ppdb-footer')
@endsection

