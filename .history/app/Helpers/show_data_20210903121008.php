<?php 

if(!function_exists('show_status_bg')) {
	function show_status_bg($status) {
		$list_session = array(
			'status_isvalid' => 'alert-danger',
			'status' => 'alert-success'
		);
		if(array_key_exists($status, $list_session)){
			return $list_session[$status];
		}
	}
}

if(!function_exists('show_html_status_find')) {
	function show_html_status_find() {
		$html = '<p class="bg-info text-white p-2 mb-0">Không bản ghi nào được tìm thấy</p>';
		return $html;
	}
}

if(!function_exists('show_array')) {
	function show_array($array) {
		if(is_array($array)) {
			echo "<pre>"; 
			print_r($array);
			echo "</pre>";
		}else{
			echo "Không phải 1 mảng nên không thể show_array";
		}
	}
}

if(!function_exists('show_gender')) {
	function show_gender($gender) {
		$array_gender = array(
			'male' => 'Nam',
			'female' => 'Nữ'
		);
		if(array_key_exists($gender, $array_gender)) {
			return $array_gender[$gender];
		}
	}
}

if(!function_exists('show_status_type1')) {
	function show_status_type1($status) {
		$array_data = array(
			'active' => '<span class="badge badge-success">Kích hoạt</span>',
			'disable' => '<span class="badge badge-secondary">Vô hiệu</span>'
		);
		if(array_key_exists($status, $array_data)){
			return $array_data[$status];
		}
	}
}

if(!function_exists('show_status_user')) {
	function show_status_user($status) {				 
		$array_data = array(
			'active' => 
			'<div class="status dropdown action-label">
			<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
			<i class="feather icon-stop-circle text-success mr-1"></i>'.$status.'
			</a>
			<div class="dropdown-menu" style="">			
			<a class="dropdown-item" href="#"><i class="feather icon-stop-circle text-danger mr-1"></i> Inactive</a>
			</div>
			</div>',
			'inactive' =>
			'<div class="status dropdown action-label">
			<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
			<i class="feather icon-stop-circle text-danger mr-1"></i>'.$status.'
			</a>
			<div class="dropdown-menu" style="">
			<a class="dropdown-item" href="#"><i class="feather icon-stop-circle text-success mr-1"></i> Active</a>			 
			</div>
			</div>'
			
		);
		if(array_key_exists($status, $array_data)){
			return $array_data[$status];
		}
	}
}

if(!function_exists('data_tree')) {
	function data_tree($data, $parent_id = 0, $level = 0) {
		$result = [];
		foreach ($data as $item) {
		//Nếu parent_id của databse == parent_id = 0 => gốc
			if($item->parent_id == $parent_id) {
				$item->level = $level;
				$result[] = $item;
			//khi them vao roi, thi o lan lap tiep theo se bo qua no
			// unset($data[$item['id']]);
			//nap con vao của $item ở trên vào
				$child = data_tree($data, $item->id, $level + 1);

			// gộp result lai
				$result = array_merge($result, $child);
			}
		}
		return $result;
	}
}

if(!function_exists('show_categories')) {
	function show_categories($categories, $parent_id = 0, $char = '') {
		foreach ($categories as $key => $item) {
			if($item->parent_id == $parent_id) {
				echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
				unset($categories[$key]);

				show_categories($categories, $item->id, $char.'/-- ');
			}
		}
	}

}










