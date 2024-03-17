/*
taskTitle
taskContent
hashtag
deadlineDate

createTaskForm

submit-btn
*/


let form = document.getElementById('createTaskForm');

let submitBtn = document.getElementById('submit-btn');

let markAsFinishedBtn = document.getElementById('mark-as-finished');

let modalActivation_btn = document.getElementById('modal-activation');

$('#create-task-error-feedback').fadeOut(5000, function() {
  console.log("Done");
})


markAsFinishedBtn.addEventListener('click', function() {
  modalActivation_btn.click();
});
