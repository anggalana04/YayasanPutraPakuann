@extends('layouts.SMP.ppdb')

@section('title', 'Daftar SPMB SMP Putra Pakuan')
@section('meta_description', 'Daftar dan bayar biaya pendaftaran SPMB SMP Putra Pakuan untuk mendapatkan kode unik akses form pendaftaran.')

@section('ppdb-content')
@include('partials.ppdb-register-payment-form', [
    'school'      => $school,
    'schoolModel' => $schoolModel ?? null,
    'homepage'    => $homepage ?? null,
])
@endsection

@section('ppdb-footer')
@endsection