$(document).ready(function(){
var host = $('#baseUrl').val();
$('#saveUserPassword').on('click',function(event){
	//alert('hh');
	if($(this).hasClass('disabled')){
		event.preventDefault();
	}
	var oldPwd = $('#old_pwd').val();
		//alert(oldPwd); die('sss');
		var userId = $('input[name=userId]').val();
		var newPwd = $('#new_pwd').val();
		var cnfNewPwd = $('#cnf_new_pwd').val();
		if(oldPwd && newPwd && cnfNewPwd && (newPwd == cnfNewPwd)){
			$.ajax({
				url: host+"integrateideas/user/api/users/updatePassword/"+userId,
				headers:{"accept":"application/json"},
				dataType: 'json',
				data:{
					"user_id" : userId,
					"old_password" : oldPwd,
					"new_password" : newPwd,
				},
				type: "put",
				success:function(data){
					if($('#rsp_msg').hasClass('alert-danger')){
						$('#rsp_msg').removeClass('alert-danger');
					}
					if($('#rsp_msg').hasClass('alert-success')){
						$('#rsp_msg').removeClass('alert-success');
					}
					$('#rsp_msg').addClass('alert-success');
					$('#rsp_msg').append('<strong>Password changed successfully.</strong>');
					$('#rsp_msg').show();
					setTimeout(function(){
						$('#rsp_msg').fadeIn(500);
						$('#changePasswordModal').modal('hide');
						$('#rsp_msg').removeClass('alert-success');
						$('#rsp_msg').hide();
						$('#rsp_msg').html('');
					}, 2000);
				},
				error:function(data){
					var className = 'alert-danger';
					if($('#rsp_msg').hasClass('alert-success')){
						$('#rsp_msg').removeClass('alert-success');
					}
					$('#rsp_msg').addClass(className);
					$('#rsp_msg').append('<strong>' + data.responseJSON.message + '</strong>');
					setTimeout(function(){
						if($('#rsp_msg').hasClass(className)){
							$('#rsp_msg').removeClass(className);
						}
						$('#rsp_msg').hide();
						$('#rsp_msg').html('');

					}, 2000);
					$('#rsp_msg').fadeIn(500);

				},
				beforeSend: function() {

				}
			});

		}
		event.preventDefault();
	});

	// function saveCustomAction(){
	// 	$('#customAction').on('click',function(){
	// 		var cstmAction = $('#action').val();
	// 		var points = $('#actionpoints').val();
	// 		if(cstmAction && points){
	// 			$.ajax({
	// 				method: "POST",
	// 				url: host+"sa/vendorActions/add",
	// 				headers:{"accept":"application/json"},
	// 				dataType: 'json',
	// 				data:{
	// 					"action" : cstmAction,
	// 					"points" : points,
	// 				},
	// 				success:function(data){
	// 					console.log('in success');console.log(data);
	// 					$('#basicModal').modal('hide');
 //                		// window.location.reload();
	// 				},
	// 				error:function(data){
	// 					console.log('in error');console.log(data);
	// 				}
	// 			});
	// 		}
	// 	});
	// }
	
});

	