<!DOCTYPE html>
<html>
<head>
	<title>Edit City</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">

	  <div class="row justify-content-md-center">
	    <div class="col col-lg-6">
	    	<h3>Edit City:</h3>
	    	
	      	<form action="<?php echo site_url('city/update_city');?>" method="post">

	      		<div class="form-group">
				    <label>City Name</label>
				    <input type="text" class="form-control" name="city_name" placeholder="City Name" required>
				</div>

				<div class="form-group">
				    <label>Country</label>
				    <select class="form-control country" name="country" required>
				    	<option value="">No Selected</option>
				    	<?php foreach($country as $row):?>
				    	<option value="<?php echo $row->country_id;?>"><?php echo $row->country_name;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>

				<div class="form-group">
				    <label>State</label>
				    <select class="form-control state" name="state" required>
				    	<option value="">No Selected</option>

				    </select>
				</div>

				<div class="form-group">
				    <label>City Zip Code</label>
				    <input type="number" class="form-control" name="zip_code" placeholder="City Zip Code" required>
				</div>

				<input type="hidden" name="city_id" value="<?php echo $city_id?>" required>
				<button class="btn btn-success" type="submit">Update City</button>

			</form>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//call function get data edit
			get_data_edit();

			$('.country').change(function(){ 
                var id=$(this).val();
                var state_id = "<?php echo $sub_country_id;?>";
                $.ajax({
                    url : "<?php echo site_url('city/get_sub_country');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){

                        $('select[name="state"]').empty();

                        $.each(data, function(key, value) {
                            if(state_id==value.state_id){
                                $('select[name="state"]').append('<option value="'+ value.state_id +'" selected>'+ value.state_name +'</option>').trigger('change');
                            }else{
                                $('select[name="state"]').append('<option value="'+ value.state_id +'">'+ value.state_name +'</option>');
                            }
                        });

                    }
                });
                return false;
            }); 

			//load data for edit
            function get_data_edit(){
            	var city_id = $('[name="city_id"]').val();
            	$.ajax({
            		url : "<?php echo site_url('city/get_data_edit');?>",
                    method : "POST",
                    data :{city_id :city_id},
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('[name="city_name"]').val(data[i].city_name);
                            $('[name="country"]').val(data[i].country_id).trigger('change');
                            $('[name="state"]').val(data[i].state_id).trigger('change');
                            $('[name="zip_code"]').val(data[i].zip_code);
                        });
                    }

            	});
            }
            
		});
	</script>
</body>
</html>