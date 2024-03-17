let markAsFinished_btn = document.getElementById('mark-as-finished');

let finishTask_url = document.getElementById('finish-task-url');

let taskTitle_container = document.getElementById('task-title-container');


markAsFinished_btn.addEventListener('click', function(event) {
  taskTitle_container.textContent = event.target.parentNode.parentNode.firstElementChild.textContent;
  finishTask_url.href = '/task/finish/' + event.target.parentNode.firstElementChild.textContent.trim();
});
