@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/views/admin/message/index.css') }}">

    <div class="container-fluid">
        <div class="messages-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-envelope me-3"></i> Contact Messages
                </h2>
                <div class="unread-count">
                    <span class="badge bg-primary">{{ $unreadCount }} Non-lus</span>
                </div>
            </div>

            <div class="form-card-wrapper p-4">
                <div class="table-responsive">
                    <table class="table table-messages">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                            <tr class="{{ $message->read_at ? '' : 'unread' }}">
                                <td>
                                    @if($message->read_at)
                                        <span class="status-badge read">
                                            <i class="fas fa-check-circle me-1"></i> Read
                                        </span>
                                    @else
                                        <span class="status-badge unread">
                                            <i class="fas fa-exclamation-circle me-1"></i> New
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $message->name }}</td>
                                <td>
                                    <a href="tel:{{ $message->phone }}">{{ $message->phone }}</a>
                                </td>
                                <td class="message-preview">
                                    {{ Str::limit($message->message, 80) }}
                                    @if(strlen($message->message) > 80)
                                        <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#messageModal-{{ $message->id }}">Read more</a>
                                    @endif
                                </td>
                                <td>{{ $message->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="d-flex action-buttons">
                                        @if(!$message->read_at)
                                        <form action="{{ route('messages.markAsRead', $message->id) }}" method="POST" class="me-2">
                                            @csrf
                                            <button type="submit" class="btn-action btn-mark-read" title="Mark as read">
                                                <i class="fas fa-envelope-open-text"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Message Modal -->
                            <div class="modal fade" id="messageModal-{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Message de {{ $message->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="message-meta mb-3">
                                                <div><strong>Email:</strong> <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
                                                <div><strong>Date:</strong> {{ $message->created_at->format('F j, Y \a\t g:i A') }}</div>
                                            </div>
                                            <div class="message-content">
                                                {{ $message->message }}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                                            @if(!$message->read_at)
                                            <form action="{{ route('messages.markAsRead', $message->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-booking">
                                                    <i class="fas fa-envelope-open-text me-1"></i> Marquer comme lu
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection