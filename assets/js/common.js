jQuery(document).ready(function(){
	jQuery(document).on("click", ".deleteStage", function(){
		var stageId = $(this).data("stageid"),
			hitURL = baseURL + "deleteStage",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this stage ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { stageId : stageId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Stage successfully deleted"); }
				else if(data.status = false) { alert("Stage deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteService", function(){
		var serviceId = $(this).data("serviceid"),
			hitURL = baseURL + "deleteService",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this service ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { serviceId : serviceId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Service successfully deleted"); }
				else if(data.status = false) { alert("Service deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteCustomer", function(){
		var customerId = $(this).data("customerid"),
			hitURL = baseURL + "deleteCustomer",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this customer ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { customerId : customerId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Customer successfully deleted"); }
				else if(data.status = false) { alert("Customer deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
