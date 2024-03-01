@extends('frontend.layouts.app')

@section('content')
    @isset($courses)
        <div class="d-flex flex-wrap">
            @foreach ($courses as $key => $course)
                <div class="card me-5" style="width: 19rem;">
                    <img class="card-img-top" src="{{ asset($course->photo) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}</h5>
                        <p class="card-text m-0 mb-1">{{ $course->meta_description }}</p>

                        <a href="{{ route('teacher.courses.create') }}" class="d-block fs-6 p-2 mb-2 btn btn-primary btn-sm">
                            View</a>

                    </div>
                </div>
            @endforeach
        </div>
    @endisset
@endsection
