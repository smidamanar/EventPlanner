
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
        const toggle = document.getElementById('user-toggle');
        const menu = document.getElementById('user-dropdown');

        toggle?.addEventListener('click', e => {
            e.stopPropagation();
            menu?.classList.toggle('show');
        });

        document.addEventListener('click', e => {
            if (!toggle?.contains(e.target)) {
                menu?.classList.remove('show');
            }
        });