const   addBtn                      = document.getElementById("addBtn");
const   addForm                     = document.getElementById("addForm");
const   addFormCancelBtn            = document.getElementById("addFormCancelBtn");
const   editForm                    = document.getElementById("editForm");
const   editFormCancelBtn           = document.getElementById("editFormCancelBtn");
const   todoTable                   = document.getElementById("todoTable");
const   addFormSubmitBtn            = document.getElementById("addFormSubmitBtn");
var     editBtnArr                  = document.querySelectorAll(".editBtn");
var     btnGroupArr                 = document.querySelectorAll(".btnGroup");
var     deleteBtnArr                = document.querySelectorAll(".deleteBtn");
var     deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
var     deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");

function addListenersToBtnGroup() {
    editBtnArr.forEach((editBtn) => {
        editBtn.addEventListener("click", () => {
            editForm.style.display = "";
            addBtn.style.display = "none";
    
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
            addBtn.style.display = "none";
            deleteConfirmBtnGroupArr[index].style.display = "";
        });
    });
    
    deleteCancelBtnArr.forEach((deleteCancelBtn, index) => {
        deleteCancelBtn.addEventListener("click", () => {
            btnGroupArr.forEach((btnGroup) => {
                btnGroup.style.display = "";
            });
            addBtn.style.display = "";
            deleteConfirmBtnGroupArr[index].style.display = "none";
        });
    });
};

addListenersToBtnGroup();

addBtn.addEventListener("click", () => {
    addBtn.style.display = "none";
    addForm.style.display = "";

    btnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "none";
    });

    deleteConfirmBtnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "none";
    });
});

addFormCancelBtn.addEventListener("click", () => {
    addForm.style.display = "none";
    addBtn.style.display = "";

    btnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "";
    });
});

editFormCancelBtn.addEventListener("click", () => {
    editForm.style.display = "none";
    addBtn.style.display = "";

    btnGroupArr.forEach((btnGroup) => {
        btnGroup.style.display = "";
    });
});

addFormSubmitBtn.addEventListener("click", () => {
    const addForm = {
        title: document.getElementById("addFormTitle"),
        description: document.getElementById("addFormDescription"),
        deadline: document.getElementById("addFormDeadline")
    };
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.responseText == 'Error')
            document.getElementById("todoTable").innerHTML += '<tr><td colspan="8" class="text-center">Error while adding Todo</td></tr>';
        else {
            document.getElementById("todoTable").innerHTML = this.responseText;
            editBtnArr                  = document.querySelectorAll(".editBtn");
            btnGroupArr                 = document.querySelectorAll(".btnGroup");
            deleteBtnArr                = document.querySelectorAll(".deleteBtn");
            deleteConfirmBtnGroupArr    = document.querySelectorAll(".deleteConfirmBtnGroup");
            deleteCancelBtnArr          = document.querySelectorAll(".deleteCancelBtn");
            btnGroupArr.forEach((btnGroup) => btnGroup.style.display = "none");
            deleteConfirmBtnGroupArr.forEach((btnGroup) => btnGroup.style.display = "none");
            addListenersToBtnGroup();
        }
    }
    let url = `addTodo.php?title=${addForm.title.value}&description=${addForm.description.value}&deadline=${addForm.deadline.value}`;
    console.log(url);
    xhttp.open("GET", url);
    xhttp.send();
})