<?php
require_once('includes/initialize.php');
$sql = $_GET['deadline']  != ''
    ? "INSERT INTO `todo` (title, description, deadline, user) VALUES ('".$_GET['title']."', '".$_GET['description']."', '".$_GET['deadline']."', '".$_SESSION['email']."')"
    : "INSERT INTO `todo` (title, description, user) VALUES ('".$_GET['title']."', '".$_GET['description']."', '".$_SESSION['email']."')";
$mydb->setQuery($sql);
if ($mydb->executeQuery()) {
    $todoes = getTodoes();
    ?>
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
    <?php
} else {
    echo "Error";
}