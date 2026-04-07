@extends('layouts.smk.app')

@section('title', ($prestasi->title ?? 'Prestasi') . ' — ' . ($schoolModel->name ?? 'SMK Putra Pakuan'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags((string)($prestasi->excerpt ?? $prestasi->content ?? 'Prestasi unggulan SMK Putra Pakuan.')), 160))

@section('content')
@include('partials.unit-prestasi-detail')
@endsection
