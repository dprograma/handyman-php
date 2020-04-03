$(document).ready(function () {
    var max_fields = 20;
    var count = 1;
    $("#add").click(function (e) {
        e.preventDefault();
        if (count < max_fields) {
            count++;
            var inputgroup = "<div class='input-group mt-3'>" +
                "<input type='text' class='form-control rounded-0' name='' id='' value=''><span class='remove-field'><i class='fa fa-times'></i></span></div>";
            $("#wrapper").append(inputgroup);
        }
    });

    $("#wrapper").on("click", ".remove-field", function (e) {
        e.preventDefault();
        $(this).parent('div').empty();
        count--;
    });

    $("#wrapper").on("change", "input", function (e) {
        e.preventDefault();
        $(this).attr('name', count++);
    });
});


