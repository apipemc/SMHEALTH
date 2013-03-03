$(document).on('ready', init);

function init(){	
	 $('select[multiple="multiple"]').multiselect({language: 'es'});
	 $.datepicker.regional["es"].dateFormat = 'yy-mm-dd';
	 $.datepicker.regional["es"].changeMonth = true;
	 $.datepicker.regional["es"].changeYear  = true;	 
	 $.datepicker.setDefaults($.datepicker.regional['es']);	 
	 $("#Birthday, #date").datepicker({ beforeShowDay: noWeekendsOrHolidays });
}

natDays = [
           [1, 26, 'au'], [2, 6, 'nz'], [3, 17, 'ie'],
           [4, 27, 'za'], [5, 25, 'ar'], [6, 6, 'se'],
           [7, 4, 'us'], [8, 17, 'id'], [9, 7, 'br'],
           [10, 1, 'cn'], [11, 22, 'lb'], [12, 12, 'ke']
         ];

function nationalDays(date) {
    for (i = 0; i < natDays.length; i++) {
      if (date.getMonth() == natDays[i][0] - 1
          && date.getDate() == natDays[i][1]) {
        return [false, natDays[i][2] + '_day'];
      }
    }
  return [true, ''];
}

function noWeekendsOrHolidays(date) {
    var noWeekend = $.datepicker.noWeekends(date);
    if (noWeekend[0]) {
        return nationalDays(date);
    } else {
        return noWeekend;
    }
}