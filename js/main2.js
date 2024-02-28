let errors = [];
let idComm = "";
let objCats = [];

function ajaxCallback(page, method, data, result){
    $.ajax({
      url: `${page}.php`,
      method: method,
      dataType: "json",
      data: data,
      success: result,
      error: (xhr, exception) =>{
          var errorMessage = '';
          if (xhr.status === 0){
              errorMessage = 'You are not connected, please check your internet connection';
          }
          else if(xhr.status == 404){
              errorMessage = 'Error 404 page not found.';
          }
          else if(xhr.status == 500){
              errorMessage = 'Error 500 internal server error';
          }
          else if(exception === 'parsererror'){
              errorMessage = 'JSON parse failed';
          }
          else if(exception === 'timeout'){
              errorMessage = 'Time out error.';
          }
          else if(exception === 'abort'){
              errorMessage = 'Ajax request aborted.';
          }
          else{
              errorMessage = 'Uncaught Error.\n' + xhr.responseText;
          }
          alert(errorMessage);
          console.log(xhr)

      }
    })
}
$(document).ready(function(){
    $('body').on('click','.replyComment',function(){
        $('#leave-reply').text("Reply");
        $('#comment').focus();
        idComm = $(this).parent().parent().find('input[type=hidden]').val();
    });
    $('body').on('click','.nc-delete',function(){
        let send = {
            id: $(this).data('id'),
            btn: true
        }
        ajaxCallback("models/delete-comment", "post", send, result=>{
            if(result == true) location.reload();
        });
    });
    $('body').on('change','.status',function(){
        let send = {
            id: $(this).parent().parent().find('input[type=hidden]').val(),
            dataValue: $("option:selected", this).val(),
            column: $(this).data('type'),
            btn: true
        }
        ajaxCallback("models/admin", "post", send, result=>{
        });
    });
    $(document).on('click', '.news-pagination', function(elem){
        elem.preventDefault();
        let limit = $(this).data('limit');
        filterChange(limit);
    });
    $(document).on('click', '.category-btn', function(elem){
        elem.preventDefault();
        let view = $(this).data('view');
        localStorage.setItem("view", JSON.stringify(view));
        location.href = "index.php?page=all-news";
    });
    let url = window.location.href;
    url = url.slice(url.indexOf('=')+1, url.length);
    if(url == "index" || url == "/" || url.indexOf("index")!= -1){
        $("nav a[href='index.php?page=index']").addClass("active");
    }
    else if(url == "category"){
        $("nav a[href='index.php?page=category']").addClass("active");
    }
    else if(url.indexOf("login") != -1){
        $("#login").click(function(){
            formCheck($("#email").val(), /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/, "email", "Please enter your email ex. email@gmail.com");
            formCheck($("#password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "password", "Password length has to be at least 6, and it has to have at least one number and no special characters");
            if(errors.length == 0){
                let send = {
                    email: $("#email").val(),
                    password: $("#password").val(),
                    btnl: true
                }
                ajaxCallback("models/login", "post", send, result=>{
                    serverCheck(result.email ,"email");
                    serverCheck(result.passLog ,"password");
                    if(typeof(result) == "string"){
                        $('#login').after(`<p class='text-success mt-3'>${result}</p>`);
                        setTimeout(function(){
                            window.location.replace("index.php");
                        }, 1000);
                    }
                });
            }
        });
    }
    else if(url == "registration"){
        $("#register").click(function(){
            let categories = $('.categoriesUser:checked').map(function() {
                return $(this).val();
            }).get();

            formCheck($("#name").val(), /^[A-Z][a-z]{2,15}$/, "name", "Please enter your name ex. David");
            formCheck($("#lastName").val(), /^[A-Z][a-z]{2,15}(\s([A-Z][a-z]{2,15})){0,3}$/, "lastName", "Please enter your last name ex. James");
            formCheck($("#email").val(), /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/, "email", "Please enter your email ex. email@gmail.com");
            if(categories.length == 0)
                formCheck("kk", /[1-9]/, "category", "Please select category");
            else
                formCheck("2", /[1-9]/, "category", "Please select category");
            formCheck($("#role").val(), /[1-4]/, "role", "Please select role");
            formCheck($("#password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "password", "Password length has to be at least 6, and it has to have at least one number and no special characters");
            formCheck($("#conf-password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "conf-password", "Password do not match");
            if(errors.length == 0){
                $(this).after("<p>Please wait a second</p>")
                let send = {
                    name: $("#name").val(),
                    lastName: $("#lastName").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    categoriesUser: categories,
                    role: $("#role").val(),
                    btn: true
                }
                ajaxCallback("models/registration", "post", send, result=>{
                    serverCheck(result.name ,"name");
                    serverCheck(result.lastName ,"lastName");
                    serverCheck(result.email ,"email");
                    serverCheck(result.password ,"password");
                    formCheck($("#conf-password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "conf-password");
                    if(result == 201){
                        $('#model').append(`<div class="modal fade" id="successful-registration" tabIndex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Successfully added user</h5>
                                    </div>
                                    <div class="modal-body">
                                        You have successfully registerd user
                                    </div>
                                    <div class="modal-footer">
                                        <a href="index.php" className="btn btn-primary">OK go</a>
                                    </div>
                                </div>
                            </div>
                        </div>`);
                      $('#successful-registration').modal('show');
                    }
                });
            }
        });
    }
    else if(url.indexOf("single") != -1){
        //#343a40
        $('.like').click(function (){
            let likes = parseInt($(this).next().text());
            $(this).addClass('text-danger');
            $(this).next().text(likes+1);
            let send = {
                comment: $(this).data('id'),
                type: $(this).data('type'),
                table: $(this).data('table'),
                btn: true
            }
            ajaxCallback("models/like-comment", "post", send, result=>{
                if(result == true) $(this).off('click');
            });
        });
        $('#deleteNew').click(function(){
            let send = {
                id: $('#idNew').val(),
                img: $(this).data('img'),
                src: $(this).data('src'),
                btn: true
            }
            ajaxCallback("models/delete-new", "post", send, result=>{
                if(result != ""){
                    $('#single-modal').append(`<div class="modal fade" id="delete-new-mdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">${result}</h5>
                        </div>
                        <div class="modal-body">
                            New deleted
                        </div>
                        <div class="modal-footer">
                          <a href="index.php" class="btn btn-primary">OK go</a>
                        </div>
                      </div>
                    </div>
                  </div>`);
                  $('#delete-new-mdl').modal('show');
                }
            });
        });
    }
    else if(url == "contact"){
        $("nav a[href='index.php?page=contact']").addClass("active");
        $('#btnContactMessage').click(function(){
            formCheck($('#contactName').val(), /^[A-Z][a-z]{2,15}$/, "contactName", "Please enter your name ex. David");
            formCheck($("#contactEmail").val(), /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/, "contactEmail", "Please enter your email ex. email@gmail.com");
            formCheck($("#contactMessage").val(), /^([\w\.\-\s]{10,150})+$/, "contactMessage", "Message should have at least 10 characters");
            if(errors.length == 0){
                let send = {
                    name: $("#contactName").val(),
                    email: $("#contactEmail").val(),
                    message: $("#contactMessage").val(),
                    btn: true
                }
                ajaxCallback("models/messages", "post", send, result=>{
                    serverCheck(result.name ,"contactName");
                    serverCheck(result.email ,"contactEmail");
                    serverCheck(result.message ,"contactMessage");
                    if(typeof(result) == "string"){
                        $('#form-contact').trigger("reset");
                        $('#contactMessage').after(`<p class='help-block text-success' id='pass'>${result}</p>`);
                    }
                });
            }
        });
    }
    else if(url.indexOf("all-news") != -1){
        let cat = 0;
        if(JSON.parse(localStorage.getItem("view")) != null){
            cat = JSON.parse(localStorage.getItem("view"));
        }
        localStorage.removeItem("view");
        let send = {
            limit: 0,
            category: cat,
            btn: true
        }
        try{
            ajaxCallback("models/pagination", "get", send, result=>{
                printNews(result.news, result.dates);
                printPagination(result.pages);
            });
        }
        catch(error){
            console.log(error);
        }
        console.log("tu je");
        $(`#filterNews option[value=${cat}]`).attr('selected', 'selected');
        $("nav a[href='index.php?page=all-news']").addClass("active");
    }
});
$('#editNew').click(function(){
    let cat = $(this).prev().prev().prev();

    ajaxCallback("models/available-categories", "get", null, result=>{
        $(this).parent().children().first().before(makeSelect(result, $(cat).data('cat')));
    });
    let title = $(this).parent().prev().prev().prev().children().first();
    let content = $(this).parent().next();

    $(cat).remove();
    $(title).remove();
    $(content).remove();
    $(this).after(`<input type="button" class="btn btn-sm btn-success rounded mt-3" id="finish-edit-new" value="Done" />`);
    $(this).after(`<textarea rows="11" class="form-control mt-3" id="txt-content">${$(content).text()}</textarea>`);
    $(this).after(`<textarea rows="2" class="form-control mt-3" id="txt-title">${$(title).text()}</textarea>`);

    $('#finish-edit-new').click(function(){
        let newTitle = $('#txt-title').val();
        let newContent = $('#txt-content').val();
        let newCat = $('#edit-new-category option:selected').val();
        formCheck(newCat, /^[1-9]\d*$/, "edit-new-category", "Don't try to break this website, you are not smarter than me ;)");
        if(errors.length == 0){
            let send = {
                idNew: $('#idNew').val(),
                category: newCat,
                title: newTitle,
                content: newContent,
                btn: true
            }
            ajaxCallback("models/edit-new", "post", send, result=>{
                // serverCheck(result.title, "txt-title");
                // serverCheck(result.content, "txt-content");
                serverCheck(result.category, "edit-new-category");
                if(result == true){
                    location.reload();
                }
            });
        }
    });
});
let regCat = /^([A-Z][a-z]{2,15}){1,5}(\s[A-Z]{0,2}[a-z]{2,15}){0,4}$/;
$('#add-category').click(function(){
    errors = [];
    let nameCat = $("#add-category-text").val();
    formCheck(nameCat, regCat, "add-category-text", "Category must start with capital and have no nubers");
    if(errors.length == 0){
        let send = {
            nameCat: nameCat,
            btn: true
        }
        ajaxCallback("models/add-category", "post", send, result=>{
            serverCheck(result.nameCat , "add-category-text");
            if(result == true){
                location.reload();
            }
        });
    }
});
$('.edit-category').click(function(){
    errors = [];
    let edit = $(this).parent().prev().children().first().val();
    formCheck(edit, regCat, $(this).parent().prev().children().first().attr('id'), "Category must start with capital and have no nubers");
    if(errors.length == 0){
        let send = {
            id: $(this).parent().parent().parent().parent().data('id'),
            edit: edit,
            btn: true
        }
        ajaxCallback("models/edit-category", "post", send, result=>{
            serverCheck(result.edit , $(this).parent().prev().children().first().attr('id'));
            if(result == true){
                location.reload();
            }
        });
    }
});
$('.delete-category').click(function(){
    let send = {
        id: $(this).parent().parent().data('id'),
        btn: true
    }
    ajaxCallback("models/delete-category", "post", send, result=>{
        serverCheck(result.news , $(this).parent().parent().attr('id'));
        if(result == true){
            location.reload();
        }
    });
});
$('#ptp').one('click', function(){
    $(this).after(`<input type="password" class="form-control" id="password" placeholder="Change password" /><input type="password" class="form-control mt-3" id="conf-password" placeholder="Confirm password" /><input type="button" class="btn btn-primary mt-3" value="Change" id="cpassBtn" /><p class="mt-2">Note: if you change your password you will be logged out</p>`);
    $('#cpassBtn').click(function(){
        formCheck($("#password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "password", "Password length has to be at least 6, and it has to have at least one number and no special characters");
        formCheck($("#conf-password").val(), /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]{6,}$/, "conf-password", "Password do not match");
        if(errors.length == 0){
            let send = {
                id: $('#ptp').data('id'),
                password: $('#password').val(),
                btn: true
            }
            ajaxCallback("models/change-password", "post", send, result=>{
                serverCheck(result.password ,"password");
                if(result != ""){
                    $('#cpassBtn').after(`<p class='text-success mt-3'>${result}</p>`);
                    setTimeout(function(){
                        window.location.replace("models/sign-out.php?id=1");
                    }, 1500);
                }
            });
        }
    });
});

$('.nc-delete-message').click(function(){
    let send = {
        id: $(this).data('id'),
        btn: true
    }
    ajaxCallback("models/delete-message", "post", send, result=>{
        if(result == true){
            location.reload();
        }
    });
});
$('#filterNews').change(function(){
    filterChange();
});
$('#orderNews').change(function(){
    filterChange();
});
$('.journalist').change(function (){
    let deleteCat = $(this).data('delete') == undefined ? 0 : 1;
    let send = {
        user: $(this).data('user'),
        category: $(this).data('id'),
        deleteCat : deleteCat,
        btn: true
    };
    ajaxCallback("models/redactor", "post", send, result=>{
        if(result == true){
            location.reload();
        }
    });
});
function printNews(news, dates, limit){
    let html = "";
    let rb = limit * 2 + 1;
    var i = 0;
    for(n of news){
        html += `<div class="latest-news-item col-11 m-auto mb-4">
                        <div class="bg-light rounded row">
                            <div class="rounded-top overflow-hidden col-6">
                                <img src="img/${n.src}" class="img-zoomin img-fluid rounded-top w-100" alt="${n.alt}">
                            </div>
                            <div class="d-flex flex-column pt-4 col-6">
                                <a href="index.php?page=single&single=${n.news_id}" class="h4">
                                    ${n.title.length > 35 ? n.title.substring(0,35)+"..." : n.title}
                                </a>
                                <div class="d-flex justify-content-between">
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>${dates[i]}</small>
                                </div>
                                <p>
                                     ${n.content.length > 80 ? n.content.substring(0,80)+"..." : n.content}
                                </p>
                                <p class="text-white col-3 text-center py-2 bg-primary rounded">${n.name}</p>
                            </div>
                        </div>
                    </div>`;
        rb++;
        i++;
    }
    $('#insert-news').html(html);
}
function printPagination(numberOfPages){
    html = "";
    for(let i = 0; i < numberOfPages / 4; i++){
        html += `
        <li class="page-item">
            <a class="page-link news-pagination" href="#" data-limit="${i}">${(i+1)}</a>
        </li>`
    }
    $("#pagination-page").html(html);
}
function filterChange(limit = 0){
    let category = $('#filterNews option:selected').val();
    let sorting = $('#orderNews option:selected').val();
    let send = {
        limit: limit,
        category: category,
        sort: sorting,
        btn: true
    };
    try{
        ajaxCallback("models/pagination", "get", send, result=>{
            printNews(result.news, result.dates);
            printPagination(result.pages);
        });
    }
    catch(error){
        console.log(error);
    }
}
function makeSelect(data, idc){
    let html = "<select id='edit-new-category' class='form-select form-select-sm w-25 mb-2' data-type='active' aria-label='.form-select-sm example'>";
    for(i of data){
        html += `<option value=${i.category_id} ${idc == i.category_id ? "selected" : ""}>${i.name}</>`;
    }
    html += "</select>";
    return html;
}
function serverCheck(data, id){
    if(data != undefined){
        if(id == "email"){
            $(`#message-${id}`).remove();
        }
        if(id == "password"){
            $(`#message-${id}`).remove();
        }
        if($(`#message-${id}`).is(":visible")) return;
        $(`#${id}`).addClass('border border-danger').after(`<p class='help-block text-danger mb-0' id='message-${id}'>${data}</p>`);
    }
    else{
        formCheck("true", "true", id, "m");
    }
}
function formCheck(val, reg, id, message){
    if(val.match(reg)){
        if(id == "conf-password"){
            if($('#password').val() != val){
                if($(`#message-conf-password`).is(":visible")) return;
                $('#conf-password').addClass('border border-danger').after(`<p class='text-danger mb-0' id='message-conf-password'>${message}</p>`);
                errors.push(id);
                return;
            }
        }
        $(`#message-${id}`).fadeOut();
        $(`#${id}`).removeClass("border border-danger");
        errors = errors.filter(el=>el != id);
        return true;
    }
    else if(id == "conf-password") {
        if($(`#message-${id}`).is(":visible")) return;
        $(`#${id}`).after(`<p class='text-danger mb-0' id='message-${id}'>${message}</p>`).addClass('border border-danger');
        errors.push(id);
    }
    else{
        $('#pass').fadeOut();
        errors.push(id);
        if($(`#message-${id}`).is(":visible")) return;
        $(`#${id}`).after(`<p class='help-block text-danger mb-0' id='message-${id}'>${message}</p>`);
        if(id.indexOf("id-") != -1) return;
        $(`#${id}`).addClass("border border-danger");
    }
}
