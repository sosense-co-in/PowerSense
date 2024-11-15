@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-xl font-semibold mb-4">Create New Account</h1>
                        @include('utils.alerts')

                        <form id="account-form" action="{{ route('account.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Account Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="fax_no">Fax No.</label>
                                        <input type="text" name="fax_no" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="type">Account Type</label>
                                        <input type="text" name="type" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="industry">Industry</label>
                                        <input type="text" name="industry" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="employees">Number of Employees</label>
                                        <input type="number" name="employees" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sales_turnover">Sales Turnover</label>
                                        <input type="text" name="sales_turnover" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="desc" class="form-control" rows="3"></textarea>
                            </div>


                            {{-- Shipping Address --}}
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <h5 class="mt-4">Shipping Address</h5>
                                    <div class="form-group">
                                        <label for="ship_addr">Address</label>
                                        <input type="text" name="ship_addr" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ship_city">City</label>
                                        <input type="text" name="ship_city" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ship_state">State</label>
                                        <input type="text" name="ship_state" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ship_country">Country</label>
                                        <input type="text" name="ship_country" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="ship_zip">Zip Code</label>
                                        <input type="text" name="ship_zip" class="form-control">
                                    </div>
                                </div>


                                {{-- Billing Address --}}
                                <div class="col-lg-6">
                                    <h5 class="mt-4">Billing Address</h5>
                                    <div class="form-group">
                                        <label for="bill_addr">Address</label>
                                        <input type="text" name="bill_addr" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="bill_city">City</label>
                                        <input type="text" name="bill_city" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="bill_state">State</label>
                                        <input type="text" name="bill_state" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="bill_country">Country</label>
                                        <input type="text" name="bill_country" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="bill_zip">Zip Code</label>
                                        <input type="text" name="bill_zip" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Create Account <i
                                        class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
