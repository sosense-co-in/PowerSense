@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Create Ticket</h2>
                    </div>
                    <div class="card-body">
                        @include('utils.alerts')

                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <!-- Subject -->
                                <div class="col-lg-6 mb-3">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter ticket subject" required>
                                </div>

                                <!-- Category -->
                                <div class="col-lg-6 mb-3">
                                    <label for="tkt_category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="tkt_category_id" id="tkt_category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- Priority -->
                                <div class="col-lg-6 mb-3">
                                    <label for="priority_id" class="form-label">Priority <span class="text-danger">*</span></label>
                                    <select name="priority_id" id="priority_id" class="form-control">
                                        <option value="">Select Priority</option>
                                        @foreach ($priorities as $priority)
                                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-lg-6 mb-3">
                                    <label for="status_id" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status_id" id="status_id" class="form-control">
                                        <option value="">Select Status</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Service Engineer (Agent) -->
                            <div class="form-group mb-3">
                                <label for="agent_id" class="form-label">Assign Service Engineer</label>
                                <select name="agent_id" id="agent_id" class="form-control">
                                    <option value="">Unassigned</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Content -->
                            <div class="form-group mb-4">
                                <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" rows="5" class="form-control" placeholder="Enter ticket details here"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Create Ticket
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
