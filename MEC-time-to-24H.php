<?php
		
$mecStartDate = get_field('mec_start_date');		
$displayStartDate = date("l, j F Y", strtotime($mecStartDate));

$mecEndDate = get_field('mec_end_date');
$displayEndDate = date("l, j F Y", strtotime($mecEndDate));

$startHour = get_field('mec_start_time_hour');
$startAMPM = get_field('mec_start_time_ampm'); 
if ($startAMPM == 'PM') $startHour += 12;
if ($startHour  < 10) $startHour  = '0' . $startHour;
$startMinutes = get_field('mec_start_time_minutes');
if ($startMinutes  < 10) $startMinutes  = '0' . $startMinutes;
$startTime_24 = $startHour . ':' . $startMinutes;

$endHour = get_field('mec_end_time_hour');
$endAMPM = get_field('mec_end_time_ampm'); 
if ($endAMPM == 'PM') $endHour += 12;
if ($endHour  < 10) $endHour  = '0' . $endHour;
$endMinutes = get_field('mec_end_time_minutes');
if ($endMinutes  < 10) $endMinutes  = '0' . $endMinutes;
$endTime_24 = $endHour . ':' . $endMinutes;

$timeString = $displayStartDate . '. ' . $startTime_24 . ' - ' . $endTime_24;		

?>