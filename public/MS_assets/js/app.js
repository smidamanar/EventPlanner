
function openBookingPopup() {
    document.getElementById('bookingPopup').classList.add('active');
}

function closeBookingPopup() {
    document.getElementById('bookingPopup').classList.remove('active');
}

    document.getElementById('user-dropdown-toggle')?.addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('user-dropdown')?.classList.toggle('show');
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('user-dropdown-toggle')?.contains(e.target)) {
            document.getElementById('user-dropdown')?.classList.remove('show');
        }
    });
 