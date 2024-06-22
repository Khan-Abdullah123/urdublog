(function() {
    if (!window.jQuery) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
        document.head.appendChild(script);
    }

    var loadSweetAlert = function() {
        $.getScript('https://unpkg.com/sweetalert/dist/sweetalert.min.js')
        .done(function() {
            // Your JavaScript code that depends on SweetAlert goes here
            swal('Hello, world!');
        });
    };

    if (window.jQuery) {
        loadSweetAlert();
    } else {
        $(document).ready(loadSweetAlert);
    }
})();
