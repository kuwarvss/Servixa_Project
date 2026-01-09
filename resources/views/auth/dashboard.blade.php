@extends('auth.layouts.app')

@section('content')
    <div class="container-fluid mt-2">
        <div>
    <!-- Dashboard Cards -->
    <div class="row g-4">

        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-1">
                <h6>Total Users</h6>
                <h2>2</h2>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-2">
                <h6>Payment Received</h6>
                <h2>2</h2>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-3">
                <h6>Due Fees</h6>
                <h2>0</h2>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="stat-card gradient-4">
                <h6>Total Payment</h6>
                <h2>100000</h2>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
const ctx = document.getElementById('paymentChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Total Users', 'Received', 'Due', 'Total Payment'],
        datasets: [{
            label: 'Dashboard Stats',
            data: [1250, 85000, 15000, 100000],
            backgroundColor: [
                '#6a5cff',
                '#00b09b',
                '#f7971e',
                '#9b5cff'
            ],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endpush

