@extends('layouts.SMK.ppdb')

@section('ppdb-content')
@php
    $step2Label = 'Pilihan Jurusan & Berkas';
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

