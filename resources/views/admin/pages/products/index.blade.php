@extends('admin.layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')

        <h1>Exibindo os Produtos</h1>

        @if (isset($products))
            @foreach ($products as $product)
              <p class="@if ($loop->last) last @endif">{{$product}}</p>  
            @endforeach
        @endif

        <hr>

        @forelse ($products as $product)
            <p>{{$product}}</p>
        @empty
            <p> Não existem produtos cadastrados.</p>
        @endforelse

        @if ($teste === 123)
           <p> É Igual </p>
        @elseif($teste === '123')
           <p> com aspas </p>
        @endif
        <br>
        @unless ($teste ==='123')
           <p> retornou falso </p>
        @endunless
        <br>
        @isset($teste2)
            <p>nao é null</p>
        @endisset
        <br>
        @empty($teste3)
           <p> Vazio </p>
        @endempty
        <br>
        @auth
            <p> Autenticado </p>
        @else
            <p> Não Autenticado </p>
        @endauth

        @guest
            <p>Não autenticado</p>
        @endguest

        @switch($teste)

            @case(1)
                igual 1 
            @break

            @case(2)
                igual 2 
            @break

            @case(123)
                igual 123
            @break  

            @default
                default

        @endswitch



@endsection