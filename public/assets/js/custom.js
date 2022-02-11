/**
 * Submit Form (AJAX)
 */
function formSubmit(type, btn, form, headers = null) {
    let url = form.attr('action');
    // alert(url);
    let form_data = JSON.stringify(form.serializeJSON());
    formData = JSON.parse(form_data);
    $.ajax({
        type: type,
        url: url,
        data: formData,
        headers: headers,
        beforeSend: function () {
            $('#' + btn).prop('disabled', true);
        },
        success: function (response) {
            if (response.status === 'success') {
                toastr.success(response.message);
                form[0].reset();

                setTimeout((function () {
                    window.location.reload();
                }), 500);

            }
        },
        error: function (xhr, resp, text) {

            // on error, tell the failed
            if (xhr && xhr.responseText) {
                let response = JSON.parse(xhr.responseText);

                if (response.status === 'validate_error') {

                    $.each(response.message, function (index, message) {
                        if (message.field && message.field !== 'global') {
                            $('#' + message.field).addClass('is-invalid');
                            $('#' + message.field + '_label').addClass('text-danger');
                            $('#' + message.field + '_error').html(message.error);
                        } else if (message.error) {
                            // toastr.error(message.error);
                            console.log("err 0")
                        } else {
                            // toastr.error('Something went wrong', 'Please try again after sometime.');
                            console.log("err 1")
                        }
                    });
                } else {
                    // toastr.error('Something went wrong', 'Please try again after sometime.');
                    console.log("err 2")
                }
            } else {
                // toastr.error('Something went wrong', 'Please try again after sometime.');
                console.log("err 3")
            }
        },
        complete: function (xhr, status) {
            $('#' + btn).prop('disabled', false);
        }
    });
}

function deleteItem(url){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    setInterval(function(){
                        location.reload();
                    },1000)

                },
                error: function (xhr, resp, text) {
                    console.log(xhr);
                    // on error, tell the failed
                },
            });


        }
    })
}

/**
 * GET Single Data for Edit
 */
function getEditData(url) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {

            if (response.status === 'success') {
                console.log(response);
                Object.entries(response.data[0]).forEach((item) => {
                    //for all input filed
                    $('#' + item[0]).val(item[1]);

                    if(item[0] === "image"){
                        console.log("rupom",item[1])
                        $('.file-upload-image-edit').attr('src',item[1])
                        $('.file-upload-image').attr('src',item[1])
                    }
                    //for admin access input filed
                    if (item[0] === 'access') {
                        if (item[1] !== null){
                            let data = JSON.parse(item[1])
                            data.forEach(val =>{
                                $(`input[name='access[]'][value='${val}']`).attr('checked', true)
                            })
                        }
                    }

                    //for editor
                    if (item[0] === 'description') {
                        descriptionEditor.setData(item[1])
                    } else if (item[0] === 'privacy_policy') {
                        privacyEditor.setData(item[1])
                    } else if (item[0] === 'cookies_policy') {
                        cookiesEditor.setData(item[1])
                    } else if (item[0] === 'terms_policy') {
                        termsEditor.setData(item[1])
                    }

                    //for submit button to update button
                    if (item[0] === 'host' || item[0] === 'api_key') {
                        $('.submit-btn').text('Update')
                        // $('.smtpBtn').text('Update')
                        $('.smtp-card-title').text('Edit SMTP')
                    }


                    //for user access role id hide show

                    if (item[0] === 'user_role_id') {

                        if (item[1] === 1) {
                            $('#access_control').hide();
                        }else {
                            $('#access_control').show();
                        }
                    }

                    //
                    // if (item[0] === 'app_version' || item[0] === 'app_id') {
                    //     $('#submit-button').text('Update')
                    //     // $('.smtp-card-title').text('Edit SMTP')
                    // }
                    //
                    // if (item[0] === 'description') {
                    //     descriptionEditor.setData(item[1])
                    // } else if (item[0] === 'privacy_policy') {
                    //     privacyEditor.setData(item[1])
                    // } else if (item[0] === 'cookies_policy') {
                    //     cookiesEditor.setData(item[1])
                    // } else if (item[0] === 'terms_policy') {
                    //     termsEditor.setData(item[1])
                    // } else if (item[0] === 'radio_description') {
                    //     radioEditor.setData(item[1])
                    // } else if (item[0] === 'package_description') {
                    //     packageEditor.setData(item[1])
                    // }
                    //

                    //

                })

            }
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp)
        }
    });
}

/**
 * Generate Table Data
 */
function generateTable(id, headers, data, actions = []) {
    let container = document.getElementById(id)
    container.innerHTML = "";
    console.log(headers);
    data.forEach(function (item) {
        let tableRow = document.createElement('tr')
        headers.forEach((header) => {
            Object.keys(item).forEach((key) => {

                if (key === header.field) {
                    let tableData = document.createElement('td')

                    if (key === 'image') {
                        if (item[key] !== null) {
                            let imageUrls = item[key].split('/')
                            let imageUrl = ''
                            imageUrls.forEach((item, i) => {
                                if (i > 0) imageUrl += '/' + item
                            })

                            let imageTag = document.createElement('img')
                            imageTag.setAttribute('src', imageUrl)
                            imageTag.setAttribute('style', "width: 60px; height: 60px;")
                            tableData.appendChild(imageTag)
                        } else {
                            let imageTag = document.createElement('img')
                            imageTag.setAttribute('src', '/assets/img/default.png')
                            imageTag.setAttribute('style', "width: 60px; height: 60px;")
                            tableData.appendChild(imageTag)
                        }
                    } else {
                        tableData.innerHTML = item[key]
                    }

                    tableRow.appendChild(tableData)
                }
            })

            if (header.field === 'action' && actions.length) {
                let tableData = document.createElement('td')

                actions.forEach((actionItem) => {
                    let actionBtn = document.createElement('button')
                    actionBtn.textContent = actionItem.label

                    if (actionItem.label.toLowerCase() === 'edit') {
                        actionBtn.setAttribute('class', 'btn btn-outline-secondary me-1')

                        actionBtn.addEventListener('click', function () {
                            window.location.href = actionItem.url.replace(':id', item.id)
                            // console.log(item.id)
                            // actionItem.url.replace(':id', item.id)
                            // getEditData(actionItem.url.replace(':id', item.id))
                        })
                    } else if (actionItem.label.toLowerCase() === 'delete') {
                        actionBtn.setAttribute('class', 'btn btn-outline-secondary')

                        actionBtn.addEventListener('click', function () {
                            deleteItem(actionItem.url.replace(':id', item.id))
                            // console.log(item.id)
                        })
                    }

                    tableData.appendChild(actionBtn)
                })

                tableRow.appendChild(tableData)
            }
        })

        container.appendChild(tableRow)
    })
}

/**
 * GET Table Data
 */
function getTableData(url, id, headers, actions = []) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (response) {
            if (response.status === 'success') {
                let data = response.data
                generateTable(id, headers, data, actions)
            }
        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp)
        }
    });
}
