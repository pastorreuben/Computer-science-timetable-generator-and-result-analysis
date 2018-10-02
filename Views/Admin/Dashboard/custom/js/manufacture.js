var manageManufactureTable;

$(document).ready(function() {
  //top bar active
  $("#navManufacture").addClass('active');

  //manage manufacture table
  manageManufactureTable = $("#manageManufactureTable").DataTable({
  	    'ajax': 'php_action/fetchManufacturers.php',
		'order': []		
  });

  
 
});


function addManufacturer() {
	$("#submitManufactureForm")[0].reset();
	// remove the error 
    $('.text-danger').remove();
    // remove the form-error
	$('.form-group').removeClass('has-error').removeClass('has-success');


	//submit manufacture form function
    $("#submitManufactureForm").unbind('submit').bind('submit', function() {
      
      //remove the error text
      $(".text-danger").remove();
      //remove the form error
      $(".form-group").removeClass("has-error").removeClass("has-success");   

      var manufactureName = $("#ManufactureName").val();
      var manufactureContact = $("#ManufactureContact").val();
      var manufactureAddress = $("#ManufactureAddress").val();
      var manufactureStatus = $("#ManufactureStatus").val();

      if(manufactureName == "") {
         $("#ManufactureName").after('<p class ="text-danger"> Manufacture Name field is required</p>');
         $("#ManufactureName").closest('.form-group').addClass('has-error');

      } else {
      	$("#ManufactureName").find('.text-danger').remove();
      	$("#ManufactureName").closest('.form-group').addClass('has-success');
      }    


      if(manufactureContact == "") {
         $("#ManufactureContact").after('<p class ="text-danger"> Manufacture Contact field is required</p>');
         $("#ManufactureContact").closest('.form-group').addClass('has-error');

      } else {
      	$("#ManufactureContact").find('.text-danger').remove();
      	$("#ManufactureContact").closest('.form-group').addClass('has-success');
      }


      if(manufactureAddress == "") {
         $("#ManufactureAddress").after('<p class ="text-danger"> Manufacture Address field is required</p>');
         $("#ManufactureAddress").closest('.form-group').addClass('has-error');

      } else {
      	$("#ManufactureAddress").find('.text-danger').remove();
      	$("#ManufactureAddress").closest('.form-group').addClass('has-success');
      }


      if(manufactureStatus == "") {
         $("#ManufactureStatus").after('<p class ="text-danger"> Manufacture Status field is required</p>');
         $("#ManufactureStatus").closest('.form-group').addClass('has-error');

      } else {
      	$("#ManufactureStatus").find('.text-danger').remove();
      	$("#ManufactureStatus").closest('.form-group').addClass('has-success');
      }        


      if(manufactureName && manufactureContact && manufactureAddress && manufactureStatus){
      	 var form = $(this);

        //button loading
        $("#createManufactureBtn").button('loading');

        $.ajax({
                url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createManufactureBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageManufactureTable.ajax.reload(null, false);

						$("#submitManufactureForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-manufacture-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
        });// ajax
      }  

     return false;
  });//submit manufacture form function
}


function editManufacturers(manufactureId = null) {
    if(manufactureId) {
    	//remove manufacture id
    	$("#manufactureId").remove();

    	//refresh the form
    	$("#editManufactureForm")[0].reset();

    	// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

    	$(".editManufactureFooter").after('<input type ="hidden" name ="manufactureId" id ="manufactureId" value="'+manufactureId+'" />')

    	$.ajax({
    		url: 'php_action/fetchSelectedManufacturer.php',
    		type: 'post',
    		data: {manufactureId : manufactureId},
    		dataType: 'json',
    		success: function(response) {
    			  $("#editManufactureName").val(response.manufacture_name);
    			  $("#editManufactureContact").val(response.manufacture_contact);
    			  $("#editManufactureAddress").val(response.manufacture_address);
    			  $("#editManufactureStatus").val(response.manufacture_status);

    			  //submit manufacture form function
				  $("#editManufactureForm").unbind('submit').bind('submit', function() {
				      
				      //remove the error text
				      $(".text-danger").remove();

				      //remove the form error
				      $(".form-group").removeClass("has-error").removeClass("has-success");

				      var manufactureName = $("#editManufactureName").val();
				      var manufactureContact = $("#editManufactureContact").val();
				      var manufactureAddress = $("#editManufactureAddress").val();
				      var manufactureStatus = $("#editManufactureStatus").val();

				      if(manufactureName == "") {
				         $("#editManufactureName").after('<p class ="text-danger"> Manufacture Name field is required</p>');
				         $("#editManufactureName").closest('.form-group').addClass('has-error');

				      } else {
				      	$("#editManufactureName").find('.text-danger').remove();
				      	$("#editManufactureName").closest('.form-group').addClass('has-success');
				      }    


				      if(manufactureContact == "") {
				         $("#editManufactureContact").after('<p class ="text-danger"> Manufacture Contact field is required</p>');
				         $("#editManufactureContact").closest('.form-group').addClass('has-error');

				      } else {
				      	$("#editManufactureContact").find('.text-danger').remove();
				      	$("#editManufactureContact").closest('.form-group').addClass('has-success');
				      }


				      if(manufactureAddress == "") {
				         $("#editManufactureAddress").after('<p class ="text-danger"> Manufacture Address field is required</p>');
				         $("#editManufactureAddress").closest('.form-group').addClass('has-error');

				      } else {
				      	$("#editManufactureAddress").find('.text-danger').remove();
				      	$("#editManufactureAddress").closest('.form-group').addClass('has-success');
				      }


				      if(manufactureStatus == "") {
				         $("#editManufactureStatus").after('<p class ="text-danger"> Manufacture Status field is required</p>');
				         $("#editManufactureStatus").closest('.form-group').addClass('has-error');

				      } else {
				      	$("#editManufactureStatus").find('.text-danger').remove();
				      	$("#editManufactureStatus").closest('.form-group').addClass('has-success');
				      }        


				      if(manufactureName && manufactureContact && manufactureAddress && manufactureStatus){
				      	 var form = $(this);

				        //button loading
				        //$("#createManufactureBtn").button('loading');

				        $.ajax({
				                url : form.attr('action'),
								type: form.attr('method'),
								data: form.serialize(),
								dataType: 'json',
								success:function(response) {
									// button loading
									//$("#createManufactureBtn").button('reset');

									if(response.success == true) {
										// reload the manage member table 
										manageManufactureTable.ajax.reload(null, false);

										//$("#editManufactureForm")[0].reset();
										// remove the error text
										$(".text-danger").remove();
										// remove the form error
										$('.form-group').removeClass('has-error').removeClass('has-success');
				  	  			
				  	  			$('#edit-manufacture-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

				  	  			$(".alert-success").delay(500).show(10, function() {
											$(this).delay(3000).hide(10, function() {
												$(this).remove();
											});
										}); // /.alert
									}  // if

								} // /success
				        });// ajax
				      }  

				     return false;
				  });//submit manufacture form function

    		}// success
    	});// ajax
    }
}



function removeManufacturer(manufactureId = null) {
	if(manufactureId) {
       $("#removeManufactureBtn").unbind('click').bind('click', function() {
         $.ajax({
            url: 'php_action/removeManufacturer.php',
            type: 'post',
            data: {manufactureId : manufactureId},
            dataType: 'json',
            success: function(response) {
              if(response.success == true) {

              	 //hide the modal
                 $("#removeManufactureModal").modal('hide');

                 //reload the manufacturer table
                 manageManufactureTable.ajax.reload(null, false);

                 $('.remove-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
              }//success
            }// success
         });// ajax  
       
       });
	}//if
 }
