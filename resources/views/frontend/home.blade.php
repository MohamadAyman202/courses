@extends('frontend.layouts.app')

@section('content')
    @isset($courses)
        <div class="d-flex flex-wrap">
            @foreach ($courses as $key => $course)
                <div class="card me-5" style="width: 19rem;">
                    <img class="card-img-top" src="{{ asset($course->photo) }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title mb-0 fw-bold">{{ $course->course_name }}</h4>
                        <p class="fw-500 fs-5">price: {{ $course->price }} EG</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
@endsection
