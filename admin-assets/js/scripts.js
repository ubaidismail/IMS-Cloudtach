/*!
    * Start Bootstrap - SB Admin v7.0.4 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});

$(document).ready(function () {

    $('.save_inv_ring').hide();
    //
    $('button#sidebarToggle').click(function () {
        var a = $('.sb-nav-fixed').hasClass('sb-sidenav-toggled');
        if (a == true) {
            $('.sb-sidenav-footer').hide();
            $('#layoutSidenav_nav').addClass('fixed-lf-nav-icon');
            $('.sb-nav-link-icon').show();
            $('.sb-nav-link-icon').removeAttr('hidden');
        } else {
            $('.sb-sidenav-footer').show();
            $('#layoutSidenav_nav').removeClass('fixed-lf-nav-icon');
            $('.sb-nav-link-icon').hide();
            $('.sb-nav-link-icon').attr('hidden', true);

        }
    })
    // cookie reminde ************
    // cookie reminde ************
    function displayTasks() {
        var tasks = JSON.parse(localStorage.getItem("tasks"));
        console.log(tasks);
        if(tasks != null){
            if (tasks.length != '') {
                var removeTxt = "<a href='#' class='remove-tsk-local'><i class='fas fa-trash'></i></a>";
                var markDone = "<a href='#' class='done-tsk-local'><i class='fas fa-check'></i></a>";
                var edit = "<a href='#' class='edit-tsk-local'><i class='fas fa-edit'></i></a>";
                for (var i = 0; i < tasks.length; i++) {
                    if(tasks[i].completed == false){

                        $(".land_txt_here ul").append("<li>" + "<span>" + tasks[i].task + "</span>" + removeTxt + markDone + edit + "</li>");
                    }else{
                        $(".land_txt_here ul").append("<li class='complete'>" + "<span>" + tasks[i].task + "</span>" + removeTxt + markDone + edit + "</li>");

                    }
                }
            }
        }
        
    }
    displayTasks();

    $("button#save-click").click(function () {
        var removeTxt = "<a href='#' class='remove-tsk-local'><i class='fas fa-trash'></i></a>";
        var markDone = "<a href='#' class='done-tsk-local'><i class='fas fa-check'></i></a>";
        var edit = "<a href='#' class='edit-tsk-local'><i class='fas fa-edit'></i></a>";
        var task = $("#reminder_txt_input").val();
        if (task.length != '') {
            $(".land_txt_here ul").append("<li>" + "<span>" + task + "</span>" + removeTxt + markDone + edit + "</li>");
            $("#reminder_txt_input").val("");
            var tasks = JSON.parse(localStorage.getItem("tasks")) || [];
            tasks.push({task , completed:false});
            localStorage.setItem("tasks", JSON.stringify(tasks));
        } else {
            alert('Please Add Reminder Text')
        }
    });

    //remove task

    $(".land_txt_here ul").on("click", 'li a.remove-tsk-local' , function () {
        var task = $(this).parent().text();
        $(this).parent().remove();
        // Remove the task from Local Storage
        var tasks = JSON.parse(localStorage.getItem("tasks"));
        var index = tasks.indexOf(task);
        tasks.splice(index, 1);
        localStorage.setItem("tasks", JSON.stringify(tasks));
    });
    //edit task ***************************
    //edit task ***************************
    $(".land_txt_here ul").on("click", 'li a.edit-tsk-local', function () {
        var task_remove = $(this).parent().text();
        var input_val = $("#reminder_txt_input").val(task_remove);
        $('button#save-click').prop('disabled' , true);
        $('#reminder_form').append('<button type="submit" class="btn btn-success mt-2" id="update_task">Update List</button>');
        $(this).parent().remove();
        $('button#update_task').click(function () {
            var removeTxt = "<a href='#' class='remove-tsk-local'><i class='fas fa-trash'></i></a>";
            var markDone = "<a href='#' class='done-tsk-local'><i class='fas fa-check'></i></a>";
            var edit = "<a href='#' class='edit-tsk-local'><i class='fas fa-edit'></i></a>";
            var task = $("#reminder_txt_input").val();
            if (task.length != '') {
                $(".land_txt_here ul").append("<li>" + "<span>" + task + "</span>" + removeTxt + markDone + edit + "</li>");
                var tasks = JSON.parse(localStorage.getItem("tasks")) || [];
                var index = tasks.indexOf(task_remove);
                $('button#save-click').prop('disabled' , false);
                $('#update_task').remove();
                // tasks.splice(index, 1 , input_value_updated);
                tasks.splice(index, 1 , {task , completed:false});
                localStorage.setItem("tasks", JSON.stringify(tasks));
            } else {
                alert('Please Add Reminder Text')
            }

        })
    });
    // complete task***
    // complete task***
    $(".land_txt_here ul").on("click", 'li a.done-tsk-local', function () {
        $(this).parent().toggleClass('complete');
        var task = $(this).parent().text();
        var tasks = JSON.parse(localStorage.getItem("tasks")) || [];
        var index = -1;
        for(var i = 0; i < tasks.length; i++) {
            if (tasks[i].task === task) {
                index = i;
                break;
            }
        }
        // console.log(index);
        // console.log(i);
        if (index !== -1) {
            tasks[index].completed = !tasks[index].completed;
            localStorage.setItem("tasks", JSON.stringify(tasks));
        }
    });

    //ajax requests*************
    //ajax requests**************************
    //ajax requests*********************************************************X****************************************

    $('#invoice_form .save_inv').click(function (e) {
        e.preventDefault();
        var get_inputs = $('#invoice_form input').val();
        var get_inputs_table = $('table#tab_logic input').val();
        if(get_inputs.length != '' && get_inputs_table != ''){
            $('.save_inv_ring').show();
            $.ajax({
                url: '/index.php/AdminController/save_invoice',
                type: 'POST',
                data: $('#invoice_form').serialize(),
                success: function (response) {
                    console.log(response);
                    $('#invoice_form').prepend('<span class="bg-success error-sms-invoice-submit">Invoice Submited.</span>');
                    $('.save_inv_ring').hide();
                    $('#invoice_form').trigger("reset");
                    setTimeout(function () {
                        $('.error-sms-invoice-submit').fadeOut();
                    }, 3000);
                },error:function(error){
                    $('#invoice_form').prepend('<span class="bg-danger error-sms-invoice-submit">'+error.message+'</span>');
                    console.log(error);
                    setTimeout(function () {
                        $('.error-sms-invoice-submit').fadeOut();
                    }, 4000);
                }
            });
        }else{
            $('#invoice_form').prepend('<span class="bg-danger error-sms-invoice-submit">Please Fill the reqruied data</span>');
            setTimeout(function () {
                $('.error-sms-invoice-submit').fadeOut();
            }, 4000);
        }
       

    })
    $('#fee_form .save_fee').click(function (e) {
        e.preventDefault();
        $('.save_inv_ring').show();
        $.ajax({
            url: '/index.php/AcademyController/save_fee',
            type: 'POST',
            data: $('#fee_form').serialize(),
            success: function (response) {
                console.log(response);
                alert('success');
                $('.save_inv_ring').hide();
            }
        });

    })

    setTimeout(function () {
        $('.inv_delte-sms').fadeOut();
    }, 3000);

    $("#company_logo").on("change", function () {
        var form = $('#company-logo-upload-form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        formData.append('company_logo', $('input[type=file]')[0].files[0]);
        var user_id = $('input[name="user_id"]').val();
        formData.append("user_id", user_id);
        $('#company_logo').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: "/index.php/AdminController/save_invoice_company_logo",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (response) {
                console.log(response);
                location.reload();
                // alert('success');
            }, error: function (error) {
                alert(error);
            }
        });
    });

    $('.remove-logo').click(function () {
        var user_id = $(this).attr('data-user');
        var img = $(this).attr('data-img');
        var div = $('.fromimg').html();
        // $(this).prop('disabled' , true);
        $.ajax({
            type: "POST",
            url: "/index.php/AdminController/remove_invoice_company_logo",
            data: { 'user_id': user_id, 'img': img },
            success: function (response) {
                jQuery('#data-dynamic-div').html(response);

                $("#company_logo").on("change", function () {
                    var form = $('#company-logo-upload-form')[0]; // You need to use standard javascript object here
                    var formData = new FormData(form);
                    formData.append('company_logo', $('input[type=file]')[0].files[0]);
                    var user_id = $('input[name="user_id"]').val();
                    formData.append("user_id", user_id);
                    $('#company_logo').prop('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: "/index.php/AdminController/save_invoice_company_logo",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        success: function (response) {
                            // console.log(response);
                            location.reload();
                        }, error: function (error) {
                            alert(error);
                        }
                    });
                });

            }, error: function (error) {
                jQuery('#data-dynamic-div').html(error);
                
            }
        });
    })


}) 

//db open hide 
$('.abs-db-pass').hide();
$('#view-db-pass').click(function () {
    $('.abs-db-pass').show();
    $('.abs-db-pass').removeAttr('hidden');
})
$('.close-db').click(function () {
    $('.abs-db-pass').hide();
})

