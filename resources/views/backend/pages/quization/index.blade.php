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
    quization
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
                        href="#modaldemo8">Create quization</a>
                    <a href="#" class="btn btn-warning btn-md">Archive quization</a>
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
                                    <th class="border-bottom-0">quize</th>
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
                                        <td>{{ $quize->quize->name }}</td>
                                        <td>{{ App\Trait\ProccessSystem::Date($quize->created_at) }}</td>
                                        <td>{{ App\Trait\ProccessSystem::Date($quize->updated_at) }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-primary btn-sm" data-effect="effect-just-me"
                                                data-toggle="modal" href="#edit{{ $quize->slug }}">Edit</a>
                                            <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-just-me"
                                                data-toggle="modal" href="#delete{{ $quize->id }}">Delete</a>
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

                                                <form action="{{ route('quization.update', $quize->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT') <!-- Use method spoofing for PUT request -->

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Name<span class="text-danger">*</span></label>
                                                            <input type="text" value="{{ $quize->name }}" name="name" id=""
                                                                class="form-control @error('name') is-invalid
                                                            @enderror"
                                                                placeholder="" aria-describedby="helpId" />
                                                            @error('name')
                                                                <small id="helpId" class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        @php
                                                        $oldQuizId = isset($oldQuizeId) ? $oldQuizeId : null; // استخدم القيمة القديمة إن وجدت، وإلا فاستخدم null
                                                      @endphp

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Quize<span class="text-danger">*</span></label>
                                                            <select name="quize_id" id="quize_id"
                                                                class="form-control @error('quize_id') is-invalid @enderror">
                                                                <option value="">Choose Quize</option>
                                                                @foreach ($quizePluck as $id => $quizeP)
                                                                    <option value="{{ $id }}">{{ $quizeP }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('quize_id')
                                                                <small id="helpId" class="text-danger">{{ $message }}</small>
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
                                    <div class="modal" id="delete{{ $quize->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Delete Lesson</h6><button aria-label="Close"
                                                        class="close" data-dismiss="modal" type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('quization.destroy', $quize->id) }}"
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
                    <h6 class="modal-title">Create quization</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('quization.store') }}" method="post">
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
                            <label for="" class="form-label">Quize<span class="text-danger">*</span></label>
                            <select name="quize_id" id="quize_id"
                                class="form-control @error('quize_id') is-invalid @enderror">
                                <option value="">Choose Quize</option>
                                @foreach ($quizePluck as $id => $quizeP)
                                    <option value="{{ $id }}">{{ $quizeP }}</option>
                                @endforeach
                            </select>
                            @error('quize_id')
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
