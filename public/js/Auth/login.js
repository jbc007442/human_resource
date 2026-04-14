$(document).ready(function () {
    // 👁 Toggle password (ONLY ONCE)
    $("#togglePassword").on("click", function () {
        const passwordInput = $("#loginPassword");
        const eyeIcon = $("#eyeIcon");

        const type =
            passwordInput.attr("type") === "password" ? "text" : "password";
        passwordInput.attr("type", type);

        eyeIcon.toggleClass("fa-eye fa-eye-slash");
        $(this).toggleClass("text-blue-600 text-slate-400");
    });

    // 🚀 AJAX LOGIN
    $("#loginForm").on("submit", function (e) {
        e.preventDefault();

        let btn = $("#loginBtn");
        let errorBox = $("#loginError");

        errorBox.addClass("hidden").text("");
        btn.prop("disabled", true).html("Signing in...");

        $.ajax({
            url: loginUrl,
            type: "POST",
            data: {
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
                remember: $('input[name="remember"]').is(":checked") ? 1 : 0,
                _token: csrfToken,
            },
            success: function (res) {
                if (res.status) {
                    window.location.href = res.redirect;
                }
            },
            error: function (xhr) {
                let msg = "Invalid email or password";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                errorBox.removeClass("hidden").text(msg);

                btn.prop("disabled", false).html(`
                    <span>Sign In</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                `);
            },
        });
    });
});
