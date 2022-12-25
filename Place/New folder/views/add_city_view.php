<!DOCTYPE html>
<html>
<head>
	<title>Add New</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">

	  <div class="row justify-content-md-center">
	    <div class="col col-lg-6">
	    	<h3>Add New City:</h3>
	    	
	      	<form action="<?php echo site_url('city/save_city');?>" method="post">

	      		<div class="form-group">
				    <label>City Name</label>
				    <input type="text" class="form-control" name="city_name" placeholder="City Name" required>
				</div>

				<div class="form-group">
				    <label>Country</label>
				    <select class="form-control" name="country" id="country" required>
				    	<option value="">No Selected</option>
				    	<?php foreach($country as $row):?>
				    	<option value="<?php echo $row->country_id;?>"><?php echo $row->country_name;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>

				<div class="form-group">
				    <label>State</label>
				    <select class="form-control" id="state" name="state" required>
				    	<option value="">No Selected</option>

				    </select>
				</div>

				<div class="form-group">
				    <label>City Zip Code</label>
				    <input type="number" class="form-control" name="zip_code" placeholder="City Zip Code" required>
				</div>

				<button class="btn btn-success" type="submit">Save City</button>

			</form>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#country').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('city/get_sub_country');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].state_id+'>'+data[i].state_name+'</option>';
                        }
                        $('#state').html(html);

                    }
                });
                return false;
            }); 
            
		});
	</script>
</body>
</html>