<div class="row">
  <div class="span8">
    <h1>Location</h1>
  </div>
  <div class="span4">
    <?php echo anchor( 'location/edit/' . $location['equipment_location_id'], 'Edit', array( 'class' => 'btn btn-primary' ) ); ?>
  </div>
</div>
<div class="row">
	<div class="span12">
		<p>
      <b>Building: </b><?php echo $location['bldg']; ?>
		</p>
		<p>
      <b>Room: </b><?php echo $location['room']; ?>
		</p>
		<p>
      <b>Area: </b><?php echo $location['area']; ?>
		</p>
	</div>
</div>
