document.addEventListener("DOMContentLoaded", function () {

    // ===== Password Toggle =====
    const password = document.getElementById("password");
    const toggle = document.getElementById("togglePassword");

    if (password && toggle) {
        toggle.addEventListener("click", function () {

            if (password.type === "password") {
                password.type = "text";
                toggle.classList.remove("fa-eye");
                toggle.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                toggle.classList.remove("fa-eye-slash");
                toggle.classList.add("fa-eye");
            }

        });
    }

    // ===== Dropdown =====
    const dropdowns = document.querySelectorAll(".dropdown");

    dropdowns.forEach(dropdown => {

        const button = dropdown.querySelector(".dropbtn");

        button.addEventListener("click", function (e) {

            e.stopPropagation();

            // Close other dropdowns
            dropdowns.forEach(d => {
                if (d !== dropdown) {
                    d.classList.remove("active");
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle("active");
        });

    });

    // Close when clicking outside
    document.addEventListener("click", function () {
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove("active");
        });
    });

});

function confirmLogout(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Logout?',
        text: 'Are you sure you want to end your administrator session?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#f05a28',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Logout',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'logout.php';
        }
    });
}