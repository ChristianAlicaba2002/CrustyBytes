<style>
    .dashboard-row {
        display: flex;
        flex-wrap: wrap;
        margin: 2rem 0 0 -0.75rem;
    }
    .dashboard-col {
        flex: 1 1 22%;
        margin: 0.75rem 0 0 0.75rem;
        min-width: 220px;
    }
    .dashboard-card {
        color: #fff;
        height: 100%;
        border-radius: 0.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 1.5rem 1rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .bg-primary { background: #007bff; }
    .bg-success { background: #28a745; }
    .bg-warning { background: #ffc107; color: #212529; }
    .bg-danger { background: #dc3545; }
    .dashboard-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .dashboard-value {
        font-size: 2.5rem;
        font-weight: bold;
    }
</style>

<div class="dashboard-row">
    <!-- Product Total Card -->
    <div class="dashboard-col">
        <div class="dashboard-card bg-primary">
            <div class="dashboard-title">Products</div>
            <div class="dashboard-value">{{ count($totalItems) ?? 0 }}</div>
        </div>
    </div>
    <!-- User Total Card -->
    <div class="dashboard-col">
        <div class="dashboard-card bg-success">
            <div class="dashboard-title">Users</div>
            <div class="dashboard-value">{{ $userTotal ?? 0 }}</div>
        </div>
    </div>
    <!-- Orders Total Card -->
    <div class="dashboard-col">
        <div class="dashboard-card bg-warning">
            <div class="dashboard-title">Orders</div>
            <div class="dashboard-value">{{ $orderTotal ?? 0 }}</div>
        </div>
    </div>
    <!-- Revenue Card -->
    <div class="dashboard-col">
        <div class="dashboard-card bg-danger">
            <div class="dashboard-title">Revenue</div>
            <div class="dashboard-value">${{ number_format($revenue ?? 0, 2) }}</div>
        </div>
    </div>
</div>