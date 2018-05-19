<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>编辑Menu<!-- <small>Optional description</small> --></h1>
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
				 		<label><span style="color: red">* </span>名称</label><br>
				 		<input type="" class="form-control" value="<?=$target['name']?>" name="iftitle" id="iftitle" placeholder="请输入名称">
				 	</div>
				 		<div class="form-group">
				 		<label><span style="color: red">* </span>图片地址</label><br>
				 		<input type="" class="form-control" value="<?=$target['img']?>" name="ifimgurl" id="ifimgurl" placeholder="请输入图片地址">
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

<!-- REQUIRED SCRIPT -->
<script type="text/javascript">
    $('#onsubmit').click(function(){

      if($('#iftitle').val() == ''){
         alert('请输入名称')
	 	return false;
	 }

	 if ($('#ifimgurl').val() == '') {
	 	alert('请输入图片地址')
	 	return false;
	 }
    })


</script>


