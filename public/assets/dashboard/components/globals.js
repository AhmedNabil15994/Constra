$(document).off('.datepicker');

var myURL = window.location.href;
if(myURL.indexOf("#") != -1){
    myURL = myURL.replace('#','');
}
if(myURL.indexOf("?") != -1){
    myURL = myURL.replace('?','');
}
if(myURL.indexOf("/") != -1){
    myURL = myURL.replace('/','');
}

var designElems = $('input[name="designElems"]').length ?  JSON.parse($('input[name="designElems"]').val()) : [];
var lang = $('html').attr('lang');
if(lang == 'en'){
    var title = "Are you sure about this deletion?";
    var confirmButton = "Confirm";
    var cancelButton = "Cancel";
    var deleteText = "You cannot undo this step!";
    var success1 = "Deleted Successfully!";
    var success2 = "The operation was successful";
    var cancel1 = "Cancelled";
    var cancel2 = "Canceled successfully";
    var langPref = 'en';
    var rtlMode = false;
}else{
    var title = "هل متأكد من هذا الحذف ؟";
    var confirmButton = "تأكيد";
    var cancelButton = "الغاء";
    var deleteText = "لا يمكنك التراجع عن هذه الخطوة!";
    var success1 = "تم الحذف بنجاح!";
    var success2 = "تمت العملية بنجاح";
    var cancel1 = "تم الالغاء";
    var cancel2 = "تم الالغاء بنجاح";
    var langPref = 'ar_AR';
    var rtlMode = true;
}

if($('.datepicker').length){
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: langPref,
        rtl: rtlMode
    });  
}

$('[data-toggle="select2"]').select2()

function deleteItem($id) {
    swal({
        title: title,
        text: deleteText,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: confirmButton,
        confirmButtonClass: 'btn btn-success mt-2',
        cancelButtonText: cancelButton,
        cancelButtonClass: 'btn-danger ml-2 mt-2',
        closeOnConfirm: false,
        buttonsStyling:!1
    },
    function(isConfirm) {
        if (isConfirm) {
            $.get('/'+designElems.mainData.url+'/delete/' + $id,function(data) {
                if (data && data.status == 1) {
                    successNotification(data.message);
                    swal(success1, success2, "success");
                    setTimeout(function(){
                        $('#kt_datatable').DataTable().ajax.reload();
                    },2500)
                } else {
                    errorNotification(data.status.original ? data.status.original.status.message : data.message);
                }
            });
        } else {
            swal(
                cancel1,
                cancel2,
                "error"
            )
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

$("#telephone").intlTelInput({
    initialCountry: "auto",
    preferredCountries: ["sa", "ae", "bh", "kw", "om", "eg"]
});

$("form").submit(function(e) {
    if($('#telephone').length && !$('input[name="phone"]').val()){
        if($('input[name="vType"]').length && $('input[name="vType"]').val() == 3){ // For Handling Add Contact
            $(this).submit();
        }else{
            e.preventDefault();
            e.stopPropagation();
            var phone = $("#telephone").intlTelInput("getNumber");
            if (!$("#telephone").intlTelInput("isValidNumber")) {
                if (lang == "en") {
                    errorNotification("This Phone Number Isn't Valid!");
                } else {
                    errorNotification("هذا رقم الجوال غير موجود");
                }
            }else{
                $('input[name="phone"]').val(phone);
                $(this).submit();
            }
        }
        
    }
});

Dropzone.options.myAwesomeDropzone = false;
Dropzone.autoDiscover = false;
// single file upload for adding
$('#kt_dropzone_1').dropzone({
    url: myURL + "/uploadImage", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    success:function(file,data){
        if(data){
            if(data.status.status != 1){
                errorNotification(data.status.message);
            }
        }
    },
});
$('#kt_dropzone_111').dropzone({
    url: "tickets/add/uploadImage", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    success:function(file,data){
        if(data){
            if(data.status.status != 1){
                errorNotification(data.status.message);
            }
        }
    },
});
// single file upload for updating
$('#kt_dropzone_11').dropzone({
    url: myURL + "/editImage", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    },
    success:function(file,data){
        if(data){
            if(data.status.status != 1){
                errorNotification(data.status.message);
            }
        }
    },
});

$('a.DeletePhoto').on('click',function(e){
    e.preventDefault();
    e.stopPropagation();
    var id = $(this).data('area');
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        type: 'POST',
        url: myURL+'/deleteImage',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': id,
        },
        success:function(data){
            if(data.status.status == 1){
                successNotification(data.status.message);
                $('#my-preview').remove();
            }else{
                errorNotification(data.status.message);
            }
        },
    });
});

