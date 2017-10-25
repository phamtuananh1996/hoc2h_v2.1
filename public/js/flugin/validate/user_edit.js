$(document).ready(function() {
	$('#form_edit').validate({
		rules:{
			name: {
				required:true
			},
			user_name:{
				required:true,
				remote: {
					url: "/admin/validate/checkUserName",
					type: "post",
					data: {
						user_name: function() {
							return $("#user_name").val();
						},
					}
				}
			},
			email:{
				required:true,
				email:true,
				remote: {
					url: "/admin/validate/checkEmail",
					type: "post",
					data: {
						email: function() {
							return $("#email").val();
						},
					}
				}
			},
			password:{
				minlenght:6,
				maxlenght:30
			},
			re_password:{
			 	equalTo: "#password"
			}
		},
	})
});	