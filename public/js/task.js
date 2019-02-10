'use strict';
$(document).ready( function (  ){
    $('#AddTaskButton').click( function (  ){

        let userName = $('#UserNameInput').val();

        let userEmail = $('#UserEmailInput').val();

        let taskText = $('#TaskTextInput').val();

        if (/^[a-zа-я\s]{2,50}$/i.test(userName) === false) {
            $('#errorNameInput').fadeIn(500).delay( 5000 ).fadeOut( 500 );

        }//if
        else if(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i.test(userEmail) === false){
            $('#errorEmailInput').fadeIn(500).delay( 5000 ).fadeOut( 500 );
        }//else if
        else if(/\S{1,500}$/i.test(taskText) === false){
            $('#errorTaskArea').fadeIn(500).delay( 5000 ).fadeOut( 500 );
        }//else if
        else{

            $.ajax({
                url: `${window.paths.AjaxServerUrl}${window.paths.addTask}`,
                type: 'POST',
                data: {
                    'userName': userName,
                    'userEmail': userEmail,
                    'taskText': taskText,
                },
                'success': ( data )=>{

                    let taskId = +data.taskID;
                    let status = +data .status;

                    if( status === 200 && taskId!==0){

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );;


                    }//if
                    else{
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );;
                    }//else



                }
            });
        }//else

    });

});