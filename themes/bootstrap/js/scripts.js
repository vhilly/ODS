$(document).on("click", '.modal-content', function(){
    var target = $(this).attr('data-target');
    var url = $(this).data('content');
    if(url){
        $(target).find(".modal-body").load(url);
        $(target).find(".modal-header h4").html($(this).data('title'));
        $(target).find(".modal-footer").html('<button id="btnSave" onclick="$(\'#ajaxSubmit\').click();" class="btn btn-primary">Save</button>'+
       '<button data-dismiss="modal" id="modalClose" class="btn" name="yt0" type="button">Close</button>');
    }
});
$(document).on("click", '.imcc', function(){
    var target = $(this).attr('data-target');
    $(target).find(".modal-body").html('test');
    $(target).find(".modal-header h4").html($(this).data('title'));
    $(target).find(".modal-footer").html('<button id="btnSnd" onclick="socket.emit(\'test\',\'test\')" class="btn btn-primary">Send</button>'+
       '<button data-dismiss="modal" id="modalClose" class="btn" name="yt0" type="button">Close</button>');
});
