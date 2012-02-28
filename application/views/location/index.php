<div class="row">
	<div class="span8">
		<h1>Storage Location Table</h1>
	</div>
  <div class="span4">
    <?php echo anchor( 'location/create', 'Add New Location', array( 'class' => 'btn btn-primary', 'id' => 'new-location-btn' ) ); ?>
  </div>
</div>
<?php if ( $this->session->flashdata( 'success-message' ) != '' ) : ?>
<div class="row">
  <div class="span4">
    <div class="alert alert-success">
      <a class="close" data-dismiss="alert">x</a>
      <?php echo $this->session->flashdata( 'success-message' ); ?>
    </div>
  </div>
</div>
<?php endif; ?>
<div class="row">
	<div class="span12">
		<table id="location-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Building</th>
					<th>Room</th>
					<th>Area</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
      <?php foreach( $locations as $l ) : ?>
				<tr>
          <td><?php echo $l['bldg']; ?></td>
          <td><?php echo $l['room']; ?></td>
          <td><?php echo $l['area']; ?></td>
          <td>
            <?php echo anchor( 'location/view/' . $l['equipment_location_id'], 'View', array( 'class' => 'btn btn-primary' ) ); ?>
            <?php echo anchor( 'location/remove/' . $l['equipment_location_id'], 'Remove', array( 'class' => 'btn btn-danger' ) ); ?>
          </td>
				</tr>
      <?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
