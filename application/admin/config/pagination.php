<?php

/*分页配置*/
$config['per_page'] = PERPAGE;
$config['use_page_numbers'] = TRUE;
$config['num_links'] = 3;
$config['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination">';
$config['full_tag_close'] = '</ul></div>';

$config['first_link'] = _('First');
$config['first_tag_open'] = '<li class="paginate_button next" id="DataTables_Table_0_next">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = _('Last');
$config['last_tag_open'] = '<li class="paginate_button next" id="DataTables_Table_0_next">';
$config['last_tag_close'] = '</li>';

// 前页
$config['prev_link'] = _('Previous');
$config['prev_tag_open'] = '<li class="paginate_button previous" id="DataTables_Table_0_previous">';
$config['prev_tag_close'] = '</li>';

//当前页
$config['cur_tag_open'] = '<li class="paginate_button active"><a href="#" aria-controls="DataTables_Table_0" tabindex="0">';
$config['cur_tag_close'] = '</a></li>';

// 下页
$config['next_link'] = _('Next');
$config['next_tag_open'] = '<li class="paginate_button next" id="DataTables_Table_0_next">';
$config['next_tag_close'] = '</li>';

$config['num_tag_open'] = '<li class="paginate_button ">';
$config['num_tag_close'] = '</li>';
