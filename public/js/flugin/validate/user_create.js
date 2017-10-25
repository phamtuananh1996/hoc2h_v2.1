$(document).ready(function() {
	$('#usercreate').validate({
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
				required:true,
				minlenght:6,
				maxlenght:30
			},
			password:{
				required:true,
				minlenght:6,
				maxlenght:30
			},
			re_password:{
				required:true,
			 equalTo: "#password"
			}
		},
	})
});	