/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 */

$(document).ready(function(){
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			fname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			role : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});

	var addCustomerForm = $("#addCustomer");
	
	var validator = addCustomerForm.validate({
		
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

	var addServiceForm = $("#addService");
	
	var validator = addServiceForm.validate({
		
		rules:{
			fname :{ required : true },
			description : { required : true },
			price : { required : true, digits : true }
		},
		messages:{
			fname :{ required : "This field is required" },
			description : { required : "This field is required"},
			price : { required : "This field is required", digits : "Please enter numbers only" }		
		}
	});

	var addStageForm = $("#addStage");
	
	var validator = addStageForm.validate({
		
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
			cusrole : { required : true, selected : true},
			svcrole : { required : true, selected : true},
			weight : { required : true, digits : true, min : 1, max : 99 },
			memo : { required : true }
		},
		messages:{
			cusrole : { required : "This field is required", selected : "Please select atleast one option" },			
			svcrole : { required : "This field is required", selected : "Please select atleast one option" },
			weight : { required : "This field is required", digits : "Please enter numbers only", min : "The Minimum value is 0", max : "The Maximum value is 99"  },				
			memo : { required : "This field is required"}
		}
	});
});
