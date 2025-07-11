@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/stock/index.css') }}">
    <div class="container-fluid">
        <div class="products-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-boxes me-3"></i> Non lus ({{ $notifications->where("status", 'unread')->count() }})
                </h2>
            </div>

            <!-- Filter Form -->
            {{-- <form method="GET" action="{{ route('stock.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control custom-input" placeholder="Recherche par nom" value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="quantity_filter" class="form-select custom-select">
                        <option value="">Statut</option>
                        <option value="in-stock" {{ request('quantity_filter') == 'in-stock' ? 'selected' : '' }}>En Stock</option>
                        <option value="low-stock" {{ request('quantity_filter') == 'low-stock' ? 'selected' : '' }}>Stock Bas (&lt; 10)</option>
                        <option value="out-of-stock" {{ request('quantity_filter') == 'out-of-stock' ? 'selected' : '' }}>Rupture</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary custom-btn">Filtre</button>
                    <a href="{{ route('stock.index') }}" class="btn btn-secondary custom-btn">reinitialiser</a>
                </div>
            </form> --}}

            <div class="form-card-wrapper p-4">
                <div class="table-responsive">
                   <table class="table table-products">
                        <thead>
                            <tr>
                                <th>Contenu</th>
                                <th class="text-end">Actions</th> <!-- Right align header -->
                            </tr>
                        </thead>
                        <tbody>
                            @if($notifications->isEmpty())
                                <tr>
                                    <td colspan="2" class="text-center text-muted-custom py-5">
                                        <i class="fas fa-box-open fa-2x mb-2"></i>
                                        <div>Aucune notification</div>
                                    </td>
                                </tr>
                            @endif

                            @foreach($notifications as $notification)
                                <tr @if($notification->status === 'unread') class="table-warning" @endif>
                                    <td>-> {{ $notification->content }}</td>
                                    <td class="text-end">
                                        
                                        <form action="{{ route('notification.destroy', $notification->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette notification ?')">
                                                <i class="fas fa-trash-alt"></i>
                                                @if($notification->status === 'unread')
                                                    <span class="badge bg-warning mx-5 text-dark">Non lu</span>
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($notifications, 'links'))
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifications->links() }}
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
              <h5 class="modal-title" id="soldUsedModalLabel">Marker comme vendu/utilier</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom-modal-body">
              <p class="mb-3 text-muted-custom">
                S'il vous plait entrez la quantite de produit vendu ou utiliser ils sera deduit des stock.
              </p>
              <div class="mb-3">
                <label for="quantity" class="form-label">Quantite vendu/utiliser</label>
                <input type="number" min="1" class="form-control custom-input" id="quantity" name="quantity" required placeholder="Enter quantity (e.g. 3)">
              </div>
            </div>
            <div class="modal-footer custom-modal-footer">
              <button type="button" class="btn btn-secondary custom-btn" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary custom-btn">soummetre</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    @php
         \App\Models\Notification::where('status', 'unread')->update(['status' => 'read']);
    @endphp
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