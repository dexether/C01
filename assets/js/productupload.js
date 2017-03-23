var $productid;

Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("div#dropzoneupload", {
    url: "/product/images/upload/?from=new_product",
    paramName: "file",
    maxFilesize: 1,
    acceptedFiles: "image/png",
    autoProcessQueue: false,
    addRemoveLinks: true,
    uploadMultiple: true,
    params: { _token: $.cookie("token") }
});
myDropzone.on('success', function(file, res) {
    console.log(res);
});

$(document).ready(function() {
    $('#productUploadForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            product_name: {
                threshold: 3,
                validators: {
                    notEmpty: {
                        message: 'Nama barang harus diisi'
                    },
                    stringLength: {
                        min: 6,
                        max: 60,
                        message: 'Nama barang minimal 6 huruf maksimal 60 huruf'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.\s]+$/,
                        message: 'The Nama barang can only consist of alphabetical, number, dot and underscore'
                    },
                    remote: {
                        message: 'Nama Produk Sudah diambil',
                        url: '/api/product/name/rule',
                        type: 'GET',
                        delay: 500 // Send Ajax request every 2 seconds
                    }
                }
            },
            product_weight: {
                validators: {
                    notEmpty: {
                        message: "Berat barang harus disi"
                    },
                    numeric: {
                        message: "Berat barang harus berupa angka"
                    }
                }
            },

            product_price: {
                validators: {
                    notEmpty: {
                        message: "Harga harus diisi"
                    },
                    numeric: {
                        message: "Harga barang harus berupa angka"
                    }
                }
            },
            product_desc: {
                validators: {
                    notEmpty: {
                        message: "Deksripsi Produk harus diisi"
                    }
                }
            }
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();

        var $form = $(e.target), // The form instance
            fv = $(e.target).data('formValidation'); // FormValidation instance
        $.ajax({
            url: "/product/new",
            data: $form.serializeArray(),
            type: "POST",
        }).done(function(response) {
            $productid = response.id;
            uploadMultipleImages(response);
        });

    });



});
var $selectedImages;

function callModalAndChooseImages(response) {
    var product_id = response.id;
    $('#myModal').modal({
        show: true,
        backdrop: "static",
        keyboard: false
    });
    $('#myModal').on('shown.bs.modal', function(e) {
        var $url = '/api/product/images/' + product_id;
        $('.modal-body').load($url, function() {
            $('.img-selected').click(function(e) {
                e.preventDefault();
                $('#eachImagesUploaded').parent().find('img').removeClass('img-selected-active');
                $(this).addClass('img-selected-active');
                selectedImages = $(this).data('id');
            });
        });
    })

}

function setPrimaryImages() {
    var $button = $('#btn-jual');
    $('input[name=images_id]').val(selectedImages);
    $('input[name=product_id]').val($productid);
    var $form = $('#form-ajax');
    $button.button('loading');

    $form.submit();
}

function uploadMultipleImages(response) {
    myDropzone.on('sending', function(file, xhr, formData) {
        formData.append('product_id', response.id);
    });
    myDropzone.processQueue();

    myDropzone.on('success', function(file, res) {
        callModalAndChooseImages(response);
    });
}