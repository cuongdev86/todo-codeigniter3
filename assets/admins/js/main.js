// $(document).ready(function(){
    
// });
function _toastrSuccess(message='Success', title = null){
    toastr.success(message, title);
}

function _toastrError(message='Error', title = null){
    toastr.error(message, title);
}

function _toastrWarning(message='Warning', title = null){
    toastr.warning(message, title);
}

function _toastrInfo(message='Info', title = null){
    toastr.info(message, title);
}
