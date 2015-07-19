

var tmp_obj, tmp_value;


	$("#OrderTable tbody tr").on("click",".deletelanguage",function (event) {
			alert ("HO");
		}
			
	),




$(document).ready(function () {






	$(".changable").on
		(
		{

			dblclick: function () {
				$(this).attr('readonly', false);
				tmp_obj = this;
				tmp_value = this.value;
				if (this.name == "district") {
					$(this).closest("tr").find('[name=cbdistrict]').show();
					$(this).closest("tr").find('[name=cbdistrict]').val(
						$(this).closest("tr").find('[name=distNo]').val()
						);
					$(this).hide();
				}
			},

			blur: function () {

				if ($jd == tmp_value)
					return;
				$(this).attr('readonly', true);

				var $jd = this.value;
				var $jn = $(this).closest("tr")
					.find('[name=jobNo]')
					.val();
				if (this.name == "cbdistrict") {

					var acThis = $(this);
					$(this).hide();
					$(this).closest("tr").find('[name=district]').show();
					tmp_obj.value = this.options[this.selectedIndex].text;
					var thisvalue = this.options[this.selectedIndex].value;
					$.post
						(
						"../BackProcess/driver.php",
						{
							jobNo: $jn,
							distNo: $jd
						}

						).done(
							function (data) {

								if (data != "true") {
									alert("This job has order(s)! You can't change this");
									tmp_obj.value = tmp_value;
								}
								else {
									acThis.closest("tr")
										.find('[name=distNo]')
										.val(thisvalue);
								}
							}

							);
					return;
				}
				else if (this.name == "date") {
					$.post
						(
						"../BackProcess/driver.php",
						{
							jobNo: $jn,
							jobDate: $jd
						}

						).done(
							function (data) {
								if (data != "true") {
									alert("This job has order(s)! You can't change this");
									tmp_obj.value = tmp_value;
								}
							}
							);
				}
			}
		}
		);

	$(".removeJob").click(
		function () {
			var jobNo = $(this).closest("tr")
				.find('[name=jobNo]')
				.val();
			var acThis = $(this);
			$.post("../BackProcess/driver.php",
				{
					jobNo: jobNo,
					remove: true
				}

				).done(function (data) {
					if (data != "true") {
						alert("This job has order(s)! You can't remove this");
						return;
					}
					else {
						acThis.closest("tr").remove();
					}
				}
					);

		}

		),

	$("#jobTable tbody tr").click(function () {
		var $jobNo = $(this).find('[name=jobNo]').val();

		$.post("../BackProcess/driver.php",
			{
				getDetail: true,
				jobNo: $jobNo
			})
			.done(function (data) {
				$("#retPlaceHold\er").html(data);
			})
	})

});

$(function () {
	$("#datepicker").datepicker();
	$("#datepicker").button().css
		({
			'font': 'inherit',
			'color': 'inherit',
			'text-align': 'left',
			'outline': 'none',
			'cursor': 'text'
		})
});


$(function () {
    $("#weeklydialog").dialog({
		autoOpen: false,
		modal: true,
		dialogClass: "alert",

		resizable: false,
		title: null,
		show: {
			effect: "blind",
			duration: 250
		},
		hide: {
			effect: "explode",
			duration: 250
		}
    });

    $("#weekopener").click(function () {
		$("#weeklydialog").dialog("open");
    });
});

$(function () {
    $("#dailydialog").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 325,
		show: {
			effect: "blind",
			duration: 250
		},
		hide: {
			effect: "explode",
			duration: 250
		}
    });

    $("#dayopener").click(function () {
		$("#dailydialog").dialog("open");
    });
});