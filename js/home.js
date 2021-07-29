const   addBtn                      = document.getElementById("addBtn");
const   addForm                     = document.getElementById("addForm");
const   addFormCancelBtn            = document.getElementById("addFormCancelBtn");
const   editForm                    = document.getElementById("editForm");
const   editFormCancelBtn           = document.getElementById("editFormCancelBtn");
const   todoTable                   = document.getElementById("todoTable");
const   addFormSubmitBtn            = document.getElementById("addFormSubmitBtn");
const   reloadBtn                   = document.getElementById("reloadBtn");
const   editFormSubmitBtn           = document.getElementById("editFormSubmitBtn");
const   functionRow                 = document.getElementById("functionRow");
var     editBtnArr                  = document.querySelectorAll(".editBtn");
var     btnGroupArr                 = document.querySelectorAll(".btnGroup");
var     deleteBtnArr                = document.querySelectorAll(".deleteBtn");
var     deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
var     deleteConfirmBtnArr         = document.querySelectorAll(".deleteConfirmBtn");
var     deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");
const   statuses = new Map([['Todo', 0], ['In progress', 1], ['Done', 2]]);

var editFormId = null;

function $(str) {
    return document.getElementById(str);
};

function getTodoIdFromButton(btn) {
    let tr = btn;
    while (tr.tagName.toLowerCase() != "tr")
        tr = tr.parentElement;
    return tr.id;
}

function addListenersToBtnGroup() {
    editBtnArr.forEach((editBtn) => {
        editBtn.addEventListener("click", () => {
            editForm.style.display = "";
            functionRow.style.display = "none";

            editFormId = getTodoIdFromButton(editBtn);
            $("editFormTitle").value = $(`title${getTodoIdFromButton(editBtn)}`).innerHTML;
            $("editFormDescription").value = $(`desc${getTodoIdFromButton(editBtn)}`).innerHTML;
            $("editFormDeadline").value = $(`deadline${getTodoIdFromButton(editBtn)}`).innerHTML.split('/').reverse().join('-');
            $("editFormStatus").value = statuses.get($(`status${getTodoIdFromButton(editBtn)}`).innerHTML);
    
            btnGroupArr.forEach((btnGroup) => {
                btnGroup.style.display = "none";
            });
        });
    });
    
    deleteBtnArr.forEach((deleteBtn, index) => {
        deleteBtn.addEventListener("click", () => {
            btnGroupArr.forEach((btnGroup) => {
                btnGroup.style.display = "none";
            });
            functionRow.style.display = "none";
            deleteConfirmBtnGroupArr[index].style.display = "";
        });
    });
    
    deleteCancelBtnArr.forEach((deleteCancelBtn, index) => {
        deleteCancelBtn.addEventListener("click", () => {
            btnGroupArr.forEach((btnGroup) => {
                btnGroup.style.display = "";
            });
            functionRow.style.display = "";
            deleteConfirmBtnGroupArr[index].style.display = "none";
        });
    });

    deleteConfirmBtnArr.forEach((deleteConfirmBtn, index) => {
        deleteConfirmBtn.addEventListener("click", () => {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                if (this.responseText == 'Error')
                    document.getElementById("todoTable").innerHTML += '<tr><td colspan="8" class="text-center">Error while deleting Todo</td></tr>';
                else {
                    document.getElementById("todoTable").innerHTML = this.responseText;
                    editBtnArr                  = document.querySelectorAll(".editBtn");
                    btnGroupArr                 = document.querySelectorAll(".btnGroup");
                    deleteBtnArr                = document.querySelectorAll(".deleteBtn");
                    deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
                    deleteConfirmBtnArr         = document.querySelectorAll(".deleteConfirmBtn");
                    deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");
                    btnGroupArr.forEach((btnGroup) => btnGroup.style.display = "");
                    addListenersToBtnGroup();
                    functionRow.style.display = "";
                }
            }
            let url = `api/deleteTodo.php?id=${getTodoIdFromButton(deleteConfirmBtn)}`;
            xhttp.open("GET", url);
            xhttp.send();
        });
    });
};

addListenersToBtnGroup();

addBtn.addEventListener("click", () => {
    functionRow.style.display = "none";
    addForm.style.display = "";

    btnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "none";
    });

    deleteConfirmBtnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "none";
    });
});

reloadBtn.addEventListener("click", () => {
    const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("todoTable").innerHTML = this.responseText;
                editBtnArr                  = document.querySelectorAll(".editBtn");
                btnGroupArr                 = document.querySelectorAll(".btnGroup");
                deleteBtnArr                = document.querySelectorAll(".deleteBtn");
                deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
                deleteConfirmBtnArr         = document.querySelectorAll(".deleteConfirmBtn");
                deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");
                addListenersToBtnGroup();
            }
            let url = `api/listTodo.php`;
            xhttp.open("GET", url);
            xhttp.send();
})

addFormCancelBtn.addEventListener("click", () => {
    addForm.style.display = "none";
    functionRow.style.display = "";

    btnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "";
    });
});

editFormCancelBtn.addEventListener("click", () => {
    editForm.style.display = "none";
    functionRow.style.display = "";

    btnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "";
    });
});

addFormSubmitBtn.addEventListener("click", () => {
    const addForm = {
        title: $("addFormTitle").value,
        description: $("addFormDescription").value,
        deadline: $("addFormDeadline").value
    };
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.responseText == 'Error')
            $("todoTable").innerHTML += '<tr><td colspan="8" class="text-center">Error while adding Todo</td></tr>';
        else {
            $("todoTable").innerHTML = this.responseText;
            editBtnArr                  = document.querySelectorAll(".editBtn");
            btnGroupArr                 = document.querySelectorAll(".btnGroup");
            deleteBtnArr                = document.querySelectorAll(".deleteBtn");
            deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
            deleteConfirmBtnArr         = document.querySelectorAll(".deleteConfirmBtn");
            deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");
            btnGroupArr.forEach((btnGroup) => btnGroup.style.display = "none");
            deleteConfirmBtnGroupArr.forEach((btnGroup) => btnGroup.style.display = "none");
            addListenersToBtnGroup();
        }
    }
    let url = `api/addTodo.php?title=${addForm.title}&description=${addForm.description}&deadline=${addForm.deadline}`;
    xhttp.open("GET", url);
    xhttp.send();
})

editFormSubmitBtn.addEventListener("click", () => {
    const editForm = {
        id: editFormId,
        title: $("editFormTitle").value,
        description: $("editFormDescription").value,
        deadline: $("editFormDeadline").value,
        status: $("editFormStatus").value
    };
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.responseText == 'Error')
            $("todoTable").innerHTML += '<tr><td colspan="8" class="text-center">Error while editing Todo</td></tr>';
        else {
            $("todoTable").innerHTML = this.responseText;
            editBtnArr                  = document.querySelectorAll(".editBtn");
            btnGroupArr                 = document.querySelectorAll(".btnGroup");
            deleteBtnArr                = document.querySelectorAll(".deleteBtn");
            deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
            deleteConfirmBtnArr         = document.querySelectorAll(".deleteConfirmBtn");
            deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");
            btnGroupArr.forEach((btnGroup) => btnGroup.style.display = "none");
            deleteConfirmBtnGroupArr.forEach((btnGroup) => btnGroup.style.display = "none");
            addListenersToBtnGroup();
        }
    }
    let url = `api/editTodo.php?id=${editForm.id}&title=${editForm.title}&description=${editForm.description}&deadline=${editForm.deadline}&status=${editForm.status}`;
    console.log(url);
    xhttp.open("GET", url);
    xhttp.send();
})