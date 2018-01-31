$(document).ready(function() {

    function readURL(input, number) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah'+number).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#images-image_main").change(function () {
        readURL(this, 1);
    });
    $("#images-image_side1").change(function () {
        readURL(this, 2);
    });
    $("#images-image_side2").change(function () {
        readURL(this, 3);
    });
    $("#images-image_brand").change(function () {
        readURL(this, 4);
    });

});