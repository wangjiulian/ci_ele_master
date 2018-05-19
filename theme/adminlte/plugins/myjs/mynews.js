$(function() {
	//列表页切换新闻列表url
	$("#example1_length").change(function() {
		console.log($(this).val())
		window.location.href="/complex/news/index/"+$(this).val()+"/1"
	});
	$("#example1_newsbanner").change(function() {
		console.log($(this).val())
		window.location.href="/complex/news/newsBanner/"+$(this).val()+"/1"
	});

	//新增页图片类别
	$("input[name='nkind']").click(function(){
	　　 var ckval = $("input[name='nkind']:checked").val();
		if (ckval==3) {
			$("#mp4block").css('display',"block");
			$("#imgblock").css('display',"none");
			$("#imgupmul").css('display',"none");
		}else if (ckval==1){
			$("#mp4block").css('display',"none");
			$("#imgblock").css('display',"block");
			$("#imgupmul").css('display',"none");
		}else{
			$("#mp4block").css('display',"none");
			$("#imgblock").css('display',"none");
			$("#imgupmul").css('display',"block");			
		}
	});

	//单图上传预览
	function format_float(num, pos)
	{
		var size = Math.pow(10, pos);
		return Math.round(num * size) / size;
	}
	function preview(input) {
		var img = input.name;
		if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#'+img).attr('src', e.target.result);
					var KB = format_float(e.total / 1024, 2);
					$('.size').text("檔案大小：" + KB + " KB");
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("body").on("change", ".uplsig", function (){
		preview(this);
	})

})

//多图上传预览
var Preview = new function (){
 
    var root = $(".form1");
 
    // 連續的圖片編碼
    var imgcode = '';
 
    // 選取發生改變
    this.change_file = function (){
        root.on("change", ".upl", function (){
            show(this);
        });
    }
 
    // 批次圖片，先清空後再插入
    var show = function (input){
        if (input.files && input.files[0]) {
            clean();
            each_img(input.files);
        }
    }
 
    // 批次讀取，最後再一次寫入
    var each_img = function (files){
        $.each(files, function (index, file){
            var src = URL.createObjectURL(file);
            create_imgcode(src);
        });
 
        // 放置預覽元素後重設
        root.find(".preview").html(imgcode);
        // reset();
    }
 
 
    // 建立圖片
    var create_imgcode = function(src){
        imgcode += '<img style="max-width: 240px; max-height: 240px;margin: 5px;" src="' + src + '">';
    }
    
 
    // 清空預覽區域
    var clean = function (){
        root.find(".preview").empty();
    }
 
    // 還原 input[type=file]
    var reset = function (){
        imgcode = '';
        root.find(".upl").val(null);
    }
}
 
// 執行
Preview.change_file();