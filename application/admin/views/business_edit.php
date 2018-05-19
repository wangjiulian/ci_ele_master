<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>新增商家<!-- <small>Optional description</small> --></h1>
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
                        <input type="" value="<?=$target['name']?>" class="form-control" name="iftitle" id="iftitle" placeholder="请输入商家名">
                    </div>
                    <div class="form-group">
                        <label><span style="color: red">* </span>图片地址</label><br>
                        <input type="" value="<?=$target['img_cover']?>" class="form-control" name="ifimgurl" id="ifimgurl" placeholder="请输入商家背景图">
                    </div>
                    <div class="form-group">
                        <label><span style="color: red">* </span>类别</label><br>
                        <?php $i = 0;foreach ($sort as $key => $value) {$i++;?>
                           <input  type="radio" <?php if ($key == $target['sort_id']) {?> checked <?php }?> value="<?=$key?>" id='sort_type' name="sort_type">&nbsp;&nbsp;<?=$value?></input>&nbsp;&nbsp;
                           <?php if ($i % 10 == 0) {?> <br><br> <?php }?>
                        <?php }?>

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


