<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script defer>
$(document).ready(function() {
    $(document).on("click", "nav .nav-item a", function() {
        let href = $(this).attr("dynamic_href");
        $("#dynamic_iframe").attr("src", href);

        $("nav .nav-item a").attr("class", "nav-link");
        $(this).attr("class", "nav-link active");

        Swal.fire({
            title: 'Loading...',
            html: 'Please wait...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });

    });

    $("#dynamic_iframe").on("load", function() {
        Swal.close();
    })

});
</script>

</body>

</html>