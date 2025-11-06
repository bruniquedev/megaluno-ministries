$(document).ready(function(){
	$(document).on('click', '#checkAll_detail', function() {          	
		$(".itemRow_detail").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow_detail', function() {  	
		if ($('.itemRow_detail:checked').length == $('.itemRow_detail').length) {
			$('#checkAll_detail').prop('checked', true);
		} else {
			$('#checkAll_detail').prop('checked', false);
		}
	});  
	var count_ad = $(".itemRow_detail").length;
	$(document).on('click', '#addRows_detail', function() { 
		count_ad++;
		var htmlRows_ad = '';
		htmlRows_ad += '<tr>';
		htmlRows_ad += '<td><input class="itemRow_detail" type="checkbox">'+
		'<input type="hidden" name="itemid[]" id="itemid_'+count_ad+'" value="0" /></td>';
        htmlRows_ad += '<td><div class="form-groupy">'+
                        '<label for="text">Heading</label>'+
                        '<div class="form-input-group"><input type="text" class="input-control" name="detailheading[]" id="detailheading_'+count_ad+'"  autocomplete="off" /></div>'+
                        '</div></td>';
		htmlRows_ad += '<td><div class="form-groupy">'+
                       '<label for="text">Description</label>'+
                       '<div class="form-input-group"><textarea class="input-control" rows="2" name="detaildescription[]" id="detaildescription_'+count_ad+'" ></textarea></div>'+
                       '</div></td>'; 
		htmlRows_ad += '</tr>'; 

		$('#detailItem').append(htmlRows_ad);
	}); 
	$(document).on('click', '#removeRows_details', function(){
		$(".itemRow_detail:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll_detail').prop('checked', false);
	});	













	

});	

