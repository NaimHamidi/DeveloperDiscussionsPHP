<?php
	require_once 'connect.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
?>
<?php
	if(isset($_POST['add_discussion'])){
		$title = $_POST['title'];
		$content = $_POST['content'];
		$userid = $user_data['id'];
		$date = date("Y-m-d H:i:s");
		if($_POST['title'] != '' && $_POST['content']){
			$sql = "INSERT INTO discussion (user_id,title,content,created_at,updated_at) VALUES ('$userid','$title','$content','$date','$date')";
			$db->query($sql);
			header('Location: index.php');
		}
	}
?>
<br>
<div class="container">
    <div class="text-center">
        <b><h4>Create a new discussion</h4></b>
    </div>
		<form name="createForm" action="discussion.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="<?= ((isset($_POST['title']))?$_POST['title']:'') ?>" class="form-control">
            </div>            
            <div class="form-group">
                <label for="content">Ask a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?= ((isset($_POST['content']))?$_POST['content']:'') ?></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-success pull-right" name="add_discussion" value="Create Discussion" type="submit">
            </div>
        </form>
</div>

<script>
	function validateForm() {
	  var x = document.forms["createForm"]["title"].value;
	  if (x == "") {
		alert("Title must be filled out");
		return false;
	  }
	  var y = document.forms["createForm"]["content"].value;
	  if (y == "") {
		alert("Content must be filled out");
		return false;
	  }
	}
</script>