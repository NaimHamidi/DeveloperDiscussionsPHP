<?php
	require_once 'connect.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	if(!is_logged_in()){
		login_error_redirect();
	}
?>
<?php
	$id = (int)$_GET['edit'];
	$query = "SELECT * FROM discussion WHERE id = '$id'";
	$result = $db->query($query);
	$row = mysqli_fetch_row($result);
	
	if(isset($_POST['update_discussion'])){
		$title = $_POST['title'];
		$content = $_POST['content'];
		$userid = 1;
		$date = date("Y/m/d");
		if($_POST['title'] != '' && $_POST['content']){
			$sqlupdate = "UPDATE discussion SET title = '$title', content = '$content', updated_at = '$date' WHERE id = '$id' ";
			$db->query($sqlupdate);
			header('Location: index.php');
		}
	}
?>
<br>
<div class="container">
    <div class="text-center">
        <b><h4>Create a new discussion</h4></b>
    </div>
		<form name="createForm" action="edit.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="<?= $row[2] ?>" class="form-control">
            </div>            
            <div class="form-group">
                <label for="content">Ask a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"><?= $row[3] ?></textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-success pull-right" name="update_discussion" value="Update Discussion" type="submit">
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