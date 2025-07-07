@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="messages-container">
            <div class="d-flex justify-content-between align-items-center mb-4 dashboard-header">
                <h2 class="service-title dashboard-section-title">
                    <i class="fas fa-envelope me-3"></i> Contact Messages
                </h2>
                <div class="unread-count">
                    <span class="badge bg-primary">{{ $unreadCount }} Unread</span>
                </div>
            </div>

            <div class="form-card-wrapper p-4">
                <div class="table-responsive">
                    <table class="table table-messages">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Email</th>
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
                                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
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
                                            <h5 class="modal-title">Message from {{ $message->name }}</h5>
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            @if(!$message->read_at)
                                            <form action="{{ route('messages.markAsRead', $message->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-booking">
                                                    <i class="fas fa-envelope-open-text me-1"></i> Mark as Read
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

    <style>
        /* Messages Table Styling */
        .table-messages {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.75rem;
            color: var(--text-light);
        }

        .table-messages thead th {
            background-color: var(--dark);
            color: var(--primary);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border: none;
        }

        .table-messages tbody tr {
            background-color: var(--gray);
            transition: all 0.3s ease;
            border-radius: 0.75rem;
        }

        .table-messages tbody tr.unread {
            background-color: rgba(13, 110, 253, 0.05);
            border-left: 3px solid var(--primary);
        }

        .table-messages tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table-messages tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: white;
            background-color: rgba(255, 255, 255, 0.05);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .table-messages tbody td:first-child {
            border-left: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem 0 0 0.75rem;
        }

        .table-messages tbody td:last-child {
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0 0.75rem 0.75rem 0;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .status-badge.unread {
            background-color: rgba(13, 110, 253, 0.2);
            color: #0d6efd;
        }

        .status-badge.read {
            background-color: rgba(108, 117, 125, 0.2);
            color: #6c757d;
        }

        /* Message Preview */
        .message-preview {
            max-width: 250px;
        }

        .read-more {
            color: var(--primary);
            font-size: 0.8rem;
            margin-left: 0.5rem;
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        /* Modal Styling */
        .modal-content {
            background-color: var(--gray);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .message-meta {
            background-color: var(--dark);
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
        }

        .message-content {
            padding: 1rem;
            white-space: pre-wrap;
            line-height: 1.6;
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

        .btn-mark-read {
            background-color: rgba(13, 110, 253, 0.2);
            color: #0d6efd;
        }

        .btn-delete {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .btn-mark-read:hover {
            background-color: rgba(13, 110, 253, 0.3);
        }

        .btn-delete:hover {
            background-color: rgba(220, 53, 69, 0.3);
        }

        /* Unread Count */
        .unread-count .badge {
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
            font-weight: 600;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .message-preview {
                max-width: 200px;
            }
        }

        @media (max-width: 767.98px) {
            .table-messages thead {
                display: none;
            }

            .table-messages tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 0.75rem;
            }

            .table-messages tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem;
                border: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .table-messages tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary);
                margin-right: 1rem;
                flex: 0 0 100px;
                text-transform: uppercase;
                font-size: 0.75rem;
            }

            .table-messages tbody td:first-child,
            .table-messages tbody td:last-child {
                border-radius: 0;
            }

            .table-messages tbody td:first-child {
                border-top: 1px solid rgba(255, 255, 255, 0.05);
            }

            .action-buttons {
                justify-content: flex-end;
            }

            .message-preview {
                max-width: none;
            }
        }
    </style>
@endsection