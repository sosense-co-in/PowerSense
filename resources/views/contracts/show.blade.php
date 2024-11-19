@extends('layouts.app')

@section('title', 'AMC Contract Details')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">AMC Contract Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="contract_id"><strong>Contract ID:</strong></label>
                                <p>{{ $contract->id }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="contract_start"><strong>Contract Start Date:</strong></label>
                                <p>{{ \Carbon\Carbon::parse($contract->contract_start)->format('Y-m-d') }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="contract_end"><strong>Contract End Date:</strong></label>
                                <p>{{ \Carbon\Carbon::parse($contract->contract_end)->format('Y-m-d') }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="taxes"><strong>Taxes:</strong></label>
                                <p>{{ $contract->taxes }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="payment"><strong>Payment Terms:</strong></label>
                                <p>{{ $contract->payment }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="validity"><strong>Validity of Offer:</strong></label>
                                <p>{{ $contract->validity }} days</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="client_name"><strong>Client Name:</strong></label>
                                <p>{{ $contract->client_name }}</p>
                            </div>
                            <div class="col-md-4">
                                <label for="sr_no"><strong>Contract Type:</strong></label>
                                <p>{{ $contract->type == 'non_comp' ? 'Non-Competitive' : 'Competitive' }}</p>
                            </div>
                        </div>

                        <h5 class="mt-4">Product Details:</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Rating/Capacity</th>
                                    <th>Rate</th>
                                    <th>Qty</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($contract->products && $contract->products->isNotEmpty())
                                    @foreach($contract->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->rating }}</td>
                                            <td>{{ number_format($product->cost_per_unit, 2) }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ number_format($product->total_cost, 2) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No products found for this contract.</td>
                                    </tr>
                                @endif
                            </tbody>

                        </table>

                        <h5 class="mt-4">Terms & Conditions:</h5>
                        <div>
                            <label><strong>Compulsory Terms:</strong></label>
                            <div>{!! nl2br(e($contract->compulsory_terms)) !!}</div>
                        </div>

                        <div class="mt-3">
                            <label><strong>Non-Compulsory Terms:</strong></label>
                            <div>{!! nl2br(e($contract->non_compulsory_terms)) !!}</div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('amc-contracts.index') }}" class="btn btn-secondary">Back to List</a>
                            <a href="{{ route('amc-contracts.edit', $contract->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
