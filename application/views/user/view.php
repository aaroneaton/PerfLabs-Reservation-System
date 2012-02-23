<div class="row">
  <div class="span12">
  <h1>User: <?php echo $user_data['last_name']; ?>, <?php echo $user_data['first_name']; ?></h1>
  <?php echo anchor( 'user/edit/' . $user_data['user_id'], 'Edit', array( 'class' => 'btn btn-primary' ) ); ?>
  </div>
</div>
<div class="row">
  <div class="span6">
    <p>
      <b>UIN: </b><?php echo $user_data['uin']; ?>
    </p>
    <p>
      <b>Role: </b><?php echo $user_data['name']; ?>
    </p>
  </div>
  <div class="span6">
<p>
	<b>NetID: </b><?php echo $user_data['net_id']; ?>
</p>
<p>
	<b>Email: </b><?php echo $user_data['email']; ?>
</p>
<p>
	<b>Phone: </b><?php echo $user_data['phone']; ?>
</p>
  </div>
</div>

