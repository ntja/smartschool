var base_url = $('body').attr('data-base-url');

function upload_image(form_id) {
    var request, result, data;
    data = new FormData($("#" + form_id)[0]);
    console.log(data);
    result = false;
    request = $.ajax({
        url: $('body').attr('data-base-url') + '/fileupload',
        data: data,
        dataType: 'json',
        async: false,
        type: 'POST',
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
        },
    });
    if (request.status == 200) {
        result = JSON.parse(request.responseText);
    }
    return result;
}

function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


