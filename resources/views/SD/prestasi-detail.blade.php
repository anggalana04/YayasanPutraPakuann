@extends('layouts.SD.app')

@section('title', ($prestasi->title ?? 'Prestasi') . ' — ' . ($schoolModel->name ?? 'SD Putra Pakuan'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags((string)($prestasi->excerpt ?? $prestasi->content ?? 'Prestasi unggulan SD Putra Pakuan.')), 160))

@section('content')
@include('partials.unit-prestasi-detail')
@endsection
