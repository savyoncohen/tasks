$(document).ready(function () {

  var taskCounter, completedCounter, remainedCounter;

  // Get tasks from database for the first time
  $.get('server/tasks.php?data=data', function (data) {
    try {
      var tasks = JSON.parse(data);
      taskCounter = tasks.length;
      completedCounter = 0;

      $.each(tasks, function () {
        $('#task-table').append(
          '<tr id="task' + this.id + '"><td>'
          + this.id
          + '</td><td class="title">'
          + this.title
          + '</td><td>'
          + this.created
          + '</td><td>' +
          '<button type="button" tabindex="-1" role="dialog" class="action-button action-button--edit" data-toggle="modal" data-title="' + this.title + '" data-id="' + this.id + '" data-status="' + this.status + '" data-target="#edit-task-modal">Edit</button>' +
          '/' +
          '<button type="button" tabindex="-1" role="dialog" class="action-button action-button--delete" data-toggle="modal" data-title="' + this.title + '"  data-id="' + this.id + '" data-status="' + this.status + '" data-target="#delete-task-modal">Delete</button>' +
          '</td></tr>'
        );
        // Count by status
        if (this.status == 'Completed') {
          completedCounter++;
        }
      });

      remainedCounter = taskCounter - completedCounter;

      // Render the counters.
      $('#total-counter').text(taskCounter);
      $('#completed-counter').text(completedCounter);
      $('#remained-counter').text(remainedCounter);
    }
    catch (e) {
      console.log(data);
    }
  });

  // Add task
  $('#add-task-button').on('click', function () {

    var title = $('#new-task').val();

    if (title) {
      var status = $('#new-task-status').val();
      var postData = {"title": title, "status": status};
      var dataString = JSON.stringify(postData);

      $.ajax({
        url: "server/tasks.php",
        type: "post",
        data: {addData: dataString},
        success: function (response) {
          try {
            var newTask = JSON.parse(response);
            var id = newTask.id;
            var create = newTask.date;
            var status = newTask.status;
            // Render the counter and new task row.
            taskCounter++;
            $('#task-table').append(
              '<tr id="task' + id + '"><td>'
              + id
              + '</td><td  class="title">'
              + title
              + '</td><td>'
              + create
              + '</td><td>' +
              '<button type="button" tabindex="-1" role="dialog" class="action-button action-button--edit" data-toggle="modal" data-title="' + title + '" data-id="' + id + '" data-status="' + status + '" data-target="#edit-task-modal">Edit</button>' +
              '/' +
              '<button type="button" tabindex="-1" role="dialog" class="action-button action-button--delete" data-toggle="modal" data-title="' + title + '" data-id="' + id + '" data-status="' + status + '" data-target="#delete-task-modal">Delete</button>' +
              '</td></tr>'
            );

            $('#new-task').val('');

            // Render completed and remained counters.
            $('#total-counter').text(taskCounter);
            if (status == 'Completed') {
              completedCounter++;
              $('#completed-counter').text(completedCounter);
            }
            else {
              remainedCounter++;
              $('#remained-counter').text(remainedCounter);
            }
          }
          catch (e) {
            $('.error-div').html(response);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });

    }
    else {
      $('.error-div').text('The task title is empty, please insert a valid title');
    }
  });

  // Delete task
  var taskRemoveId, taskRemoveStatus;

  $("body").on('click', '.action-button--delete', function () {
    // Get the removed task data.
    taskRemoveId = $(this).data('id');
    taskRemoveStatus = $(this).data('status');
    $('#delete-task-modal .modal-title').text('Delete task no.' + taskRemoveId);
    $('#delete-task-modal .task-title-modal').text($(this).data('title'));
  });

  $('#delete-task-button').on('click', function () {
    var postData = {"id": taskRemoveId};
    var dataString = JSON.stringify(postData);
    $.ajax({
      url: "server/tasks.php",
      type: "post",
      data: {deleteData: dataString},
      success: function (response) {
        if (response == 'success') {
          // Remove task from the html and update counters.
          $('#task' + taskRemoveId).remove();
          taskCounter--;
          $('#total-counter').text(taskCounter);
          if (taskRemoveStatus == 'Completed') {
            completedCounter--;
            $('#completed-counter').text(completedCounter);
          }
          else {
            remainedCounter--;
            $('#remained-counter').text(remainedCounter);
          }
        }
        else {
          $('.error-div').text('error occurred while trying to delete the task');
        }

      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  });

  // Edit task
  var taskEditId, taskEditTitle, taskEditStatus;
  $("body").on('click', '.action-button--edit', function () {
    // Get task old data.
    taskEditId = $(this).data('id');
    taskEditTitle = $(this).data('title');
    taskEditStatus = $(this).data('status');
    $('#edit-task').val(taskEditTitle);
    $('#edit-task-modal .modal-title').html('Edit task no.' + taskEditId);
    $('#edit-task-status').val(taskEditStatus);
  });

  $("body").on('click', '#edit-task-button', function () {
    // Get task new data.
    var taskChangedTitle = $('#edit-task').val();
    var taskChangedStatus = $('#edit-task-status').val();
    var postData = {"id": taskEditId, "title": taskChangedTitle, "status": taskChangedStatus };
    var dataString = JSON.stringify(postData);
    $.ajax({
      url: "server/tasks.php",
      type: "post",
      data: { editData: dataString },
      success: function (response) {
        if (response == 'success') {
          $('#task' + taskEditId + ' .title').html(taskChangedTitle);
          $('#task' + taskEditId + ' .action-button--edit').data('title', taskChangedTitle);
          if (taskEditStatus != taskChangedStatus) {
            $('#task' + taskEditId + ' .action-button--edit').data('status', taskChangedStatus);
            // If status has changed, update the rendered counters.
            if (taskChangedStatus == 'Completed') {
              completedCounter++;
              remainedCounter--;
            }
            else {
              completedCounter--;
              remainedCounter++;
            }
            $('#completed-counter').text(completedCounter);
            $('#remained-counter').text(remainedCounter);
          }
        }
        else {
          $('.error-div').html(response);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  });

  $('.task-button').on('click', function () {
    $('.error-div').text('');
  });

  $("body").on('click', '.action-button', function () {
    $('.error-div').text('');
  });

});

