<?php

$ser="localhost";
$user="root";
$pass="Leomenon06";
$db="todo_app";

$conn=mysqli_connect($ser, $user, $pass, $db);

$error_message="";

//add task function
if(isset($_POST['submit']))
{
	$task=$_POST['task'];
	
	//if(empty($task))
	//{
		//$error_message="Cannot input an empty task into the TODO list";
	//}	
	//else
	//{	
	mysqli_query($conn, "INSERT INTO task_list (task) VALUES ('$task')");
	header('location: index.php');
	//}
}


//delete tasks function
if(isset($_GET['delete_task']))
{
	$num = $_GET['delete_task'];
	mysqli_query($conn, "DELETE FROM task_list WHERE num=$num");
	header('location: index.php');	
}

//view tasks function
$task_list=mysqli_query($conn, "SELECT * FROM task_list");

?>

<!DOCTYPE html>
<html>

	<link href="color_sheet.css" rel="stylesheet">

	<head>
		<title>TODO Application</title>
		
	</head>

<body>
	
	<h1>

		<?php echo "TODO Application";?> 
	
	</h1>
	
	
	<table>
		<tbody>
		
		<?php 
		$count = 1; 
		while($row=mysqli_fetch_array($task_list))
		{
		?>
			<tr>
				<td class="task"><?php echo $row['task']; ?> </td>
				<td class="delete">
				<a href= "index.php?delete_task=<?php echo $row['num']; ?>">Delete Task</a>
				</td>
			</tr>
			
		<?php $count++;
		} 
		?>
		
					
		</tbody>	
	</table>
	
	
	<form method="POST" action="index.php">
	<?php
	if(isset($error_message))
	{
	?>
	
	<p><?php echo $error_message; ?></p>
	
	<?php 
	}
	?>
	
	<input type="text" name="task" class="task_input">
	<button type="submit" class="add_task" name="submit">Add Task</button>
	</form>

	

</body>

</html>













