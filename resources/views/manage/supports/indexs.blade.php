<!-- Search Form -->
<div class="btn-group mb-1 flex">
    <form id="filter-form" action="{{ route('support-tickets.index') }}" method="GET">
        <div>
            <select name="status" class="form-control">
                <option value="">Select Status</option>
                <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <select name="category" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
            <button type="submit">Filter</button>
        </div>
    </form>
</div>

<!-- Display Filtered Results -->
<div id="filtered-results">
    <!-- Results will be dynamically updated by JavaScript -->
    @if ($filteredTickets->count() > 0)
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
                        <div class="subject">#{{ $supportTicket->ticket_id }} &nbsp; - {{ $supportTicket->category }} &nbsp; - &nbsp;&nbsp; {{ $supportTicket->subject }} - {{ $supportTicket->message }}</div>
                        <div class="date">{{ $supportTicket->created_at->format('d M Y H:i A') }}</div>
                    </a>
                </div>
            </div>
        @endforeach

        <!-- Pagination Links -->
        <div class="row mt-4">
            <div class="col-12 ps-3">
                <nav>
                    {{ $filteredTickets->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    @else
        <p>No support tickets found.</p>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var searchQuery = $(this).val();

            // Send AJAX request to fetch filtered results
            $.ajax({
                url: '{{ route("support-tickets.index") }}',
                method: 'GET',
                data: {
                    search: searchQuery
                },
                success: function(response) {
                    // Update the section containing filtered results with the new data
                    $('#filtered-results').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>