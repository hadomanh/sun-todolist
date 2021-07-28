<?php
require_once('includes/initialize.php');
$sql = "SELECT * FROM `todo` WHERE `user` = '".$_SESSION['email']."'";
$mydb->setQuery($sql);
$todoes = $mydb->loadResultList();
$stati = [0 => 'Todo', 1 => 'In progress', 2 => 'Done'];
$statusclass = [0 => 'text-danger', 1 => 'text-info', 2 => 'text-success'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://static.appvn.com/a/uploads/thumbnails/042021/tasksd-todo-listd-task-listd-reminder_icon.png"
                    alt="" width="30" height="30" class="d-inline-block align-text-top">
                Todo list
            </a>

            <div class="collapse navbar-collapse d-flex justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">
                            Good morning, <?= $_SESSION['fullname'] ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th></th>
                    </tr>

                    <?php $i = 0; ?>
                    <?php foreach ($todoes as $todo): ?>
                        <?php $i++; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $todo->title ?></td>
                            <td><?= $todo->description ?></td>
                            <td><?= sqltodate($todo->created_at) ?></td>
                            <td><?= sqltodate($todo->updated_at) ?></td>
                            <td><?= sqltodate($todo->deadline) ?></td>
                            <td class=<?= $statusclass[$todo->status] ?>><?= $stati[$todo->status] ?></td>
                            <td>
                                <div class="btnGroup btn-group">
                                    <div id= <?= "editBtn".$todo->id ?> class="editBtn btn btn-outline-warning"><i class="bi bi-pencil-square"></i> Edit</div>
                                    <div id= <?= "deleteBtn".$todo->id ?> class="deleteBtn btn btn-outline-danger"><i class="bi bi-archive"></i> Delete</div>
                                </div>

                                <div style="display: none;" class="deleteConfirmBtnGroup btn-group">
                                    <div id= <?= "permaDeleteBtn".$todo->id ?> class="btn btn-outline-danger"><i class="bi bi-archive"></i> Delete permanently</div>
                                    <div class="deleteCancelBtn btn btn-outline-secondary">Cancel</div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                
                <div class="d-flex justify-content-center">
                    <div id="addBtn" class="btn btn-outline-primary" style="width: 30%;">
                        <i class="bi bi-plus-circle"></i> Add
                    </div>
                </div>
            </div>

            <div id="addForm" style="display: none;" class="col-3">
                <form class="row" autocomplete="off">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" type="text" class="form-control" placeholder="Title...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input id="description" type="text" class="form-control" placeholder="Description...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input id="deadline" type="date" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <button style="width: 100%;" type="submit" class="btn btn-primary">Add</button>
                    </div>
                    <div class="col-12">
                        <div id="addFormCancelBtn" style="width: 100%;" class="btn btn-outline-secondary">Cancel</div>
                    </div>
                </form>
            </div>

            <div id="editForm" style="display: none;" class="col-3">
                <form class="row" autocomplete="off">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input id="title" type="text" class="form-control" placeholder="Title...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input id="description" type="text" class="form-control" placeholder="Description...">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input id="deadline" type="date" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <select class="form-select">
                            <option value="1">Todo</option>
                            <option value="2" selected>On progress</option>
                            <option value="3">Done</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <button style="width: 100%;" type="submit" class="btn btn-warning">Save changes</button>
                    </div>

                    <div class="col-12">
                        <div id="editFormCancelBtn" style="width: 100%;" class="btn btn-outline-secondary">Cancel</div>
                    </div>
                </form>
            </div>

        </div>


    </div>
</body>
<script>
    const addBtn = document.getElementById('addBtn')
    const addForm = document.getElementById('addForm')
    const addFormCancelBtn = document.getElementById('addFormCancelBtn')
    const editBtnArr = document.querySelectorAll('.editBtn')
    const editForm = document.getElementById('editForm')
    const btnGroupArr = document.querySelectorAll('.btnGroup')
    const editFormCancelBtn = document.getElementById('editFormCancelBtn')
    const deleteBtnArr = document.querySelectorAll('.deleteBtn')
    const deleteConfirmBtnGroupArr = document.querySelectorAll('.deleteConfirmBtnGroup')
    const deleteCancelBtnArr = document.querySelectorAll('.deleteCancelBtn')

    addBtn.addEventListener('click', () => {
        addBtn.style.display = 'none'
        addForm.style.display = ''

        btnGroupArr.forEach(btnGroup => {
            btnGroup.style.display = 'none'
        })

        deleteConfirmBtnGroupArr.forEach(btnGroup => {
            btnGroup.style.display = 'none'
        })
    })

    addFormCancelBtn.addEventListener('click', () => {
        addForm.style.display = 'none'
        addBtn.style.display = ''

        btnGroupArr.forEach(btnGroup => {
            btnGroup.style.display = ''
        })
    })

    editBtnArr.forEach(editBtn => {
        editBtn.addEventListener('click', () => {
            editForm.style.display = ''
            addBtn.style.display = 'none'

            btnGroupArr.forEach(btnGroup => {
                btnGroup.style.display = 'none'
            })

        })
    })

    editFormCancelBtn.addEventListener('click', () => {
        editForm.style.display = 'none'
        addBtn.style.display = ''

        btnGroupArr.forEach(btnGroup => {
            btnGroup.style.display = ''
        })
    })

    deleteBtnArr.forEach((deleteBtn, index) => {
        deleteBtn.addEventListener('click', () => {
            btnGroupArr.forEach(btnGroup => {
                btnGroup.style.display = 'none'
            })
            addBtn.style.display = 'none'
            deleteConfirmBtnGroupArr[index].style.display = ''
        })
    })

    deleteCancelBtnArr.forEach((deleteCancelBtn, index) => {
        deleteCancelBtn.addEventListener('click', () => {
            btnGroupArr.forEach(btnGroup => {
                btnGroup.style.display = ''
            })
            addBtn.style.display = ''
            deleteConfirmBtnGroupArr[index].style.display = 'none'
        })
    })

</script>

</html>