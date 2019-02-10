$(document).ready( function (  ){
    $('#EnterButton').click( function (  ){

        let login = $('#AdminLoginInput').val();

        let password = $('#AdminPasswordInput').val();

        if (login !== window.admin.login || password!==window.admin.password) {
            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 );

        }//if

        else{
            location.href = `${window.paths.AjaxServerUrl}${window.paths.getAdminPanel}`;

        }//else

    });

    $('body').on('click', '#SaveButton', function () {

        let taskId = $(this).data('task-id');

        let isComp = null;

        if(!$(`input[data-task-id=${taskId}]`).is(':checked')) {
            isComp = 0;
        }//if
        else {
            isComp = 1;
        }//else

        let taskText = $(`textarea[data-task-id=${taskId}]`).val();

        $.ajax({
            'url': `${window.paths.AjaxServerUrl}${window.paths.changeTask}`,
            'type': 'POST',
            'data': {
                'id':taskId,
                'isComp': isComp,
                'taskText': taskText
            },
            'success': (data) =>{
                let status = +data.status
                let taskId = +data.taskID

                if (status === 200 && taskId !== 0) {

                    $('#errorMessage').fadeOut(1000);
                    $('#successMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );;

                }//if
                else {
                    $('#successMessage').fadeOut(1000);
                    $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );;
                }//else


            }
        });


    });

});