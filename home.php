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
    <?php require_once('api/navbar.php') ?>

    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <table class="table table-striped" id="todoTable">
                    <?php require_once('api/listTodo.php'); ?>
                </table>
                
                <div class="row justify-content-center" id="functionRow">
                    <div class="d-flex justify-content-center col-3">
                        <div id="addBtn" class="btn btn-outline-primary col-12">
                            <i class="bi bi-plus-circle"></i> Add
                        </div>
                    </div>
                    <div class="d-flex justify-content-center col-3">
                        <div id="reloadBtn" class="btn btn-outline-warning col-12">
                            <i class="bi bi-arrow-clockwise"></i> Reload
                        </div>
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
                <div class="col-12 mb-3">
                    <label for="editFormTitle" class="form-label">Title</label>
                    <input id="editFormTitle" type="text" class="form-control" placeholder="Title...">
                </div>
                <div class="col-12 mb-3">
                    <label for="editFormDescription" class="form-label">Description</label>
                    <input id="editFormDescription" type="text" class="form-control" placeholder="Description...">
                </div>
                <div class="col-12 mb-3">
                    <label for="editFormDeadline" class="form-label">Deadline</label>
                    <input id="editFormDeadline" type="date" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <select class="form-select" id="editFormStatus">
                        <option value="0">Todo</option>
                        <option value="1">In progress</option>
                        <option value="2">Done</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <button id="editFormSubmitBtn" style="width: 100%;" type="submit" class="btn btn-warning">Save changes</button>
                </div>

                <div class="col-12">
                    <div id="editFormCancelBtn" style="width: 100%;" class="btn btn-outline-secondary">Cancel</div>
                </div>
            </div>

        </div>


    </div>
</body>
<script type="text/javascript" src="js/home.js"></script>

</html>