$(document).ready( function (  ) {

    let totalTasks = +$('#title').text();

    let totalPage = Math.ceil(totalTasks/3);



    $('#pagination-here').bootpag({
        total: totalPage,          // total pages
        page: 1,            // default page
        maxVisible: 5,     // visible pagination
        leaps: true         // next/prev leaps through maxVisible
    }).on("page", function(event, num){

        //let currentPage = $(this).data('page');
        //console.log(currentPage);
        let limit = 3;
        let offset = num*limit-limit;

        let filterName = $('#supervisor').val();
        let filterToken = '';

        switch (filterName) {
            case 'По дате добавления' : filterToken = 'date';
                break;
            case 'По имени пользователя' : filterToken = 'userName';
                break;
            case 'По email пользователя' : filterToken = 'userEmail';
                break;
            case 'Выполненные задачи' : filterToken = 'taskIsComp';
                break;
            case 'Невыполненные задачи' : filterToken = 'taskNoComp';
                break;
        }//switch

        $.ajax({
            url: `${window.paths.AjaxServerUrl}${window.paths.getNextTask}`,
            type: 'GET',
            data: {
                'offset': offset,
                'limit': limit,
                'filterToken': filterToken,
            },
            'success': ( data )=>{
                let status = +data .status;
                console.log(data.countTask);
                console.log(location.href);
                console.log(`${window.paths.server}${window.paths.AjaxServerUrl}${window.paths.homePage}`);
                if( status === 200){

                    $("#content").empty();

                    $("#content").append(`
                            <div class="row justify-content-center">
                                <h4>Задачи  </h4>
                                <h4 id="title">${data.countTask} </h4>
                             </div>
                             <div class="form-group">
                                <div id="errorMessage" style=" display: none;" class="message alert alert-danger">Ошибка при обновлении!</div>
                            </div>

                            <div class="form-group">
                                <div id="successMessage"  style=" display: none;" class="message alert alert-success">Задача успешно обновлена!</div>
                            </div>
                     `);

                    if(location.href == `${window.paths.server}${window.paths.AjaxServerUrl}${window.paths.homePage}`){
                        $(data.tasks).each(function(index, value){

                            let textComp = null;

                            if(+value.isComp === 1){

                                textComp = `<h6><span style="color: green">Задача выполнена</span></h6>`;

                            }//if
                            else{
                                textComp = `<h6><span style="color: red">Задача не выполнена</span></h6>`;
                            }//else
                            $("#content").append(`
                           
                            <blockquote style="background: beige; padding: 10px ">
                                <h5>${ value.userName }</h5>
                                <h6>${ value.userEmail }</h6>
                                <p>${ value.taskText}</p>
                                <h6 id="isComp" ><span style="color: green"></span></h6>
                                ${textComp}
                                
                            </blockquote>

                        `);

                        });

                    }//if

                    if(location.href == `${window.paths.server}${window.paths.AjaxServerUrl}${window.paths.getAdminPanel}`){
                        $(data.tasks).each(function(index, value){
                            let id = +value.taskID;

                            console.log(id);
                            let textComp = null;

                            if(+value.isComp === 1){

                                textComp = `<input data-task-id="${id}" type="checkbox" checked>Выполнена<br>
                                    `;

                            }//if
                            else{
                                textComp = `<input data-task-id="${id}" type="checkbox">Выполнена<br>
                                `;
                            }//else

                            $("#content").append(`
                           
                            <blockquote style="background: beige; padding: 10px ">
                                <h5>${ value.userName }</h5>
                                <h6>${ value.userEmail }</h6>
                                
                                <textarea data-task-id="${id}" cols="100" rows="7">${ value.taskText}</textarea>
                                <h6 id="isComp" ><span style="color: green"></span></h6>
                                ${textComp}
                                <div class="form-group" data-task-id="${id}" id="SaveButton">
                                    <div  class="btn btn-primary">Сохранить изменения</div>
                                </div>
                            </blockquote>

                        `);

                        });

                    }//if

                    $("#content").append(`
                           <div  id="pagination-here">
                           </div>
                           <script type="text/javascript" src="/TaskApp/public/js/pagination.js"></script>
                        `);


                }//if

            }
        });


        $(this).bootpag({total: totalPage, maxVisible: 5});
    });



})

