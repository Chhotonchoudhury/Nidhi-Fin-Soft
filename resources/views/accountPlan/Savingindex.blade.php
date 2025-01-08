@extends('layouts/app')

@section('title') Saving Account Plans @endsection

@section('style')
<style>
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .footer-info {
        font-size: 0.900rem;
        color: #333333;
        /* Darker text color for better readability */
        background-color: #f0f0f0;
        /* Light grey background */
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #d1d1d1;
        /* Light border to give button-like appearance */
    }

    .pagination {
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center bg-light w-100" style="height: 40px;">
                    <div class="ms-2">
                        <h6 class="m-0">All Saving Account Plans</h6>
                    </div>
                    <div class="me-2">
                        <a href="{{ route('saving.form') }}" onclick="showLoadingEffect(event)"
                            class="btn btn-sm btn-outline-primary py-1 px-2">
                            <i class="icon-plus1"> </i> New Plan
                            <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                                role="status"></span>
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <!-- Search Form with Export and Print Buttons on the Same Row -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <!-- Left side: Search Form -->
                            <form method="GET" action="{{ route('saving.index') }}" class="d-flex align-items-center">
                                <input type="text" name="search" class="form-control form-control-sm"
                                    value="{{ $search }}" placeholder="Search saving plans..."
                                    style="width: auto; min-height:30px; max-width: 300px;">
                                <button type="submit" class="btn btn-outline-primary btn-sm ms-2"
                                    style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                    <i class="icon icon-search1 me-1"></i> Search
                                </button>
                            </form>

                            <!-- Right side: Export Buttons -->
                            <div class="d-flex">
                                <button id="export-print" class="btn btn-outline-success btn-sm ms-2" title="Print"
                                    style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                                    <span class="icon-printer"></span> Print
                                </button>
                            </div>
                        </div>

                        <table id="plan-table" class="table table-bordered table-striped table-hover v-middle m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plan Code</th>
                                    <th>Plan Name</th>
                                    <th>Min Opening Bal</th>
                                    <th>Annual Interest Rate</th>
                                    <th>Interest Payout</th>
                                    <th>Lock-in Amount</th>
                                    <th>Balance Charge</th>
                                    <th>SMS Charge</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $plan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $plan->plan_code ?? 'N/A' }}</td>
                                    <td>{{ $plan->plan_name }}</td>
                                    <td>{{ number_format($plan->min_opening_balance, 2) }}</td>
                                    <td>{{ $plan->annual_interest_rate }}%</td>
                                    <td>{{ $plan->interest_payout }}</td>
                                    <td>{{ number_format($plan->lock_in_amount, 2) }}</td>
                                    <td>{{ number_format($plan->min_monthly_avg_balance_charge, 2) }}</td>
                                    <td>{{ number_format($plan->sms_charge, 2) }}</td>
                                    <td>
                                        @if ($plan->active)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="td-actions">
                                            <!-- View Button (Eye Icon) -->
                                            <a href="#" class="icon blue" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="View" data-bs-original-title="View Row">
                                                <i class="icon-eye"></i>
                                            </a>

                                            <!-- Activate/Deactivate Button -->

                                            <!-- Edit Button (Pencil Icon) -->
                                            <a href="{{ route('saving.form', $plan->id) }}" class="icon green"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                data-bs-original-title="Edit Row">
                                                <i class="icon-pencil"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15" class="text-center">No saving plans found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="card-footer" style="padding: 1%">
                    <!-- Total Records -->
                    <div class="footer-info">
                        Total Records : {{ $plans->total() }}
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        {{ $plans->links('vendor.pagination.custom-pagination') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    // For printing the saving account plan table content
    setupPrintButton('export-print', 'plan-table');
</script>

@endsection