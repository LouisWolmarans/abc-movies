<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists("monthSelectOptions")) {
    function monthSelectOptions($month){
		$options = '<option value="" disabled>--Select Month--</option>';
		$options .= '<option value="01" '.("01" == $month ? ' selected="selected"' : '').'>January</option>';
		$options .= '<option value="02" '.("02" == $month ? ' selected="selected"' : '').'>February</option>';
		$options .= '<option value="03" '.("03" == $month ? ' selected="selected"' : '').'>March</option>';
		$options .= '<option value="04" '.("04" == $month ? ' selected="selected"' : '').'>April</option>';
		$options .= '<option value="05" '.("05" == $month ? ' selected="selected"' : '').'>May</option>';
		$options .= '<option value="06" '.("06" == $month ? ' selected="selected"' : '').'>June</option>';
		$options .= '<option value="07" '.("07" == $month ? ' selected="selected"' : '').'>July</option>';
		$options .= '<option value="08" '.("08" == $month ? ' selected="selected"' : '').'>August</option>';
		$options .= '<option value="09" '.("09" == $month ? ' selected="selected"' : '').'>September</option>';
		$options .= '<option value="10" '.("10" == $month ? ' selected="selected"' : '').'>October</option>';
		$options .= '<option value="11" '.("11" == $month ? ' selected="selected"' : '').'>November</option>';
		$options .= '<option value="12" '.("12" == $month ? ' selected="selected"' : '').'>December</option>';
		echo $options;
	}
}

if (!function_exists("yearSelectOptions")) {
    function yearSelectOptions($year){	
		$earliest_year = 2018;
		$options = '<option value="" disabled>--Select Year--</option>';
		foreach (range(date('Y'), $earliest_year) as $x) {
			$options .= '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
		}						
		echo $options;
	}
}