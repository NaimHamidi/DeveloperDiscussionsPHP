<?php
	require_once 'connect.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
?>



    <body>
        
		<?php			
			$sql = "SELECT * FROM discussion ORDER BY created_at DESC";
			$result = $db->query($sql);
		?>
		
		
		<?php
			if(isset($_GET['delete'])){
				$delete_id = (int)$_GET['delete'];
				$sql = "DELETE FROM discussion WHERE id = '$delete_id'";
				$db->query($sql);
				header('Location: index.php');
			}
		?>
	<div class="container">
		<br>
		<div class="text-right">
			<a href="discussion.php" class="btn btn-primary">Create Discussion</a>
		</div>
		<br>

		<?php while($discussion = mysqli_fetch_assoc($result)) : ?>
			<div class="card">
			<?php
				$userid = $discussion['user_id'];
				$sql = "SELECT * FROM users WHERE id = '$userid'";
				$userquery = $db->query($sql);
				$user = mysqli_fetch_assoc($userquery);
			?>
				<div class="card-header">
					Created by : <b><?= $user['name'] ?></b>
					<?php
						
						if($discussion['user_id'] == $user_data['id']){
					?>
							
								<p class="d-inline-block float-right">
									<a href="edit.php?edit=<?= $discussion['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
									<a href="index.php?delete=<?= $discussion['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
								</p>
							
					<?php 
						}
					?>
				</div>
				<div class="card-body text-center">
					<h5><?= $discussion['title'] ?></h5>
					<br>
					<p class="card-text"><?= $discussion['content'] ?></p>
					<a href="view.php?view=<?= $discussion['id'] ?>" class="btn btn-sm btn-primary">View</a>
				</div>
				<div class="card-footer text-muted">
					<?php
						if($discussion['created_at'] == $discussion['updated_at']){
							echo "Created : " .$discussion['created_at'];
						}else{
							echo "Updated : " .$discussion['updated_at'];
						}
					?>
					<?php
						$disid = $discussion['id'];
						$sql1 = $db->query("SELECT * FROM replies WHERE discussion_id = $disid");
						$repliesCount = mysqli_num_rows($sql1);
						
					?>
					<p class="d-inline-block float-right"><a href="view.php?view=<?= $discussion['id'] ?>"><?= $repliesCount ?> Replies</a></p>
				</div>
			</div>
			<br>        
		<?php endwhile; ?>
	</div>
		
    </body>
</html>