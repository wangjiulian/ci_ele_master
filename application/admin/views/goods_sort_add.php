<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>新增商品分类<!-- <small>Optional description</small> --></h1>
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
				 				<option value="<?=$lv['id'] . '##' . $lv['name']?>"><?=$lv['name']?></option>
				 		<?php	}?>


				 		</select>
				 	</div>
				 	<div class="form-group">
				 		<label><span style="color: red">* </span>名称</label><br>
				 		<input type="" class="form-control" name="iftitle" id="iftitle" placeholder="请输入分类名称">
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

 //    $(document).ready(function(){
 //    $.post('/goods_sort/bussniess_info',{},function(data){
 // 	 $('#business_id').append(data)
 // })

    })

    $('#onsubmit').click(function(){

	 if ($('#iftitle').val() == '') {
	 	alert('请输入分类名称')
	 	return false;
	 }
    })


</script>


