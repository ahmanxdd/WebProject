$(document).ready(function () {
    $('#ourProductList').dataTable(
        {
            "bPaginate": false,
            "bInfo" : false
        }
        );
        
        $("td").attr("align","center");
});


window.onload = function () {

//Better to construct options first and then pass it as a parameter

    
    
}

function addData(array)
{
	var options = array;
	$("#chartHolder").CanvasJSChart(options);    
     $("#chartHolder").CanvasJSChart().render();
}

function getChart(reCode,suppNo)
{
	$.post("ajax/chart.php",
		{
			'suppNo': suppNo,
			'requestCode': reCode
		}).done(		
			function(data)
			{
				alert(data);
				addData(JSON.parse(data));
			}
		);
}