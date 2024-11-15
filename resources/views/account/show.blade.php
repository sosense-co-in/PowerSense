@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $account->name }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Contact Information</h5>
            <p><strong>Phone:</strong> {{ $account->phone }}</p>
            <p><strong>Email:</strong> {{ $account->email }}</p>
            <p><strong>Fax No:</strong> {{ $account->fax_no }}</p>
            <p><strong>Website:</strong> {{ $account->website }}</p>

            <h5 class="card-title mt-4">Business Details</h5>
            <p><strong>Type:</strong> {{ $account->type }}</p>
            <p><strong>Industry:</strong> {{ $account->industry }}</p>
            <p><strong>Number of Employees:</strong> {{ $account->no_of_emp }}</p>
            <p><strong>Sales Turnover:</strong> {{ $account->sales_turnover }}</p>
            <p><strong>Description:</strong> {{ $account->desc }}</p>

            <h5 class="card-title mt-4">Addresses</h5>
            <h6>Shipping Address</h6>
            <p>{{ $account->ship_addr }}, {{ $account->ship_city }}, {{ $account->ship_state }}, {{ $account->ship_country }}, {{ $account->ship_zip }}</p>
            <h6>Billing Address</h6>
            <p>{{ $account->bill_addr }}, {{ $account->bill_city }}, {{ $account->bill_state }}, {{ $account->bill_country }}, {{ $account->bill_zip }}</p>

            <a href="{{ route('account.edit', $account->id) }}" class="btn btn-primary mt-3">Edit</a>
        </div>
    </div>
</div>
@endsection
