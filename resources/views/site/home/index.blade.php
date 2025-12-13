@extends('layout.app-site')
@section('title', $title)

@section('content')
    <x-site.home.cat-banner />

    {{-- <x-site.home.testimonial /> --}}

    <x-site.home.popular-category :categories="$categories" />


    <x-site.home.display-product :products="$products" />

    {{-- <x-site.home.explore /> --}}

    <x-site.home.iconbox />

    {{-- <x-site.home.special-banner /> --}}
@endsection
