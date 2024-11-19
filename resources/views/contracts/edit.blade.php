@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Edit Contract</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('amc-contracts.update', $contract->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Contract Information -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="taxes">Taxes</label>
                            <input type="text" id="taxes" class="form-control" name="taxes"
                                value="{{ old('taxes', $contract->taxes) }}" placeholder="Taxes">
                            @error('taxes')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment">Payment Terms</label>
                            <input type="text" id="payment" class="form-control" name="payment"
                                value="{{ old('payment', $contract->payment) }}" placeholder="Payment Terms">
                            @error('payment')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="validity">Validity of Offer</label>
                            <input type="text" id="validity" class="form-control" name="validity"
                                value="{{ old('validity', $contract->validity) }}" placeholder="Validity in days">
                            @error('validity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contract_start">Contract Start Date</label>
                            <input type="text" id="contract_start" class="form-control datepicker" name="contract_start"
                                value="{{ old('contract_start', $contract->contract_start) }}">
                            @error('contract_start')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contract_end">Contract End Date</label>
                            <input type="text" id="contract_end" class="form-control datepicker" name="contract_end"
                                value="{{ old('contract_end', $contract->contract_end) }}">
                            @error('contract_end')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Product Information -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Products</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" id="product-rows">
                            @if ($contract->products && $contract->products->isNotEmpty())
                                @foreach ($contract->products as $index => $product)
                                    <div class="col-md-12 product-row" data-index="{{ $index }}">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="rating_{{ $index }}">Rating/Capacity</label>
                                                    <input type="text" class="form-control" name="rating[]"
                                                        value="{{ old('rating.' . $index, $product->rating) }}"
                                                        placeholder="Rating/Capacity">
                                                    @error('rating.' . $index)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sr_no_{{ $index }}">Sr. No.</label>
                                                    <input type="text" class="form-control" name="sr_no[]"
                                                        value="{{ old('sr_no.' . $index, $product->sr_no) }}"
                                                        placeholder="Sr. No.">
                                                    @error('sr_no.' . $index)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cost_per_unit_{{ $index }}">Rate</label>
                                                    <input type="number" class="form-control" name="cost_per_unit[]"
                                                        value="{{ old('cost_per_unit.' . $index, $product->cost_per_unit) }}"
                                                        placeholder="Rate">
                                                    @error('cost_per_unit.' . $index)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="quantity_{{ $index }}">Qty</label>
                                                    <input type="number" class="form-control" name="quantity[]"
                                                        value="{{ old('quantity.' . $index, $product->quantity) }}"
                                                        placeholder="Quantity">
                                                    @error('quantity.' . $index)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="total_cost_{{ $index }}">Amount</label>
                                                    <input type="text" class="form-control" name="total_cost[]"
                                                        value="{{ old('total_cost.' . $index, $product->total_cost) }}"
                                                        placeholder="Amount" readonly>
                                                    @error('total_cost.' . $index)
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger btn-sm remove-product-btn"
                                                    onclick="removeProduct({{ $index }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No products found for this contract.</p>
                            @endif
                        </div>

                        <button type="button" class="btn btn-success" id="add-product-btn">
                            <i class="fa fa-plus"></i> Add Product
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-right mt-4">
                    <button type="submit" class="btn btn-primary">Update Contract</button>
                    <a href="{{ route('amc-contracts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Function to update the total cost when rate or quantity changes
        function updateTotalCost(index) {
            const rate = parseFloat($(`input[name='cost_per_unit[]']`)[index].value) || 0;
            const quantity = parseFloat($(`input[name='quantity[]']`)[index].value) || 0;
            const totalCost = rate * quantity;
            $(`input[name='total_cost[]']`)[index].value = totalCost.toFixed(2);
        }

        // Add a new product row
        document.getElementById('add-product-btn').addEventListener('click', function() {
            const newIndex = document.querySelectorAll('.product-row').length;

            const newRow = `
                <div class="col-md-12 product-row" data-index="${newIndex}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rating_${newIndex}">Rating/Capacity</label>
                                <input type="text" class="form-control" name="rating[]" placeholder="Rating/Capacity">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sr_no_${newIndex}">Sr. No</label>
                                <input type="text" class="form-control" name="sr_no[]" placeholder="Sr. No">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cost_per_unit_${newIndex}">Rate</label>
                                <input type="text" class="form-control" name="cost_per_unit[]" placeholder="Rate" onkeyup="updateTotalCost(${newIndex})">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                                                <label for="quantity_${newIndex}">Qty</label>
                                <input type="number" class="form-control" name="quantity[]" placeholder="Quantity" onkeyup="updateTotalCost(${newIndex})">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="total_cost_${newIndex}">Amount</label>
                                <input type="text" class="form-control" name="total_cost[]" placeholder="Total Cost" readonly>
                            </div>
                        </div>

                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-product-btn" onclick="removeProduct(${newIndex})">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Append the new product row to the form
            document.getElementById('product-rows').insertAdjacentHTML('beforeend', newRow);
        });

        // Function to remove a product row
        function removeProduct(index) {
            const row = document.querySelector(`.product-row[data-index="${index}"]`);
            row.remove();
        }
    </script>
@endsection
