@extends('layouts.app')

@section('content')
<div class="container bg-white">
    <h1>Edit Account</h1>

    @include('utils.alerts')

    <form action="{{ route('account.update', $account->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="name">Account Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $account->name) }}" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $account->phone) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="fax_no">Fax No.</label>
                    <input type="text" name="fax_no" class="form-control" value="{{ old('fax_no', $account->fax_no) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $account->email) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" name="website" class="form-control" value="{{ old('website', $account->website) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="type">Account Type</label>
                    <input type="text" name="type" class="form-control" value="{{ old('type', $account->type) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="industry">Industry</label>
                    <input type="text" name="industry" class="form-control" value="{{ old('industry', $account->industry) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="employees">No of Employees</label>
                    <input type="number" name="employees" class="form-control" value="{{ old('employees', $account->no_of_emp) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="sales_turnover">Sales Turnover</label>
                    <input type="number" name="sales_turnover" class="form-control" value="{{ old('sales_turnover', $account->sales_turnover) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea name="desc" class="form-control" rows="3">{{ old('desc', $account->desc) }}</textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ship_addr">Shipping Address</label>
                    <input type="text" name="ship_addr" class="form-control" value="{{ old('ship_addr', $account->ship_addr) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ship_city">Shipping City</label>
                    <input type="text" name="ship_city" class="form-control" value="{{ old('ship_city', $account->ship_city) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ship_state">Shipping State</label>
                    <input type="text" name="ship_state" class="form-control" value="{{ old('ship_state', $account->ship_state) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ship_country">Shipping Country</label>
                    <input type="text" name="ship_country" class="form-control" value="{{ old('ship_country', $account->ship_country) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="ship_zip">Shipping ZIP</label>
                    <input type="text" name="ship_zip" class="form-control" value="{{ old('ship_zip', $account->ship_zip) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="bill_addr">Billing Address</label>
                    <input type="text" name="bill_addr" class="form-control" value="{{ old('bill_addr', $account->bill_addr) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="bill_city">Billing City</label>
                    <input type="text" name="bill_city" class="form-control" value="{{ old('bill_city', $account->bill_city) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="bill_state">Billing State</label>
                    <input type="text" name="bill_state" class="form-control" value="{{ old('bill_state', $account->bill_state) }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="bill_country">Billing Country</label>
                    <input type="text" name="bill_country" class="form-control" value="{{ old('bill_country', $account->bill_country) }}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="bill_zip">Billing ZIP</label>
                    <input type="text" name="bill_zip" class="form-control" value="{{ old('bill_zip', $account->bill_zip) }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Account</button>
        </div>
    </form>
</div>
@endsection
