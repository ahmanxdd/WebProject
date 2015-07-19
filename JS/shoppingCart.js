$(document).ready(function () {
    $('#cart').dataTable(
        {
            "bPaginate": false,
            "bFilter": false,
            "bInfo" : false
        }
        );
});

function removeItem(itemID, object) {
    $.post(
        "shoppingCart.php", { removeID: itemID })
        .done(function (data) {
            if (data == "Removed") {
                $.post(
                    "shoppingCart.php", { getTotalAmount: "true" })
                    .done(function (data) {
  
                        $('#totalAmount').html(data);
                    })
                $('#cart').DataTable()
                    .row($(object)
                        .parents('tr')
                        .remove().draw());
            }
        })

}
