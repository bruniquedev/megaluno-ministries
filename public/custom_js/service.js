$(document).ready(function(){
	$(document).on('click', '#checkAllservice_detail', function() {          	
		$(".itemRow_servicedetail").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow_servicedetail', function() {  	
		if ($('.itemRow_servicedetail:checked').length == $('.itemRow_servicedetail').length) {
			$('#checkAllservice_detail').prop('checked', true);
		} else {
			$('#checkAllservice_detail').prop('checked', false);
		}
	});  
	var count_sd = $(".itemRow_servicedetail").length;
	$(document).on('click', '#addRows_servicedetail', function() { 
		count_sd++;
		var htmlRows_sd = '';
		htmlRows_sd += '<tr>';
		htmlRows_sd += '<td><input class="itemRow_servicedetail" type="checkbox"></td>';
		htmlRows_sd += '<td><div class="form-groupy">'+
                       '<label for="text">Service description</label>'+
                       '<div class="form-input-group"><textarea class="input-control" rows="2" name="servicedescription[]" id="servicedescription_'+count_sd+'" ></textarea></div>'+
                       '</div></td>'; 
		htmlRows_sd += '</tr>'; 

		$('#servicedetailItem').append(htmlRows_sd);
	}); 
	$(document).on('click', '#removeRows_servicedetails', function(){
		$(".itemRow_servicedetail:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAllservice_detail').prop('checked', false);
	});	









	

});	

