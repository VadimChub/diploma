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

    $("#productaddform-image_main").change(function () {
        readURL(this, 1);
    });
    $("#productaddform-image_side1").change(function () {
        readURL(this, 2);
    });
    $("#productaddform-image_side2").change(function () {
        readURL(this, 3);
    });
    $("#productaddform-image_brand").change(function () {
        readURL(this, 4);
    });

});