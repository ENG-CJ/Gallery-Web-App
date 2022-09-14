errorColor = "#C73E1D";
successColor = "#42ba96";


function SetTost(message, background_Color) {
    Toastify({
        text: message, duration: 3000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "right", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: background_Color,
            fontFamily: "poppins",
            borderRadius: "4px"
        },
        onClick: function () { } // Callback after click
    }).showToast();
}
