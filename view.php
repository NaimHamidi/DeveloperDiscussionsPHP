<?php
	require_once 'connect.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
?>

<?php
	$id = (int)$_GET['view'];
	$query = "SELECT * FROM discussion WHERE id = '$id'";
	$result = $db->query($query);
	$row = mysqli_fetch_row($result);
	
	$userid = $row[1];
	
	
	$query1 = "SELECT * FROM users WHERE id = $userid";
	$result1 = $db->query($query1);
	$row1 = mysqli_fetch_row($result1);
	
	// LEAVE A REPLY 
	
	if(isset($_POST['addReply'])){
		$content = $_POST['content'];
		$userID = $user_data['id'];
		if($_POST['content'] != "" ){
			$sql = "INSERT INTO replies (user_id, discussion_id, content) VALUES ('$userID', '$id', '$content')";
			$db->query($sql);
			header('Location: index.php');
		}
	}
?>

<div class="container">
    <br>
    <div class="card">
        <div class="card-header">
            Created by : <b><?= $row1[1] ?></b>
        </div>
        <div class="card-body text-center">
            <h5><?= $row[2] ?></h5>
            <br>
            <p class="card-text"><?= $row[3] ?></p>
            <hr><br>
            <div class="container">
                
                        <form action="view.php" method="post" name="replyForm" onsubmit="return validateForm()">
							<input type="hidden" name="disscusionID" value="<?= $row[0] ?>" >
                            <div class="form-group">
                                <label for="content"><b>Leave a reply...</b></label>
                                <textarea name="content" id="content" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-sm btn-primary pull-right" name="addReply" value="Leave Reply" type="submit">
                            </div>
                        </form>
                    <br>
            </div>
            <div class="container">
				<?php
					$sql2 = "SELECT * FROM replies WHERE discussion_id = $row[0]";
					$result2 = $db->query($sql2);
				?>
				<?php while($replies = mysqli_fetch_assoc($result2)) : ?>
					<?php 
						$userreplyid = $replies['user_id'];
						$sql3 = "SELECT * FROM users WHERE id = $userreplyid";
						$result3 = $db->query($sql3);
						$row3 = mysqli_fetch_row($result3);
					?>
					<div class="card">
                        <div class="card-body text-left">
                            Replied by : <b><?= $row3[1] ?></b>
                            <hr>
                            <p class="text-cente"><?= $replies['content'] ?></p>
                        </div>
                    </div><br>
					
				<?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script>
	function validateForm() {
	  var x = document.forms["replyForm"]["content"].value;
	  if (x == "") {
		alert("Content must be filled out");
		return false;
	  }
	}
</script>