@extends('layouts.main')

@section('title', 'Direktorat Sistem Teknologi Informasi')

@section('content')
{{-- Content --}}                                
    <!--begin::Container-->
    <div class="container-fluid">
        @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
        @endif
        

        {{-- begin Content --}}
        <h1>HALLO</h1>
        {{-- End Content --}}
    </div>
    <!--end::Container-->
@endsection
							