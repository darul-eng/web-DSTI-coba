@extends('layouts.main')

@section('title', 'Categories')

@section('content')
    <div class="container-fluid">
      <h1>{{ $title }}</h1>
        <ul>
            @foreach ($categories as $category)
            <li>
                <p><a href="/categories/{{ $category->slug }}">{{ $category->name }}</a></p>
            </li>
            @endforeach
        </ul>
    </div>
@endsection