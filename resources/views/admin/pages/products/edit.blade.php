
@extends('admin.layouts.app')


@section('title', 'Editar Produto {{ $product->name }}')


@section('content')
    <h1>Editar produtos {{ $product->name }}</h1>

    <form action="{{ route('products.update',"$product->id")}}" method="post" enctype="multipart/form-data" class="form">
        @method("PUT")
        @csrf
        @include('admin.pages.products._partials.form')
    </form>
    
@endsection 