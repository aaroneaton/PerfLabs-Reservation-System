<div class="row">
	<div class="span8">
		<h1>Room Table</h1>
	</div>
  <div class="span4">
    <?php echo anchor( 'room/create', 'Add New Room', array( 'class' => 'btn btn-primary', 'id' => 'new-room-btn' ) ); ?>
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
		<table id="room-table" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Building</th>
					<th>Room</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
      <?php foreach( $rooms as $r ) : ?>
				<tr>
          <td><?php echo $r['bldg']; ?></td>
          <td><?php echo $r['number']; ?></td>
          <td>
            <?php echo anchor( 'room/view/' . $r['room_id'], 'View', array( 'class' => 'btn btn-primary' ) ); ?>
            <?php echo anchor( 'room/remove/' . $r['room_id'], 'Remove', array( 'class' => 'btn btn-danger' ) ); ?>
          </td>
				</tr>
      <?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
