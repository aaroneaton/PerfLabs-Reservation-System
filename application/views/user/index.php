<div class="row">
  <div class="span12">
    <h1 class="page-heading">Users Table</h1>
    <hr />
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
