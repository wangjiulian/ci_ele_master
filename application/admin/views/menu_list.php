<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>菜单栏<!-- <small>Optional description</small> --></h1>
  <ol class="breadcrumb"><li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li><li class="active">Here</li></ol>
</section>
<!-- Main content -->
<?php
$param[4] = $this->uri->segment('4') ?: '';

?>
<section class="content">
	<div class="row">
    <div class="col-xs-12">
    <div class="box">
    <div class="box-header"><h3 class="box-title">菜单栏</h3></div>
    <div class="box-body">
    <!-- /.box-body -->
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    <div class="row">
         <div class="col-sm-4">
             <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="<?=$key ?: '搜索'?>">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
             </form>
         </div>
         <div class="col-sm-4">
            <a href="/menu/add_info"><button style="width: 80px"  class="btn btn-block btn-primary">新增</button></a>
        </div>
    </div>


    <div class="row">
  	<div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        	<thead>
        		<tr>
        			<th  colspan="1" rowspan="1" class="align-mid-h">序号</th>
        			<th  colspan="1" rowspan="1" class="align-mid-h">名称</th>
        			<th  colspan="1" rowspan="1" class="align-mid-h">图片</th>
        			<th  colspan="1" rowspan="1" class="align-mid-h">操作</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php $i = $param[4] == '' ? 0 : ($param[4] - 1) * PERPAGE;foreach ($list as $lv) {$i++?>
        		<tr>
        			<th colspan="1" rowspan="1" class="align-mid-h"><?=$i?></th>
        			<th colspan="1" rowspan="1" class="align-mid-h"><?=$lv['name']?></th>
        			<th  class="left_thumb_imgharry"><img src="<?=$lv['img']?>"  ></th>
        		    <th><a href="/menu/edit_info/<?=$lv['id']?>"><button class="btn btn-success btn-sm">编辑</button></a></th>
        		 </tr>

        	<?php	}?>
        	</tbody>
		</table>

  	</div>
    </div>

    <!-- 分页 -->
    <div class="row" align="center"><?=$page?></div>

    </div>
    <!-- /.box -->
    </div>
	</div>


</section>
<!--  /.content-->

<!-- REQUIRED SCRIPT -->
<script type="text/javascript">
window.onload = function(){
    $('.align-mid-h').css('vertical-align','middle');
}


</script>
