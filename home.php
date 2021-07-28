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
    <?php require_once('navbar.php') ?>
    <?php $todoes = getTodoes(); ?>

    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <table class="table table-striped" id="todoTable">
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

                    <?php if (count($todoes) > 0): ?>
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
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Nothing to show here</td>
                        </tr>
                    <?php endif; ?>
                </table>
                
                <div class="d-flex justify-content-center">
                    <div id="addBtn" class="btn btn-outline-primary" style="width: 30%;">
                        <i class="bi bi-plus-circle"></i> Add
                    </div>
                </div>
            </div>

            <div id="addForm" style="display: none;" class="col-3 row">
                <div class="col-12 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input id="addFormTitle" type="text" class="form-control" placeholder="Title..." required>
                </div>
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input id="addFormDescription" type="text" class="form-control" placeholder="Description..." required>
                </div>
                <div class="col-12 mb-3">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input id="addFormDeadline" type="date" class="form-control" required>
                </div>
                <div class="col-12 mb-3">
                    <button style="width: 100%;" id="addFormSubmitBtn" type="submit" class="btn btn-primary">Add</button>
                </div>
                <div class="col-12">
                    <div id="addFormCancelBtn" style="width: 100%;" class="btn btn-outline-secondary">Cancel</div>
                </div>
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
<script type="text/javascript" src="js/home.js"></script>

</html>