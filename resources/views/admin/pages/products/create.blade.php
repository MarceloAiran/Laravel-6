@extends('admin.layouts.app')

@section('title', 'Cadastra novos produtos')

@section('content')

    <h1>cadastrar novos produtos</h1>
    
    <form action="{{ route('products.store')}}" method="post" enctype="multipart/form-data" class="form">
        @csrf
        @include('admin.pages.products._partials.form')
    </form>
    
@endsection