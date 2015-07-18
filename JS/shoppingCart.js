$(document).ready(function() {
    $('#cart').dataTable(
        {
          "bPaginate": false,

        }
    );
} );

function removeItem(itemID, object)
{
    alert(itemID);

    $.post(
        "shoppingCart.php",
        {
            removeID: itemID
        }
    ).done(function (data)
    {
        alert(data == "Removed");
   
        if(data == "Removed")
         {
              $('#cart').DataTable()
              .row($(object)
             .parents('tr')
             .remove().draw());
         }
    })
}