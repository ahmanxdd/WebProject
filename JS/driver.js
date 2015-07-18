
var tmp_obj, tmp_value;

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
						"driver.php",
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
								acThis.closest("tr")
									.find('[name=distNo]')
									.val(thisvalue);
							}
							);
					return;
				}
				else if (this.name == "date") {
					$.post
						(
						"driver.php",
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
			$.post("driver.php",
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

		)

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
    $("input[type=submit]")
		.button()
		.click(function (event) {
			event.preventDefault();
			$(this).closest("form").submit();
		});
});

$(function () {
    $("#check").button();
    $("#format").buttonset();
});

$(function () {
    $(".jqStyle_selectDistrict").selectmenu();
});

$(function () {

})

$(function () {
	var spinner = $(".jqStyle_spinner").spinner();
})