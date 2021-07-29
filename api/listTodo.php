<?php
require_once(__DIR__.'/../includes/initialize.php');
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
        <tr id=<?= $todo->id ?>>
            <td><?= $i ?></td>
            <td id= <?= "title".$todo->id ?>><?= $todo->title ?></td>
            <td id= <?= "desc".$todo->id ?>><?= $todo->description ?></td>
            <td><?= sqltodate($todo->created_at) ?></td>
            <td><?= sqltodate($todo->updated_at) ?></td>
            <td id= <?= "deadline".$todo->id ?>><?= sqltodate($todo->deadline) ?></td>
            <td id= <?= "status".$todo->id ?> class=<?= $statusclass[$todo->status] ?>><?= $statuses[$todo->status] ?></td>
            <td>
                <div class="btnGroup btn-group">
                    <div id= <?= "editBtn".$todo->id ?> class="editBtn btn btn-outline-warning"><i class="bi bi-pencil-square"></i> Edit</div>
                    <div id= <?= "deleteBtn".$todo->id ?> class="deleteBtn btn btn-outline-danger"><i class="bi bi-trash"></i> Delete</div>
                </div>

                <div style="display: none;" class="deleteConfirmBtnGroup btn-group">
                    <div id= <?= "deleteConfirmBtn".$todo->id ?> class="deleteConfirmBtn btn btn-outline-danger"><i class="bi bi-archive"></i> Delete permanently</div>
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