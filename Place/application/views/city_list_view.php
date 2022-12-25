<!DOCTYPE html>
<html>
<head>
	<title>City List</title>
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url().'assets/css/datatables.css'?>" rel="stylesheet" type="text/css">
	

</head>
<body>
	<div class="container">
	<!--add Madol start here	-->
<div id="show_modal" class="modal fade" role="dialog" style="background: #000;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="font-size: 24px; color: #17919e; text-shadow: 1px 1px #ccc;"><i class="fa fa-folder"></i> Student Details</h3>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
          <thead class="btn-primary">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td> 
              <td></p></td>
              <td></p></td>
            </tr>
          </tbody>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
	<!--add Madol end here	-->
	  <div class="row justify-content-md-center">
	    <div class="col col-lg-8">
	    	<h3>City List</h3>
	    	<?php echo $this->session->flashdata('msg');?>
	    	<a href="<?php echo site_url('city/add_new');?>" class="btn btn-success btn-sm">Add New City</a><hr/>
	      	<table class="table table-striped" id="mytable" style="font-size: 14px;">
	      		<thead>
	      			<tr>
	      				<th>No</th>
	      				<th>City Name</th>
	      				<th>Country</th>
	      				<th>State</th>
	      				<th>Zip Code</th>
	      				<th>Action</th>
	      			</tr>
	      		</thead>
	      		<tbody>
	      			<?php
	      				$no = 0;
	      				foreach ($citys->result() as $row):
	      					$no++;
	      			?>
	      			<tr>
	      				<td><?php echo $no;?></td>
	      				<td><?php echo $row->city_name;?></td>
	      				<td><?php echo $row->country_name;?></td>
	      				<td><?php echo $row->state_name;?></td>
	      				<td><?php echo number_format($row->zip_code);?></td>
	      				<td>
	      					<a href="<?php echo site_url('city/get_edit/'.$row->city_id);?>" class="btn btn-sm btn-info">Edit</a>
	      					<a href="<?php echo site_url('city/delete/'.$row->city_id);?>" class="btn btn-sm btn-danger">Delete</a>
	      				 
						<a  data-bs-toggle="modal" data-bs-target="#show_modal"	class="show_modal" data-id="<?php echo $row->city_id?>" 
														>View</a>
						
						</td>
	      			</tr>
	      			<?php endforeach;?>
	      		</tbody>
	      	</table>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/datatables.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mytable').DataTable();
		});
	</script>
	
	
</body>
</html>