@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="products-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-boxes me-3"></i> Product Inventory
                </h2>
                <a href="{{ route('stock.create') }}" class="btn btn-booking">
                    <i class="fas fa-plus-circle me-2"></i> Add New Product
                </a>
            </div>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('stock.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control custom-input" placeholder="Search by product name" value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="quantity_filter" class="form-select custom-select">
                        <option value="">All Stock Status</option>
                        <option value="in-stock" {{ request('quantity_filter') == 'in-stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="low-stock" {{ request('quantity_filter') == 'low-stock' ? 'selected' : '' }}>Low Stock (&lt; 10)</option>
                        <option value="out-of-stock" {{ request('quantity_filter') == 'out-of-stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary custom-btn">Filter</button>
                    <a href="{{ route('stock.index') }}" class="btn btn-secondary custom-btn">Reset</a>
                </div>
            </form>

            <div class="form-card-wrapper p-4">
                <div class="table-responsive">
                    <table class="table table-products">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Usage Type</th>
                                <th>Total Value</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($stocks->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted-custom py-5">
                                    <i class="fas fa-box-open fa-2x mb-2"></i>
                                    <div>No products found in inventory.</div>
                                </td>
                            </tr>
                            @endif
                            @foreach($stocks as $stock)
                            <tr>
                                <td>#{{ $stock->id }}</td>
                                <td>
                                    <div class="product-name">
                                        {{ $stock->name }}
                                    </div>
                                </td>
                                <td>
                                    <span class="quantity-badge {{ $stock->quantity <= 0 ? 'out-of-stock' : ($stock->quantity < 10 ? 'low-stock' : 'in-stock') }}">
                                        {{ $stock->quantity }}
                                    </span>
                                </td>
                                <td>
                                    @if($stock->unit_price)
                                        {{ number_format($stock->unit_price) }} FCFA
                                    @else
                                        <span class="text-muted-custom">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="usage-badge usage-{{ $stock->usage_type }}">
                                        {{ ucfirst($stock->usage_type) }}
                                    </span>
                                </td>
                                <td>
                                    @if($stock->unit_price && $stock->quantity)
                                        {{ number_format(($stock->unit_price * $stock->quantity)) }} FCFA
                                    @else
                                        <span class="text-muted-custom">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex action-buttons">
                                        <a href="#" class="btn-action btn-edit mark-sold-used-btn" 
                                           data-stock-id="{{ $stock->id }}" 
                                           title="Mark as Sold/Used">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a href="{{ route('stock.edit', $stock->id) }}" class="btn-action btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($stocks, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $stocks->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sold/Used Modal -->
    <div class="modal fade" id="soldUsedModal" tabindex="-1" aria-labelledby="soldUsedModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="soldUsedForm" method="POST">
          @csrf
          <div class="modal-content custom-modal-content">
            <div class="modal-header custom-modal-header">
              <h5 class="modal-title" id="soldUsedModalLabel">Mark Product as Sold/Used</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom-modal-body">
              <p class="mb-3 text-muted-custom">
                Please enter the quantity of this product that has been sold or used. This will decrease the available stock.
              </p>
              <div class="mb-3">
                <label for="quantity" class="form-label">Quantity Sold/Used</label>
                <input type="number" min="1" class="form-control custom-input" id="quantity" name="quantity" required placeholder="Enter quantity (e.g. 3)">
              </div>
            </div>
            <div class="modal-footer custom-modal-footer">
              <button type="button" class="btn btn-secondary custom-btn" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary custom-btn">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <style>
        /* Table Styling */
        .table-products {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.75rem;
            color: var(--text-light);
        }

        .table-products thead th {
            background-color: var(--dark);
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border: none;
        }

        .table-products tbody tr {
            background-color: #fff !important; /* White rows */
            color: var(--dark); /* Dark text for contrast */
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .table-products tbody tr:hover {
            background-color: #f5f5f5; /* Slightly gray on hover */
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .table-products tbody td {
            color: var(--light); /* Ensure text is light in white rows */
            padding: 1.25rem 1.5rem;
            background: #0c0b0b !important; /* Black background for cells */
            vertical-align: middle;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .table-products tbody td:first-child {
            border-left: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem 0 0 0.75rem;
        }

        .table-products tbody td:last-child {
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0 0.75rem 0.75rem 0;
        }

        /* Product Name */
        .product-name {
            font-weight: 500;
            color: var(--text-light);
        }

        /* Quantity Badges */
        .quantity-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-size: 0.8rem;
            font-weight: 600;
            min-width: 50px;
            text-align: center;
        }

        .in-stock {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .low-stock {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .out-of-stock {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        /* Usage Type Badges */
        .usage-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .usage-sale {
            background-color: rgba(13, 110, 253, 0.2);
            color: #0d6efd;
        }

        .usage-processing {
            background-color: rgba(111, 66, 193, 0.2);
            color: #6f42c1;
        }

        /* Action Buttons */
        .action-buttons {
            gap: 0.5rem;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background-color: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .btn-delete {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        /* Pagination */
        .pagination {
            --bs-pagination-color: var(--text-light);
            --bs-pagination-bg: var(--gray);
            --bs-pagination-border-color: rgba(255, 255, 255, 0.1);
            --bs-pagination-hover-color: var(--primary);
            --bs-pagination-hover-bg: var(--dark);
            --bs-pagination-hover-border-color: rgba(255, 255, 255, 0.1);
            --bs-pagination-active-bg: var(--primary);
            --bs-pagination-active-border-color: var(--primary);
            --bs-pagination-disabled-bg: var(--gray);
            --bs-pagination-disabled-color: var(--text-muted);
        }

        /* Custom Input Styling */
        .custom-input {
            background: #181818;
            color: #fff;
            border: 1px solid var(--primary);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: border-color 0.2s;
        }
        .custom-input::placeholder {
            color: #bbb;
            opacity: 1;
        }
        .custom-input:focus {
            border-color: var(--primary);
            background: #222;
            color: #fff;
            box-shadow: 0 0 0 0.1rem var(--primary);
        }

        /* Custom Select Styling */
        .custom-select {
            background: #181818;
            color: #fff;
            border: 1px solid var(--primary);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: border-color 0.2s;
        }
        .custom-select:focus {
            border-color: var(--primary);
            background: #222;
            color: #fff;
            box-shadow: 0 0 0 0.1rem var(--primary);
        }

        /* Custom Button Styling */
        .custom-btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border: none;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn-primary.custom-btn {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary.custom-btn:hover {
            background: #0a58ca;
            color: #fff;
        }
        .btn-secondary.custom-btn {
            background: #232323;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        .btn-secondary.custom-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        /* Modal Styling */
        .custom-modal-content {
            background: #181818;
            color: #fff;
            border-radius: 1rem;
            border: 1px solid var(--primary);
            box-shadow: 0 8px 32px rgba(0,0,0,0.45);
        }
        .custom-modal-header {
            background: var(--primary);
            color: #fff;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            border-bottom: none;
        }
        .custom-modal-header .modal-title {
            color: #fff;
            font-weight: 600;
        }
        .custom-modal-body {
            background: #181818;
            color: #fff;
        }
        .custom-modal-footer {
            background: #181818;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
            border-top: none;
        }
        .btn-close-white {
            filter: invert(1);
        }
        .text-muted-custom {
            color: #bbb !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .table-products thead {
                display: none;
            }

            .table-products tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.75rem;
            }

            .table-products tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem;
                border: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .table-products tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary);
                margin-right: 1rem;
                flex: 0 0 120px;
                text-transform: uppercase;
                font-size: 0.75rem;
            }

            .table-products tbody td:first-child,
            .table-products tbody td:last-child {
                border-radius: 0;
            }

            .table-products tbody td:first-child {
                border-top: 1px solid rgba(255, 255, 255, 0.05);
            }

            .action-buttons {
                justify-content: flex-end;
            }
        }
    </style>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    var soldUsedModal = new bootstrap.Modal(document.getElementById('soldUsedModal'));
    var soldUsedForm = document.getElementById('soldUsedForm');
    var quantityInput = document.getElementById('quantity');

    document.querySelectorAll('.mark-sold-used-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var stockId = this.getAttribute('data-stock-id');
            // Set the form action dynamically
            soldUsedForm.action = "{{ url('admin/stock') }}/" + stockId + "/used";
            quantityInput.value = '';
            soldUsedModal.show();
        });
    });
});
</script>