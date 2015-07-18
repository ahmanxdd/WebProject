
var tmp_obj, tmp_value;

$(document).ready(function()
{
	$(".changable").on
	(
		{

			dblclick: function()
			{
				$(this).attr('readonly',false);
				tmp_obj = this;
				tmp_value = this.value;
				if(this.name == "district")
				{
					$(this).closest("tr").find('[name=cbdistrict]').show();
					$(this).closest("tr").find('[name=cbdistrict]').val(
						$(this).closest("tr").find('[name=distNo]').val()
						);
					$(this).hide();
				}
			},
			
			blur: function()
			{		
						
				if($jd == tmp_value)
					return;	
				$(this).attr('readonly',true);	
				var $jd = this.value;
				var $jn = $(this).closest("tr")
					.children('[name=jobNo]')
					.text();		
						
				if(this.name == "cbdistrict")
				{	
					alert($jd + $jn);
					var acThis = $(this);
					$(this).hide();		
					$(this).closest("tr").find('[name=district]').show();
					tmp_obj.value = this.options[this.selectedIndex].text;
					var thisvalue =  this.options[this.selectedIndex].value;
					$.post
					(
						"driver.php",
						{
								jobNo: $jn,
								distNo: $jd
						}
						
					).done(
							function(data)
							{
								if(data != "true")
								{
									alert("This job has order(s)! You can't change this");
									tmp_obj.value = tmp_value;
								}	
								acThis.closest("tr")
								.find('[name=distNo]')
								.val(thisvalue);
								alert(thisvalue);
							}
						);
						return;					
				} 
				else if(this.name=="date")
				{
					$.post
					(
						"driver.php",
						{
								jobNo: $jn,
								jobDate: $jd
						}
						
					).done(
							function(data)
							{
								if(data != "true")
								{
									alert("This job has order(s)! You can't change this");
									tmp_obj.value = tmp_value;
								}
							}
						);
				}
			}
		}
	)
	
});
