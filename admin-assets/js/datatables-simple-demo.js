


$(document).ready(function () {
    $('.simple-table').DataTable();

    $('#user_attendance_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });
    $('#invoice_lists').DataTable({
      
    });


});

//invoice js 
/* Shivving (IE8 is not supported, but at least it won't look as awful)
/* ========================================================================== */
$(document).ready(function () {
    var i = 1;
    $("#add_row").click(function () {
        b = i - 1;
        $("#addr" + i)
            .html($("#addr" + b).html())
            .find("td:first-child")
            .html(i + 1);
        $("#tab_logic").append('<tr id="addr' + (i + 1) + '"></tr>');
        i++;
    });
    $("#delete_row").click(function () {
        if (i > 1) {
            $("#addr" + (i - 1)).html("");
            i--;
        }
        calc();
    });

    $("#tab_logic tbody").on("keyup change", function () {
        calc();
    });
    $("#tax").on("keyup change", function () {
        calc_total();
    });
});

function calc() {
    $("#tab_logic tbody tr").each(function (i, element) {
        var html = $(this).html();
        if (html != "") {
            var qty = $(this).find(".qty").val();
            var price = $(this).find(".price").val();
            $(this)
                .find(".total")
                .val(qty * price);

            calc_total();
        }
    });
}

function calc_total() {
    total = 0;
    $(".total").each(function () {
        total += parseInt($(this).val());
    });
    $("#sub_total").val(total.toFixed(2));
    tax_sum = (total / 100) * $("#tax1").val();
    $("#tax_amount").val(tax_sum.toFixed(2));
    $("#total_amount").val((tax_sum + total).toFixed(2));
}
