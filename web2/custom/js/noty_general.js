function notify(style,position) {
    if(style == "error"){
        icon = "fa fa-exclamation";
    }else if(style == "warning"){
        icon = "fa fa-warning";
    }else if(style == "success"){
        icon = "fa fa-check";
    }else if(style == "info"){
        icon = "fa fa-question";
    }else{
        icon = "fa fa-circle-o";
    }
    $.notify({
        title: 'Sample Notification',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci ut dolor scelerisque aliquam.',
        image: "<i class='"+icon+"'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition:position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHide: false,
        clickToHide: true
    });
}
function notifyconfirm() {
    $.notify({
        title: 'Are you sure ?',
        text: 'Are you sure you want to do NTR Update ?<div class="clearfix"></div><br><a class="btn btn-sm btn-default yes">Yes</a> <a class="btn btn-sm btn-danger no">No</a>',
        image: "<i class='fa fa-warning'></i>"
    }, {
        style: 'metro',
        className: "cool",
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHide: false,
        clickToHide: false
    });
}
function notifyerror(style, position, title, keterangan) {
    icon = "fa fa-exclamation";
    $.notify({
        title: title,
        text: keterangan,
        image: "<i class='" + icon + "'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition: position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 6000,
        autoHide: false,
        clickToHide: true
    });
}

function notifycus(style, position, title, keterangan) {
    if(style == "error"){
        icon = "fa fa-exclamation";
    }else if(style == "warning"){
        icon = "fa fa-warning";
    }else if(style == "success"){
        icon = "fa fa-check";
    }else if(style == "info"){
        icon = "fa fa-question";
    }else{
        icon = "fa fa-circle-o";
    }
    $.notify({
        title: title,
        text: keterangan,
        image: "<i class='"+icon+"'></i>",

    }, {
        style: 'metro',
        className: style,
        globalPosition:position,
        showAnimation: "show",
        showDuration: 0,
        autoHideDelay: 3000,
        autoHide: true,
        clickToHide: true
    });
}

function notifysuccess_autoload(style, position, title, keterangan) {
    icon = "fa fa-check";
    $.notify({
        title: title,
        text: keterangan,
        image: "<i class='" + icon + "'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition: position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 6000,
        autoHide: true,
        clickToHide: true
    });
}

function notifysuccess_common(style, position, title, keterangan) {
    icon = "fa fa-check";
    $.notify({
        title: title,
        text: keterangan,
        image: "<i class='" + icon + "'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition: position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 3000,
        autoHide: false,
        clickToHide: true
    });
}

function notify(style, position) {
    if (style == "error") {
        icon = "fa fa-exclamation";
    } else if (style == "warning") {
        icon = "fa fa-warning";
    } else if (style == "success") {
        icon = "fa fa-check";
    } else if (style == "info") {
        icon = "fa fa-question";
    } else {
        icon = "fa fa-circle-o";
    }
    $.notify({
        title: 'Sample Notification',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci ut dolor scelerisque aliquam.',
        image: "<i class='" + icon + "'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition: position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHide: false,
        clickToHide: true
    });
}

function notify2(style, position) {
    $(".autohidebut").notify({
        text: '<i class="fa fa-comment-o"></i> Hi buddy. I\'m here!'
    }, {
        style: 'metro',
        className: 'nonspaced',
        elementPosition: position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHide: false,
        clickToHide: true
    });
}

function autohidenotify(style, position) {
    if (style == "error") {
        icon = "fa fa-exclamation";
    } else if (style == "warning") {
        icon = "fa fa-warning";
    } else if (style == "success") {
        icon = "fa fa-check";
    } else if (style == "info") {
        icon = "fa fa-question";
    } else {
        icon = "fa fa-circle-o";
    }
    $.notify({
        title: 'I will be closed in 3 seconds...',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci ut dolor scelerisque aliquam.',
        image: "<i class='fa fa-warning'></i>"
    }, {
        style: 'metro',
        className: style,
        globalPosition: position,
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHideDelay: 3000,
        autoHide: true,
        clickToHide: true
    });
}

function nnconfirm() {
    $.notify({
        title: 'Are you Sure ?',
        text: 'Are you sure you want to do NTR UPDATE ?<div class="clearfix"></div><br><a class="btn btn-sm btn-default ya">Yes</a> <a class="btn btn-sm btn-danger ga">No</a>',
        image: "<i class='fa fa-warning'></i>"
    }, {
        style: 'metro',
        className: "cool",
        showAnimation: "show",
        showDuration: 0,
        hideDuration: 0,
        autoHide: false,
        clickToHide: false
    });
}

$(function () {
    //listen for click events from this style
    $(document).on('click', '.notifyjs-metro-base .ga', function () {
        //programmatically trigger propogating hide event
        $(this).trigger('notify-hide');
    });
    $(document).on('click', '.notifyjs-metro-base .ya', function () {
        //show button text
        Ntr_update_JS.updatetb(statements_filter.value);
        
        //hide notification
        $(this).trigger('notify-hide');
    });
})