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
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Data
                    Tables</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon mr-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @include('backend.layouts.message')
                    <a class="modal-effect btn btn-primary btn-md" data-effect="effect-just-me" data-toggle="modal"
                        href="#modaldemo8">Create Courses</a>
                    <a href="#" class="btn btn-warning btn-md">Archive Courses</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Course Name</th>
                                    <th class="border-bottom-0">Slug</th>
                                    <th class="border-bottom-0">Meta Description</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Updated At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($courses)
                                    @foreach ($courses as $key => $course)
                                        <tr>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->slug }}</td>
                                            <td>{{ $course->meta_description }}</td>
                                            <td>
                                                <span
                                                    class="btn btn-{{ $course->status == 'active' ? 'primary' : 'danger' }} btn-sm">{{ ucfirst($course->status) }}</span>
                                            </td>
                                            <td>{{ App\Trait\ProccessSystem::Date($course->created_at) }}</td>
                                            <td>{{ App\Trait\ProccessSystem::Date($course->updated_at) }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-primary btn-sm" data-effect="effect-just-me"
                                                    data-toggle="modal" href="#edit{{ $course->slug }}">Edit</a>
                                                <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-just-me"
                                                    data-toggle="modal" href="#delete{{ $course->slug }}">Delete</a>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit -->
                                        <div class="modal" id="edit{{ $course->slug }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Edit Course</h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('teacher.courses.update', $course->slug) }}" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Title Course <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="course_name" id="" value="{{ $course->course_name }}"
                                                                    class="form-control @error('course_name') is-invalid
                                                                @enderror"
                                                                    placeholder="" aria-describedby="helpId" />
                                                                @error('course_name')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Meta Description
                                                                    <span class="text-danger">*</span></label>
                                                                <input type="text" name="meta_description" id=""
                                                                    maxlength="80" value="{{ $course->meta_description }}"
                                                                    class="form-control @error('meta_description') is-invalid
                                                                    @enderror"
                                                                    placeholder="" aria-describedby="helpId" />
                                                                @error('meta_description')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Meta Description
                                                                    <span class="text-danger">*</span></label>
                                                                <textarea id="editor{{ $key }}" class="form-control @error('description') is-invalid
                                                                @enderror"
                                                                    col="8" name="description">{{ $course->description }}</textarea>
                                                                @error('description')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mt-3">
                                                                <select class="form-control" name="status">
                                                                    <option value="active" {{ $course->status == 'active' ? 'selected' : "" }}>Active</option>
                                                                    <option value="inactive" {{ $course->status == 'inactive' ? 'selected' : "" }}>Inactive</option>
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
                                                        <h6 class="modal-title">Delete Course</h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('teacher.courses.destroy', $course->slug) }}" method="post">
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
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

    <!-- Modal Create -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Create Course</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('teacher.courses.store') }}" method="post">
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
                            <label for="" class="form-label">Meta Description <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="meta_description" id="" maxlength="80"
                                class="form-control @error('meta_description') is-invalid
                            @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('meta_description')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Meta Description <span
                                    class="text-danger">*</span></label>
                            <textarea id="editor" class="form-control @error('description') is-invalid
                            @enderror"
                                col="8" name="description"></textarea>
                            @error('description')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <select class="form-control" name="status">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">Save changes</button>
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
    <script src="{{ URL::asset('backend/assets/js/table-data.js') }}"></script>4

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
