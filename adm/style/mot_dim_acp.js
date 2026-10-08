/**
*
* @package MoT DIM v0.1.0
* @copyright (c) 2024 Mike-on-Tour
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

(function($) {  // Avoid conflicts with other libraries

'use strict';

/*
* Set the possible max number according to the interval unit on entering the number input field
*/
$("#mot_dim_cron_interval").on("focus", function() {
	// Set max input to 23 if the unit is hours
	if ($("#mot_dim_cron_unit").val() == 0)	{
		$(this).attr('max', 23);
	}

	// Set max input to the number of days since registration to deletion if unit is days
	if ($("#mot_dim_cron_unit").val() == 1)	{
		$(this).attr('max', $("#mot_dim_days_delete").val());
	}
});

/*
* Set the possible max number to the number input field after changing the interval unit
*/
$("#mot_dim_cron_unit").on("change", function() {
	// Set max input for interval to 23 if hours are selected
	if ($(this).val() == 0) {
		$("#mot_dim_cron_interval").attr('max', 23);
	}

	// Set max input for interval to the number of days since registration to deletion if days are selected
	if ($(this).val() == 1)	{
		$("#mot_dim_cron_interval").attr('max', $("#mot_dim_days_delete").val());

		// Check the cron interval for a value greater than the number of days since registration and limit it if necessary
		let exceedMaxDays = $("#mot_dim_cron_interval").val() > $("#mot_dim_days_delete").val();
		if (exceedMaxDays) {
			$("#mot_dim_cron_interval").val($("#mot_dim_days_delete").val());
		}
	}
});

/*
* Disable the "Test settings" button after changes to one or more of the deletion settings
*/
$("#mot_dim_protected_users").on("blur", function() {
	$("#mot_dim_check_results").prop("disabled", true);
});

$("#mot_dim_days_delete, #mot_dim_enable_sleeper, #mot_dim_enable_zeropost, #mot_dim_protected_groups").on("change", function() {
	$("#mot_dim_check_results").prop("disabled", true);
});

})(jQuery); // Avoid conflicts with other libraries
