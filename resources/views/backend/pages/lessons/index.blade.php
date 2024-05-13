@extends('backend.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    Lessons
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
                        href="#modaldemo8">Create Lessons</a>
                    <a href="#" class="btn btn-warning btn-md">Archive Lessons</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Lesson Name</th>
                                    <th class="border-bottom-0">slug</th>
                                    <th class="border-bottom-0">Course Name</th>
                                    <th class="border-bottom-0">lesson video</th>
                                    <th class="border-bottom-0">Time video</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Updated At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data['lessons'])
                                    @foreach ($data['lessons'] as $lesson)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lesson->title }}</td>
                                            <td>{{ $lesson->slug }}</td>
                                            <td>{{ $lesson->course->course_name }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-primary btn-md" data-effect="effect-just-me"
                                                    data-toggle="modal" href="#show_video{{ $lesson->slug }}">Show Video</a>
                                            </td>
                                            <td>{{ $lesson->time_video }}</td>
                                            <td>
                                                <span
                                                    class="btn btn-{{ $lesson->status == 'active' ? 'primary' : 'danger' }} btn-md">{{ ucfirst($lesson->status) }}</span>
                                            </td>
                                            <td>{{ App\Trait\ProccessSystem::Date($lesson->created_at) }}</td>
                                            <td>{{ App\Trait\ProccessSystem::Date($lesson->updated_at) }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-primary btn-sm" data-effect="effect-just-me"
                                                    data-toggle="modal" href="#edit{{ $lesson->slug }}">Edit</a>
                                                <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-just-me"
                                                    data-toggle="modal" href="#delete{{ $lesson->slug }}">Delete</a>
                                            </td>
                                        </tr>

                                        <!-- Modal Show Video -->
                                        <div class="modal" id="show_video{{ $lesson->slug }}">
                                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Show Video</h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <video src="{{ asset($lesson->course_video) }}" controls></video>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Show Video -->

                                        <!-- Modal Create -->
                                        <div class="modal" id="edit{{ $lesson->slug }}">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Edit Lesson</h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('admin.lessons.update', $lesson->slug) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Title<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="title" id=""
                                                                    value="{{ $lesson->title }}"
                                                                    class="form-control @error('title') is-invalid
                                                            @enderror"
                                                                    placeholder="" aria-describedby="helpId" />
                                                                @error('title')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Lesson Video<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" name="course_video" id=""
                                                                    accept="video/*"
                                                                    class="form-control @error('course_video') is-invalid
                                                            @enderror"
                                                                    placeholder="" aria-describedby="helpId" />
                                                                @error('course_video')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Time Video<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="time_video" id=""
                                                                    min="0" value="{{ $lesson->time_video }}"
                                                                    class="form-control @error('time_video') is-invalid
                                                            @enderror"
                                                                    placeholder="" aria-describedby="helpId" />
                                                                @error('time_video')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Selected Course<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="course_id" id="course_id"
                                                                    class="form-control @error('course_id') is-invalid
                                                                @enderror">
                                                                    <option selected disabled>Select Course</option>
                                                                    @isset($data['courses'])
                                                                        @foreach ($data['courses'] as $course)
                                                                            <option value="{{ $course->id }}"
                                                                                {{ $course->id == $lesson->course->id ? 'selected' : '' }}>
                                                                                {{ $course->course_name }}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </select>
                                                                @error('course_id')
                                                                    <small id="helpId"
                                                                        class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mt-3">
                                                                <select class="form-control" name="status">
                                                                    <option value="active"
                                                                        {{ $lesson->status == 'active' ? 'selected' : '' }}>
                                                                        Active</option>
                                                                    <option value="inactive"
                                                                        {{ $lesson->status == 'inactive' ? 'selected' : '' }}>
                                                                        Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn ripple btn-primary"
                                                                type="submit">Update</button>
                                                            <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                                type="button">Close</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Create-->

                                        <!-- Modal Delete -->
                                        <div class="modal" id="delete{{ $lesson->slug }}">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content modal-content-demo">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">Delete Lesson</h6><button aria-label="Close"
                                                            class="close" data-dismiss="modal" type="button"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <form action="{{ route('admin.lessons.destroy', $lesson->slug) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <p class="text-danger" style="font-size: 20px">Are You Sure
                                                                    Delete Lesson</p>
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
                <form action="{{ route('admin.lessons.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id=""
                                class="form-control @error('title') is-invalid
                            @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('title')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Lesson Video<span
                                    class="text-danger">*</span></label>
                            <input type="file" name="course_video" id="" accept="video/*"
                                class="form-control @error('course_video') is-invalid
                            @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('course_video')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Time Video<span class="text-danger">*</span></label>
                            <input type="text" name="time_video" id="" min="0" value="0"
                                class="form-control @error('time_video') is-invalid
                            @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('time_video')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Selected Course<span
                                    class="text-danger">*</span></label>
                            <select name="course_id" id="course_id"
                                class="form-control @error('course_id') is-invalid
                            @enderror">
                                <option selected disabled>Select Course</option>
                                @isset($data['courses'])
                                    @foreach ($data['courses'] as $course)
                                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('course_id')
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
@endsection
