<?php
include 'db.php';


// CREATE TASK
if (isset($_POST['add'])) {

    $task = $_POST['task'];

    $sql = "INSERT INTO tasks(task_name) VALUES('$task')";

    mysqli_query($conn, $sql);
}


// DELETE TASK
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $sql = "DELETE FROM tasks WHERE id=$id";

    mysqli_query($conn, $sql);
}


// UPDATE TASK
if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $task = $_POST['task'];

    $sql = "UPDATE tasks SET task_name='$task' WHERE id=$id";

    mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Simple TODO App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h2 class="mb-4">TODO App</h2>

<!-- ADD TASK -->

<form method="POST" class="mb-4">

    <input type="text"
           name="task"
           class="form-control mb-2"
           placeholder="Enter Task"
           required>

    <button type="submit"
            name="add"
            class="btn btn-primary">
        Add Task
    </button>

</form>


<!-- READ TASKS -->

<table class="table table-bordered">

    <tr>
        <th>ID</th>
        <th>Task</th>
        <th>Action</th>
    </tr>

<?php

$sql = "SELECT * FROM tasks";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td>

        <!-- UPDATE FORM -->

        <form method="POST" class="d-flex">

            <input type="hidden"
                   name="id"
                   value="<?php echo $row['id']; ?>">

            <input type="text"
                   name="task"
                   value="<?php echo $row['task_name']; ?>"
                   class="form-control me-2">

            <button type="submit"
                    name="update"
                    class="btn btn-success btn-sm me-2">
                Update
            </button>

        </form>

    </td>

    <td>

        <!-- DELETE -->

        <a href="index.php?delete=<?php echo $row['id']; ?>"
           class="btn btn-danger btn-sm">
           Delete
        </a>

    </td>

</tr>

<?php } ?>

</table>

</body>
</html>
