@extends('layouts.main')

@section('title', 'Detail People')
    
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-chat-1 text-primary"></i>
                        </span>
                        <h3 class="card-label">{{ $people->name }}
                        <small>{{ $people->nim }}</small></h3>
                        <small><a href="/categories/{{ $people->category->slug }}">{{ $people->category->name }}</a></small>
                    </div>
                </div>
                <div class="card-body">{{ $people->address }}</div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="/people" class="btn btn-light-primary font-weight-bold">Back</a>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>

</div>

@endsection