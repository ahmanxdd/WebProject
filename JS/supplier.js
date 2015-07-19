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
	$("#chartHolder").CanvasJSChart().options = array;    
     $("#chartHolder").CanvasJSChart().render();
}


function getCatChart(reCode,suppNo)
{
	
	catNo = $("#selectcat").val();
	title = $("#selectcat option:selected").html();
	$.post("ajax/chart.php",
		{
			'catNo':catNo,
			'title': title,
			'suppNo': suppNo,
			'requestCode': reCode
		}).done(		
			function(data)
			{
				addData(JSON.parse(data));
			}
		);
}

function getChart(reCode,suppNo,title)
{
	$.post("ajax/chart.php",
		{
			'title': title,
			'suppNo': suppNo,
			'requestCode': reCode
		}).done(		
			function(data)
			{
				addData(JSON.parse(data));
			}
		);
}