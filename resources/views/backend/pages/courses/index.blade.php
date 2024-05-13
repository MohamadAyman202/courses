@extends('backend.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    Courses
@endsection
@section('content')
    <!-- row opened -->
    <div class="card card-body mt-3">
        <div class="">
            @include('backend.layouts.message')
            <a class="modal-effect btn btn-primary btn-md" data-effect="effect-just-me" data-toggle="modal"
                href="#modaldemo8">Create Courses</a>
            <a href="#" class="btn btn-warning btn-md">Archive Courses</a>
        </div>
    </div>
    @isset($courses)
        <div class="d-flex flex-wrap">
            @foreach ($courses as $key => $course)
                <div class="card mr-5" style="width: 19rem;">
                    <img class="card-img-top" src="{{ asset($course->photo) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}</h5>
                        <p class="card-text m-0 mb-1">{{ $course->meta_description }}</p>

                        <span
                            class="d-block p-2 mb-2 btn btn-{{ $course->status == 'active' ? 'primary' : 'danger' }} btn-sm">{{ ucfirst($course->status) }}</span>
                        <div class="text-center">
                            <div class="row">

                                <div class="col-6">
                                    <a class="modal-effect btn btn-primary btn-block" data-effect="effect-just-me"
                                        data-toggle="modal" href="#edit{{ $course->slug }}">Edit</a>
                                </div>
                                <div class="col-6">
                                    <a class="modal-effect btn btn-danger btn-block" data-effect="effect-just-me"
                                        data-toggle="modal" href="#delete{{ $course->slug }}">Delete</a>
                                </div>
                            </div>
                            {{-- <a href="#" class="btn btn-warning btn-md">Approved</a> --}}
                        </div>

                    </div>
                </div>
                <!-- Modal Edit -->
                <div class="modal" id="edit{{ $course->slug }}">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Edit Course</h6><button aria-label="Close" class="close"
                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ route('admin.courses.update', $course->slug) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Title Course <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="course_name" id=""
                                            value="{{ $course->course_name }}"
                                            class="form-control @error('course_name') is-invalid
                                                                @enderror"
                                            placeholder="" aria-describedby="helpId" />
                                        @error('course_name')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Upload Photo <span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="photo" id=""
                                            class="form-control @error('photo') is-invalid
                                                                @enderror"
                                            placeholder="" aria-describedby="helpId" />
                                        @error('photo')
                                            <small id="helpId" class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Price</label>
                                        <input type="number" min="0" value="{{ $course->price }}" name="price"
                                            id="" class="form-control" placeholder="" aria-describedby="helpId" />
                                        {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                                    </div>

                                    <div class="mt-3">
                                        <select class="form-control" name="status">
                                            <option value="active" {{ $course->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ $course->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="submit">Save
                                        changes</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                        type="button">Close</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- End Modal Edit-->

                <!-- Modal Delete -->
                <div class="modal" id="delete{{ $course->slug }}">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-demo">
                            <div class="modal-header">
                                <h6 class="modal-title">Delete Course</h6><button aria-label="Close" class="close"
                                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form action="{{ route('admin.courses.destroy', $course->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                    <div class="text-center">
                                        <p class="text-danger" style="font-size: 20px">Are You Sure Delete Course</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn ripple btn-danger" type="submit">
                                        Delete</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                                        type="button">Close</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- End Modal Delete-->
            @endforeach
        </div>
        <div class="d-flex justify-content-center align-items-center">
            {!! $courses->links() !!}
        </div>
    @endisset

    <!-- Modal Create -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create Course</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('admin.courses.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Title Course <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="course_name" id=""
                                class="form-control @error('course_name') is-invalid
                            @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('course_name')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Upload Photo <span
                                    class="text-danger">*</span></label>
                            <input type="file" name="photo" id=""
                                class="form-control @error('photo') is-invalid
                            @enderror"
                                accept="image/*" placeholder="" aria-describedby="helpId" />
                            @error('photo')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Price</label>
                            <input type="number" min="0" value="100" name="price" id=""
                                class="form-control" placeholder="" aria-describedby="helpId" />
                            {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                        </div>

                        <div class="mt-3">
                            <select class="form-control" name="status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">Submit</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- End Modal Create-->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('backend/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('backend/assets/js/table-data.js') }}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector(`#editor`))
            .catch(error => {
                console.error(error);
            });

        var count = {!! App\Models\Course::query()->count() !!};
        for (var i = 0; i < count; i++) {
            ClassicEditor
                .create(document.querySelector(`#editor${i}`))
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
@endsection
