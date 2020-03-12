var $uploadCrop,
    tempFilename,
    rawImg,
    imageId;

$("#changeImage").on('click', function (e) {
    $('.item-img').trigger('click');
});

function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-demo').addClass('ready');
            $('#cropImagePop').modal('show');
            rawImg = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        swal("Sorry - you're browser doesn't support the FileReader API");
    }
}

$uploadCrop = $('#upload-demo').croppie({
    viewport: {
        width: 175,
        height: 175,
    },
    enforceBoundary: false,
    enableExif: true
});
$('#cropImagePop').on('shown.bs.modal', function () {
    $uploadCrop.croppie('bind', {
        url: rawImg
    }).then(function () {
        console.log('jQuery bind complete');
    });
});

$('.item-img').on('change', function (e) {
    const extension = $('#image').val().split('.').pop().toLowerCase();
    if (/^(jpg|jpeg|png|gif|bmp)$/.test(extension)) {
        imageId = $(this).data('id');
        tempFilename = $(this).val();
        $('#cancelCropBtn').data('id', imageId);
        readFile(this);
    } else {
        toastr.warning('Please input file image.');
    }
});
$('#cropImageBtn').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: {width: 200, height: 200}
    }).then(function (resp) {
        $('#avatar').attr('src', resp);
        $('.nav-avatar').attr('src', resp);
        $.ajax({
            url: $('#cropImageBtn').attr('data-remote'),
            type: 'PUT',
            data: {
                avatar: resp
            },
            success: (response) => {
                if (response.code === 202) {
                    $('#cropImagePop').modal('hide');
                    toastr.success(response.message);
                }
            }
        })
    });
});
