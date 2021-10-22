<?php
if (!function_exists('show_status_page')) {
    function show_status_page($status)
    {
        $array_data = array(
            'active' => '<span class="badge badge-success">Kích hoạt</span>',
            'inactive' => '<span class="badge badge-secondary">Vô hiệu hóa</span>'
        );
        if (array_key_exists($status, $array_data)) {
            return $array_data[$status];
        }
    }
}

//! FILE
if (!function_exists('create_images')) {
    function create_images($path_image, $name_image, $arr_images)
    {
        // dd($arr_images);
        // Tạo folder mới nếu chưa có chỗ lưu
        if (!file_exists($path_image)) {
            mkdir($path_image, 0777, true);
        }

        // ! Tạo ảnh mới
        $newImageName = time() . '-' . $name_image . '.' . $arr_images->extension();
        // upload file into folder
        $arr_images->move($path_image, $newImageName);

        // Trả về tên hình ảnh vừa upload để lấy cập nhật vô database
        return $newImageName;
    }
}
if (!function_exists('remove_images')) {
    function remove_images($name_image, $path_image)
    {
        // * Chỉ loại bỏ khi có ảnh trong database != null
        if ($name_image != null) {
            // check nếu đúng file thì loại nó ra khỏi local
            if (File::exists($path_image . $name_image)) {
                unlink($path_image . $name_image);
            }
        }
    }
}

//! PHONE
if (!function_exists('show_phone_number')) {
    function show_phone_number($phone)
    {
        //  Mặc định xử lý ở đây là 10 số
        $phone_number = sprintf(
            "%s-%s-%s",
            substr($phone, 0, 4),
            substr($phone, 4, 3),
            substr($phone, 7, 3)
        );
        return $phone_number;
    }
}
if (!function_exists('redirect_follow_status')) {
    function redirect_follow_status($arr_status, $link_redirect)
    {
        if (in_array('active', $arr_status)) {
            return $link_redirect . '?status=active';
        } else if (in_array('inactive', $arr_status)) {
            return $link_redirect . '?status=inactive';
        } else if (in_array('trash', $arr_status)) {
            return $link_redirect . '?status=trash';
        } else {
            return $link_redirect . '?status=active';
        }
    }
}

if (!function_exists('show_status_bg')) {
    function show_status_bg($status)
    {
        $list_session = array(
            'status_invalid' => 'alert-danger',
            'status' => 'alert-success'
        );
        if (array_key_exists($status, $list_session)) {
            return $list_session[$status];
        }
    }
}

if (!function_exists('show_html_status_find')) {
    function show_html_status_find()
    {
        $html = '<p class="bg-info text-white p-2 mb-0">Không bản ghi nào được tìm thấy</p>';
        return $html;
    }
}

if (!function_exists('show_array')) {
    function show_array($array)
    {
        if (is_array($array)) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        } else {
            echo "Không phải 1 mảng nên không thể show_array";
        }
    }
}

if (!function_exists('show_gender')) {
    function show_gender($gender)
    {
        $array_gender = array(
            'male' => 'Nam',
            'female' => 'Nữ'
        );
        if (array_key_exists($gender, $array_gender)) {
            return $array_gender[$gender];
        }
    }
}

if (!function_exists('check_gender_is_male')) {
    function check_gender_is_male($gender)
    {
        if ($gender == "male")
            return true;
    }
}

if (!function_exists('show_string_avatar')) {
    function show_string_avatar($gender)
    {
        if (check_gender_is_male($gender)) {
            return "admin/images/user/avatar-2-removebg-preview.png";
        } else {
            return "admin/images/user/avatar-1-removebg-preview.png";
        }
    }
}

if (!function_exists('show_status_type1')) {
    function show_status_type1($status)
    {
        $array_data = array(
            'active' => '<span class="badge badge-success">Kích hoạt</span>',
            'disable' => '<span class="badge badge-secondary">Vô hiệu</span>'
        );
        if (array_key_exists($status, $array_data)) {
            return $array_data[$status];
        }
    }
}

if (!function_exists('show_status_user_1')) {
    function show_status_user_1($status)
    {
        $array_data = array(
            'active' =>
                '<div class="status dropdown action-label">
			<a class="text-white rounded label theme-bg f-12" href="#!">' . $status . '</a></div>',
            'inactive' =>
                '<div class="status dropdown action-label">
            <a class="label rounded theme-bg2 f-12 text-white" href="#!">' . $status . '</a>
			</div>'

        );
        if (array_key_exists($status, $array_data)) {
            return $array_data[$status];
        }
    }
}

if (!function_exists('show_status_user_current')) {
    function show_status_user_current($id)
    {
        return '<div class="switch switch-success d-inline m-r-10">
            <input type="checkbox" id="switch-s-' . $id . '" checked disabled data-id="' . $id . '">
            <label for="switch-s-' . $id . '" class="cr"></label>
            </div>';
    }
}

if (!function_exists('show_status_user')) {
    function show_status_user($status, $id)
    {
        $array_data = array(
            'active' =>
                '<div class="switch switch-success d-inline m-r-10">
            <input type="checkbox" id="switch-s-' . $id . '" checked data-id="' . $id . '">
            <label for="switch-s-' . $id . '" class="cr"></label>
            </div>',
            'inactive' =>
                '<div class="switch switch-success d-inline m-r-10">
            <input type="checkbox" id="switch-s-' . $id . '" data-id="' . $id . '">
            <label for="switch-s-' . $id . '" class="cr"></label>
            </div>'

        );
        if (array_key_exists($status, $array_data)) {
            return $array_data[$status];
        }
    }
}

if (!function_exists('data_tree')) {
    function data_tree($data, $parent_id = 0, $level = 0)
    {
        $result = [];
        foreach ($data as $item) {
            //Nếu parent_id của database == parent_id = 0 => gốc
            if ($item->parent_id == $parent_id) {
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

if (!function_exists('show_categories')) {
    function show_categories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
                unset($categories[$key]);

                show_categories($categories, $item->id, $char . '/-- ');
            }
        }
    }
}
