@if ($filteredTickets->count() > 0)

    {{-- @foreach ($filteredTickets as $ticket)
                                                    <tr>
                                                        <td>{{ $ticket->id }}</td>
                                                        <td>{{ $ticket->status }}</td>
                                                        <td>{{ $ticket->category }}</td>
                                                        <!-- Add more columns as needed -->
                                                    </tr>
                                                @endforeach --}}

    @foreach ($filteredTickets as $supportTicket)
        <div class="message">
            <div>
                <div class="d-flex message-single">
                    <div class="ps-1 align-self-center">
                        <div class="form-check custom-checkbox">
                            <input type="checkbox" class="form-check-input" id="ticket{{ $supportTicket->ticket_id }}">
                            <label class="form-check-label" for="ticket{{ $supportTicket->ticket_id }}"></label>
                        </div>
                    </div>
                    <div class="ms-3">
                        <label class="bookmark-btn">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <a href="{{ route('support-tickets.show', $supportTicket->ticket_id) }}" class="col-mail col-mail-2">
                    <div class="subject">#{{ $supportTicket->ticket_id }}
                        &nbsp;
                        - {{ $supportTicket->category }} &nbsp; -
                        &nbsp;&nbsp; {{ $supportTicket->subject }} -
                        {{ $supportTicket->message }}</div>
                    <div class="date">
                        {{ $supportTicket->created_at->format('d M Y H:i A') }}
                    </div>
                </a>
            </div>
        </div>
    @endforeach

    {{-- Include your custom pagination layout --}}
    {{-- {!! $supportTickets->links('partials.pagination') !!} --}}
    {{-- @include('partials.pagination', ['paginator' => $supportTickets]) --}}
    {{-- <div class="row mt-4">
                                                    <div class="col-12 ps-3">
                                                        <nav>
                                                            {{ $supportTickets->links('pagination::bootstrap-5') }}
                                                        </nav>
                                                    </div>
                                                </div> --}}
    <div class="row mt-4">
        <div class="col-12 ps-3">
            <nav>
                <ul class="pagination pagination-gutter pagination-primary pagination-sm no-bg">
                    <li class="page-item page-indicator">
                        <a class="page-link" href="{{ $filteredTickets->previousPageUrl() }}">
                            <i class="la la-angle-left"></i>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $filteredTickets->lastPage(); $i++)
                        <li class="page-item {{ $filteredTickets->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $filteredTickets->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item page-indicator">
                        <a class="page-link" href="{{ $filteredTickets->nextPageUrl() }}">
                            <i class="la la-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@else
    <p>No support tickets found.</p>

@endif
