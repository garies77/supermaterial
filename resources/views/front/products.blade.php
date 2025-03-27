@extends('layouts.main')

@section('title', 'Products - Cozy Modern Furniture Store')

@section('content')
    <section class="pt-32 pb-12 px-4 bg-gray-50">
        <div class="container mx-auto max-w-6xl">
            {!! $webInfo->product !!}
        </div>
    </section>

    <section class="container mx-auto max-w-6xl px-4 py-8">
        @livewire('product-listing')
    </section>
@endsection
