// 鼠标hover图片放大事件
$(function(){
	$(".left_thumb_imgharry").each(function(){
		$(this).find("img").hover(function(){
			$(this).animate({
				width: 170,
				height: 150,
				padding: 10,
				left: -50,
				top: -38
			},170).addClass("hover");				   
		},function(){
			$(this).animate({
				width: 80,
				height: 75,
				padding: 1,
				left: 0,
				top: 0
			},80).removeClass("hover");	
		});	
		$(this).hover(function(){
			$(this).css("z-index",1);	
		},function(){
			$(this).css("z-index",0);
		});
	});

});

//改变状态--通用
function mychangeStat(id,fields)
{
	if (confirm('确认提交吗？')) {
		$.post("/welcome/chgsta",{id:id,fields:fields},function(data){
			window.location.reload();
		});
	}
}