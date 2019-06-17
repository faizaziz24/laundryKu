/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 */
$(document).ready(function(){
	
	var editUserForm = $("#editUser");
	
	var validator = editUserForm.validate({
		
		rules:{
			fname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
			cpassword : {equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			cpassword : {equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});

	var editProfileForm = $("#editProfile");
	
	var validator = editProfileForm.validate({
		
		rules:{
			fname :{ required : true },
			mobile : { required : true, digits : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
		},
		messages:{
			fname :{ required : "This field is required" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
		}
	});

	var editCustomerForm = $("#editCustomer");
	
	var validator = editCustomerForm.validate({
		
		rules:{
			fname :{ required : true },
			address : { required : true },
			mobile : { required : true, digits : true }
		},
		messages:{
			fname :{ required : "This field is required" },
			address : { required : "This field is required"},
			mobile : { required : "This field is required", digits : "Please enter numbers only" }		
		}
	});

	var editServiceForm = $("#editService");
	
	var validator = editServiceForm.validate({
		
		rules:{
			fname :{ required : true },
			description : { required : true },
			price : { required : true, number : true }
		},
		messages:{
			fname :{ required : "This field is required" },
			description : { required : "This field is required"},
			price : { required : "This field is required", number : "Please enter numbers only" }		
		}
	});

	var editStageForm = $("#editStage");
	
	var validator = editStageForm.validate({
		
		rules:{
			fname :{ required : true },
			description : { required : true }
		},
		messages:{
			fname :{ required : "This field is required" },
			description : { required : "This field is required"}	
		}
	});

	var addOrderForm = $("#addOrder");
	
	var validator = addOrderForm.validate({
		
		rules:{
			stgrole : { required : true, selected : true}
		},
		messages:{
			stgrole : { required : "This field is required", selected : "Please select atleast one option" }
		
		}
	});

});