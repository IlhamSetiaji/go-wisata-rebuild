@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.alert')
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Data Administrator</h1>
                    <nav class="breadcrumb-container d-inline-block" aria-label="breadcrumb">
                        <ul class="breadcrumb pt-0">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item"><a href="Quiz.List.html">Quizes</a></li> --}}
                        </ul>
                    </nav>
                </div>
                <!-- Title End -->
                <!-- Top Buttons Start -->
                <div class="col-12 col-sm-6 d-flex align-items-start justify-content-end">
                    <!-- Start Button Start -->
                    <a href="{{ url('admin/export-users') }}" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-sm-auto">
                        <i data-acorn-icon="chevron-right"></i>
                        <span>Export</span>
                    </a>
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-sm-auto"
                        data-bs-toggle="modal" data-bs-target="#importUsers">
                        <i data-acorn-icon="chevron-right"></i>
                        <span>Import</span>
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-sm-auto"
                        data-bs-toggle="modal" data-bs-target="#createAdmin">
                        <i data-acorn-icon="chevron-right"></i>
                        <span>Create</span>
                    </button>
                    {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#largeRightModalExample">Large</button> --}}
                    <!-- Start Button End -->
                </div>
                <!-- Top Buttons End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Content Start -->

        <div class="row">
            <!-- Continue Learning Start -->
            <div class="col-xl-12 mb-5">
                <h2 class="small-title">Data Administrator</h2>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($roles as $role)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="{{ \Illuminate\Support\Str::slug($role->name) }}-tab"
                                data-bs-toggle="tab" data-bs-target="#{{ \Illuminate\Support\Str::slug($role->name) }}"
                                type="button" role="tab"
                                aria-controls="{{ \Illuminate\Support\Str::slug($role->name) }}"
                                aria-selected="true">{{ ucwords(str_replace('-', ' ', $role->name)) }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    @foreach ($roles as $role)
                        <div class="tab-pane fade" id="{{ \Illuminate\Support\Str::slug($role->name) }}" role="tabpanel"
                            aria-labelledby="{{ \Illuminate\Support\Str::slug($role->name) }}-tab">
                            {{-- <button type="button"
                                class="btn btn-outline-success my-3" data-bs-toggle="modal" data-bs-target="#create{{ ucwords(str_replace('-', '', $role->name)) }}">Create</button> --}}
                            <table class="table table-hover" id="myTable{{ $role->id }}">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Parent</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role->users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            @if ($user->parent)
                                                <td>{{ $user->parent->name }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td><a onclick="return confirm('Are you sure?')"
                                                    href="{{ url('admin/users/' . $user->id . '/delete') }}"
                                                    class="btn btn-danger">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @push('scripts')
                            <script>
                                $(document).ready(function() {
                                    $('#myTable' + "<?php echo $role->id; ?>").DataTable();
                                });
                            </script>
                        @endpush
                    @endforeach
                </div>
            </div>
            <!-- Continue Learning End -->
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.modals.create')
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#role').on('change', function() {
                var idRole = this.value;
                $("#parent").html('');
                $.ajax({
                    url: "{{ env('APP_URL') . '/api/roles/' }}",
                    type: "POST",
                    data: {
                        role_id: idRole,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        $('#parent').html(
                            '<option value="">-- Select Parent --</option>');
                        $.each(result, function(key, value) {
                            $("#parent").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                            console.log(value);
                        });
                    }
                });
            });
        });
    </script>
@endpush
