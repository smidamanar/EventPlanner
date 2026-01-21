<div id="bookingPopup" class="booking-popup">
    <div class="popup-content">
        <h2>Book Event</h2>

        <div class="popup-buttons">
            <button onclick="closeBookingPopup()" class="btn-cancel">Cancel</button>

            <form method="POST" action="{{ route('registrations.store', $event->id) }}">
                @csrf
                <button type="submit" class="btn-book">Book now</button>
            </form>
        </div>
    </div>
</div>