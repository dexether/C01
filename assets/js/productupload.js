Dropzone.autoDiscover = false;
// $("#dropzoneupload").dropzone({ url: "/file/post" });
var myDropzone = new Dropzone("div#dropzoneupload", {
    url: "/product/images/upload/?from=new_product",
    paramName: "file",
    maxFilesize: 1,
    acceptedFiles: "image/*",
    autoProcessQueue: false,
    addRemoveLinks: true,
    uploadMultiple: true,
    params: { _token: $.cookie("token") }
});
myDropzone.on('success', function(file, res) {
    console.log(res);
});

$(document).ready(function() {
    console.log('start');
    $('#productUploadForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            product_name: {
                validators: {
                    notEmpty: {
                        message: 'Nama barang harus diisi'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'Nama barang minimal 6 huruf'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.\s]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
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
        // Prevent form submission
        e.preventDefault();

        // Some instances you can use are
        var $form = $(e.target), // The form instance
            fv = $(e.target).data('formValidation'); // FormValidation instance
        // console.log($form.serializeArray())
        $.ajax({
            url: "/product/new",
            data: $form.serializeArray(),
            type: "POST",
        }).done(function(response) {
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
        // console.log(product_id);
        // console.log(response);
        var $url = '/api/product/images/' + product_id;
        $('.modal-body').load($url, function() {
            console.log('Modal loaded ..');
            $('.img-selected').click(function(e) {
                e.preventDefault();
                $('#eachImagesUploaded').parent().find('img').removeClass('img-selected-active');
                $(this).addClass('img-selected-active');
                selectedImages = $(this).data('id');
                console.log(selectedImages);
            });
        });
    })

}

function setPrimaryImages() {
    // console.log(selectedImages)
    // $(this).button('loading');
    var $this = $(this);
    $this.button('loading');
    // $.ajax({
    //     url: '/product/images/setprimary',
    //     type: 'POST',
    //     dataType: 'JSON',
    //     data: {
    //         '_token': $.cookie('token'),
    //         'images_id': selectedImages
    //     }
    // }).done(function(response) {
    //     console.log(response)
    // }).error(function() {

    // });
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