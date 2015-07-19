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
	var options = {
                animationEnabled: true				
	};

	$("#chartHolder").CanvasJSChart(options);
    
    
}

function addData(array)
{
	$("#chartHolder").CanvasJSChart().options.data = array["data"];    
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
				addData(JSON.parse(data));
			}
		);
}