$(function(){
//  重置输入框
    $(document).on("click",".weui-icon-clear",function(e){
        var $input = $(e.target).siblings(".login-input").val("").focus().trigger("input");
    })
})
