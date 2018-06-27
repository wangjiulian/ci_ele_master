<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>编辑商品<!-- <small>Optional description</small> --></h1>
  <ol class="breadcrumb"><li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li><li class="active">Here</li></ol>
</section>

<!-- Main content -->
<section class="content">
	<div style="position: fixed;right: 15px;z-index: 10;">
		<button class="btn btn-block btn-warning btn-sm" onclick="history.go(-1)">后退</button>
	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- general from elements -->
			<div class="box box-primary">
			<!-- from start -->
			  <form method="post" action="" enctype="multipart/form-data">
				 <div class="box-body">
				 		<div class="form-group">
				 		<label><span style="color: red">* </span>商家</label><br>
				 		<select  class="form-control" name='business_id' id="business_id">
				 			<?php foreach ($business as $lv) {?>
				 				<option <?php if ($target['business_id'] == $lv['id']) {?> selected <?php }?> value="<?=$lv['id']?>"><?=$lv['name']?></option>
				 		<?php	}?>
				 		</select>
				 			<label><span style="color: red">* </span>商品分类</label><br>
				 		<select  class="form-control" name='sort_id' id="sort_id">
				 			<?php foreach ($sort as $lv) {?>
				 				<option <?php if ($target['goods_sort_id'] == $lv['id']) {?> selected <?php }?> value="<?=$lv['id'] . '##' . $lv['name']?>"><?=$lv['name']?></option>
				 		<?php	}?>
				 		</select>
				 	</div>
				 	<div class="form-group">
				 		<label><span style="color: red">* </span>名称</label><br>
				 		<input type="" value="<?=$target['name']?>" class="form-control" name="iftitle" id="iftitle" placeholder="请输入商品名称">
				 	</div>
				 		<div class="form-group">
				 		<label><span style="color: red">* </span>价格</label><br>
				 		<input type="" value="<?=$target['price']?>" class="form-control"  name="ifprice" id="ifprice" onkeyup="if( ! /^\d*(?:\.\d{0,2})?$/.test(this.value)){alert('只能输入数字，小数点后只能保留两位');this.value='';}" placeholder="只能输入数字，小数点后只能保留两位">
				 	</div>
				 	<div class="form-group">
				 		<label><span style="color: red">* </span>图片</label><br>
				 		 <input id="file-4" name="nbfile" class="file" accept="image/*" type="file" multiple data-preview-file-type="any" data-upload-url="/welcome/do_up_img">
                         <div style="display: none;" id="imgsup"></div>
				 	</div>
				 	<div class="form-group">
				 		<label><span style="color: red">* </span>简介</label><br>
				 		<input type="" value="<?=$target['introduce']?>" class="form-control" name="ifintroduce" id="ifintroduce" placeholder="请输入商品简介">
				 	</div>
				 </div>
				 <!-- /.box-body -->
				 <div class="box-footer">
				 	<button type="submit" id="onsubmit" class="btn btn-primary">提交</button>
				 	<button type="button" class="btn btn-warning" onclick="history.go(-1)">后退</button>
				 </div>
			  </form>
            </div>
		</div>


	</div>
</section>
<!-- /.content -->
<!-- fileinput -->
<script src="/<?=ADMINTMP?>/fileinput/js/plugins/sortable.js" type="text/javascript"></script>
<script src="/<?=ADMINTMP?>/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="/<?=ADMINTMP?>/fileinput/themes/explorer/theme.js" type="text/javascript"></script>

<!-- REQUIRED SCRIPT -->
<script type="text/javascript">

     // 上传前
    $("#file-4").fileinput({
        maxFileCount: 3,
        previewFileType: 'any',
        uploadExtraData: {eleId: "<?=HASHVERIFY?>",path:'menu'}
    });

    // 上传成功后返回json
    $('#file-4').on('fileuploaded', function(event, data, previewId, index) {
        var form = data.form, files = data.files, extra = data.extra,
            response = data.response, reader = data.reader;
        $("#imgsup").append('<input type="" class="tpimg" name="tpimg" value="'+response.path+'">');
        // console.log(response);return false;
    });


     $('#business_id').change(function(){
     	var val = $(this).val()
     	$.post('/goods/get_goods_sort',{businessid:val},function(data){
     		$('#sort_id').empty()
            $('#sort_id').append(data)
     	})

     })


    $('#onsubmit').click(function(){

      if($('#sort_id').val() == null){
	 	alert('请选择商品分类')
	 	return false
	 }
	 if ($('#iftitle').val() == '') {
	 	alert('请输入商品名称')
	 	return false;
	 }
	  if ($('#ifprice').val() == '') {
	 	alert('请输入商品价格')
	 	return false;
	 }
	   if (typeof($(".tpimg").val())=='undefined') {alert('请 Upload 图片');return false;}
	  if ($('#ifintroduce').val() == '') {
	 	alert('请输入商品简介')
	 	return false;
	 }

    })


</script>


