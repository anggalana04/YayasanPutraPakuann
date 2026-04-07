@extends('layouts.SMP.app')

@section('title', ($prestasi->title ?? 'Prestasi') . ' — ' . ($schoolModel->name ?? 'SMP Putra Pakuan'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags((string)($prestasi->excerpt ?? $prestasi->content ?? 'Prestasi unggulan SMP Putra Pakuan.')), 160))

@section('content')
@include('partials.unit-prestasi-detail')
@endsection
