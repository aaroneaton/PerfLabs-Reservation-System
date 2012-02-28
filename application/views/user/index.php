<div class="row">
  <div class="span8">
    <h1>Users Table</h1>
  </div>
  <div class="span4">
    <?php echo anchor( 'user/create', 'Add New User', array( 'class' => 'btn btn-primary', 'id' => 'new-user-btn') ); ?>
  </div>
</div>
<?php if ( $this->session->flashdata( 'success_message' ) != '' ) : ?>
<div class="row">
  <div class="span4">
  <div class="alert alert-success"><a class="close" data-dismiss="alert">x</a><?php echo $this->session->flashdata( 'success_message' ); ?></div>
  </div>
</div>
<?php endif; ?>
<div class="row">
  <div class="span12">
    <table id="user-table" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>NetID</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach( $users as $user ) : ?>

        <tr>
          <td><?php echo $user['last_name']; ?></td>
          <td><?php echo $user['first_name']; ?></td>
          <td><?php echo $user['net_id']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td>

            <?php echo anchor( 'user/view/' . $user['user_id'], 'View', array( 'class' => 'btn btn-primary' ) ); ?>

            <?php echo anchor( 'user/remove/' . $user['user_id'], 'Remove', array( 'class' => 'btn btn-danger' ) ); ?>
          
          </td>
        </tr>

        <?php endforeach; ?>

      </tbody>
    </table>
  </div><!-- .span12 -->
</div><!-- .row -->
