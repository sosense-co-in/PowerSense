@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        @can('show_total_stats')
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-primary">{{ format_currency($revenue) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Revenue</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-warning p-4 mfe-3 rounded-left">
                            <i class="bi bi-arrow-return-left font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-warning">{{ format_currency($sale_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Sales Return</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-success p-4 mfe-3 rounded-left">
                            <i class="bi bi-arrow-return-right font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-success">{{ format_currency($purchase_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Purchases Return</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-info p-4 mfe-3 rounded-left">
                            <i class="bi bi-trophy font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-info">{{ format_currency($profit) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Profit</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-danger p-4 mfe-3 rounded-left">
                            <i class="bi bi-flag font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-danger">{{ $tickets }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Tickets</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Accounts Tile -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-dark p-4 mfe-3 rounded-left">
                            <i class="bi bi-person-fill font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-secondary">{{ $accounts }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Accounts</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Contacts Tile -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-info p-4 mfe-3 rounded-left">
                            <i class="bi bi-person-check font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-dark">{{ $contacts }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Contacts</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New AMC Contracts Tile -->
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                            <i class="bi bi-file-earmark-text font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-success">{{ $amcContracts }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">AMC Contracts</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endcan

        @can('show_weekly_sales_purchases|show_month_overview')
        <div class="row mb-4">
            @can('show_weekly_sales_purchases')
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Sales & Purchases of Last 7 Days
                    </div>
                    <div class="card-body">
                        <canvas id="salesPurchasesChart"></canvas>
                    </div>
                </div>
            </div>
            @endcan
            @can('show_month_overview')
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Overview of {{ now()->format('F, Y') }}
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="chart-container" style="position: relative; height:auto; width:280px">
                            <canvas id="currentMonthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        @endcan

        @can('show_monthly_cashflow')
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        Monthly Cash Flow (Payment Sent & Received)
                    </div>
                    <div class="card-body">
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        <!-- New Chart for Accounts, Contacts, and AMC Contracts -->
        <div class="row mb-4">
            @can('show_accounts_overview')
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Accounts Overview
                    </div>
                    <div class="card-body">
                        <canvas id="accountsChart"></canvas>
                    </div>
                </div>
            </div>
            @endcan

            @can('show_contacts_overview')
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Contacts Overview
                    </div>
                    <div class="card-body">
                        <canvas id="contactsChart"></canvas>
                    </div>
                </div>
            </div>
            @endcan

            @can('show_amc_overview')
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        AMC Contracts Overview
                    </div>
                    <div class="card-body">
                        <canvas id="amcChart"></canvas>
                    </div>
                </div>
            </div>
            @endcan
        </div>

    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
            integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
@endpush

{{-- https://github.com/FahimAnzamDip/triangle-pos --}}
