@extends('layouts.main')

@section('title', 'Categories')

@section('content')
    <div class="container-fluid">
      <h1>{{ $category }}</h1>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">NIM</th>
                <th scope="col">Address</th>
                <th scope="col">Category</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($peoples as $people)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $people->name }}</td>
                <td>{{ $people->nim }}</td>
                <td>{{ $people->address }}</td>
                <td>{{ $people->category->name }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection