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
    quizes
@endsection
@section('page-header')
    {{-- ########## --}}
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
                        href="#modaldemo8">Create quize</a>
                    <a href="#" class="btn btn-warning btn-md">Archive quize</a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">slug</th>
                                    <th class="border-bottom-0">Lesson</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">End Time</th>
                                    <th class="border-bottom-0">Again Quize</th>
                                    <th class="border-bottom-0">Score</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Updated At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $quize)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $quize->name }}</td>
                                        <td>{{ $quize->slug }}</td>
                                        <td>{{ $quize->lesson->title }}</td>
                                        <td><span
                                                class="btn btn-{{ $quize->status == 'active' ? 'success' : 'danger' }} btn-md">{{ ucfirst($quize->status) }}</span>
                                        </td>
                                        <td>{{ $quize->end_time }}</td>
                                        <td>{{ $quize->again_quize == '0' ? 'No' : 'Yes' }}</td>
                                        <td>{{ $quize->score }}</td>
                                        <td>{{ App\Trait\ProccessSystem::Date($quize->created_at) }}</td>
                                        <td>{{ App\Trait\ProccessSystem::Date($quize->updated_at) }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-primary btn-sm" data-effect="effect-just-me"
                                                data-toggle="modal" href="#edit{{ $quize->slug }}">Edit</a>
                                            <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-just-me"
                                                data-toggle="modal" href="#delete{{ $quize->slug }}">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Modal Update -->
                                    <div class="modal" id="edit{{ $quize->slug }}">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Edit quize</h6>
                                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('quize.update', $quize->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT') <!-- Use method spoofing for PUT request -->

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Name<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="name" id=""
                                                                value="{{ $quize->name }}"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                placeholder="" aria-describedby="helpId" />
                                                            @error('name')
                                                                <small id="helpId"
                                                                    class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Lesson<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="lesson_id" id="lesson_id"
                                                                class="form-control @error('lesson_id') is-invalid @enderror">
                                                                <option value="">Choose lesson</option>
                                                                @foreach ($lessons as $id => $lesson)
                                                                    <option value="{{ $id }}"
                                                                        {{ $quize->lesson_id == $id ? 'selected' : '' }}>
                                                                        {{ $lesson }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('lesson_id')
                                                                <small id="helpId"
                                                                    class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Status<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="status" id="status"
                                                                class="form-control @error('status') is-invalid @enderror">
                                                                <option value="">Choose status</option>
                                                                <option value="active"
                                                                    {{ $quize->status == 'active' ? 'selected' : '' }}>
                                                                    Active</option>
                                                                <option value="inactive"
                                                                    {{ $quize->status == 'inactive' ? 'selected' : '' }}>
                                                                    Inactive</option>
                                                            </select>
                                                            @error('status')
                                                                <small id="helpId"
                                                                    class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">End Time<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="time" name="end_time" id=""
                                                                value="{{ $quize->end_time }}"
                                                                class="form-control @error('end_time') is-invalid @enderror"
                                                                placeholder="" aria-describedby="helpId" />
                                                            @error('end_time')
                                                                <small id="helpId"
                                                                    class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Again Quiz<span
                                                                    class="text-danger">*</span></label>
                                                            <select name="again_quize" id="again_quize"
                                                                class="form-control @error('again_quize') is-invalid @enderror">
                                                                <option value="">Choose</option>
                                                                <option value="1"
                                                                    {{ $quize->again_quize == 1 ? 'selected' : '' }}>Yes
                                                                </option>
                                                                <option value="0"
                                                                    {{ $quize->again_quize == 0 ? 'selected' : '' }}>No
                                                                </option>
                                                            </select>
                                                            @error('again_quize')
                                                                <small id="helpId"
                                                                    class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Score<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" name="score" id=""
                                                                value="{{ $quize->score }}"
                                                                class="form-control @error('score') is-invalid @enderror"
                                                                placeholder="" aria-describedby="helpId" />
                                                            @error('score')
                                                                <small id="helpId"
                                                                    class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn ripple btn-primary"
                                                            type="submit">Submit</button>
                                                        <button class="btn ripple btn-secondary" data-dismiss="modal"
                                                            type="button">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Update-->


                                    <!-- Modal Delete -->
                                    <div class="modal" id="delete{{ $quize->slug }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete Lesson</h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('quize.destroy', $quize->slug) }}"
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
                    <h6 class="modal-title">Create quize</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('quize.store') }}" method="post">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id=""
                                class="form-control @error('name') is-invalid
                            @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('name')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">lesson<span class="text-danger">*</span></label>
                            <select name="lesson_id" id="lesson_id"
                                class="form-control @error('lesson_id') is-invalid @enderror">
                                <option value="">Choose lesson</option>
                                @foreach ($lessons as $id => $lesson)
                                    <option value="{{ $id }}">{{ $lesson }}</option>
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
                            <select name="status" id="lesson_id"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Choose</option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                            @error('status')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">End Time<span class="text-danger">*</span></label>
                            <input type="time" name="end_time" id=""
                                class="form-control @error('end_time') is-invalid
                                @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('end_time')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">again_quize<span
                                    class="text-danger">*</span></label>
                            <select name="again_quize" id="again_quize"
                                class="form-control @error('again_quize') is-invalid @enderror">
                                <option value="">Choose</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('again_quize')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">score<span class="text-danger">*</span></label>
                            <input type="number" name="score" id=""
                                class="form-control @error('score') is-invalid
                                @enderror"
                                placeholder="" aria-describedby="helpId" />
                            @error('score')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
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
