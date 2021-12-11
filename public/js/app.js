// All tasks
tasks_status = document.querySelectorAll('.task_status');
tasks_status.forEach(task_status => {
    task_status.addEventListener('change', e => {
        form = e['path'][1];
        let urlink = form.getAttribute('action');
        let _token = form.querySelector('input[name=_token]').getAttribute('value');
        text = form.querySelector('.task_text').innerText;

        //post request
        $.ajax({
            url: urlink,
            type: "POST",
            data: {
                _token: _token
            },
            success: function(response) {
                if (response == 1) {
                    form.querySelector('.task_text').innerHTML = '<s>' + text + '</s>';
                } else {
                    form.querySelector('.task_text').innerText = text;
                }
            },
            error: function(response) {
                console.log('error');
            }
        });
    });
});


// delete task
delete_tasks = document.querySelectorAll('.delete_task');
delete_tasks.forEach(delete_task => {
    delete_task.addEventListener('click', e => {
        e.preventDefault();
        form = e['path'][1];
        let urlink = form.getAttribute('action');
        let _token = form.querySelector('input[name=_token]').getAttribute('value');
        //post request
        $.ajax({
            url: urlink,
            type: "DELETE",
            data: {
                _token: _token
            },
            success: function(response) {
                e['path'][3].remove();
                if (response == 0) {
                    document.querySelector("#delete_all").remove();
                }
            },
            error: function(response) {
                console.log('error');
            }
        });
    })

});


// dalete all