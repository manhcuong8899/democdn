<?php


function cate_parent($data, $parent = 0, $str = "----|", $select = 0)
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        if ($val['parent_id'] == $parent) {
            if (old('parentid') == $id) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else if ($select != 0 && $id == $select) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            cate_parent($data, $id, $str . "----|", $select);
        }
    }
}

function showCategories($categories,$parent_id = 0)
{

    foreach ($categories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id) {
            $status = $item['status'] == 1 ? "Hiển thị" : "Ẩn";
            echo '<tr>';
            echo '<td width="3%"><input type="checkbox" name="check[]" id="check" class="mycheckbox" value=' . $item['id'] . '/></td>';
            echo '<td><b>#'.$item['id'].'</b></td>';
            echo '<td>'.$item['name'].'</td>';
            echo '<td align="center"><input type="text" name="order[' . $item['id'] . ']" id="order" class="order" value=' . $item['order'] . ' style="width:35px;"></td>';
            echo '<td width="15%">'.$status.'</td>';
            echo '<td align="center" width="25%">
                   <a href='.url('admin/cate/edit/'.$item['group'].'/'.$item['id']).' data-toggle="tooltip" title='.trans('VNPCMS.forms.titles.edit').' class="btn btn-xs btn-default btn-flat"><i class="fa fa-edit text-blue"></i></a>

                     <a data-orderurl='.url('admin/menu/edit/'.$item['group'].'/'.$item['id']).' class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#Addmenu">
                                                    <i class="fa fa-plus text-blue"></i> Gán menu</a>

                    <button type="button" data-cateid='.$item['id'].' data-catename='.$item['name'].' data-catedeleteurl='.url('admin/cate/delete/'.$item['id']).' class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#confirmCateDelete"><i class="fa fa-trash text-red" data-toggle="tooltip" title='.trans('VNPCMS.forms.titles.delete').'></i></button>
                    </td>';
            echo '</tr>';
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item['id']);
        }
    }
}

function function_add($data, $parent = 0, $str = "--|", $select = 0)
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $code = $val['code'];
        if ($val['parent_id'] == $parent) {
            if (old('parentid') == $id) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else if ($select != 0 && $id == $select) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            cate_parent($data, $id, $str . "--|", $select);
        }
    }
}

function product_categories($data, $parent = 0, $str = "----|", $product = '')
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $ds = $product->cate_id;
        $arr[] = $product->cate_id;
        if ($val['parent_id'] == $parent) {
            if (old('categories') == $id) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else if (isset($arr) && in_array($id, $arr)) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            product_categories($data, $id, $str . "----|", $product);
        }
    }
}

/* Hàm hiển thị các danh mục đã gán vào vào thuộc tính */
function categories_properties($data, $parent = 0, $str = "---|", $mode = '')
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $ds = $mode->properties_id;
        if (!empty($ds)) {
            $list = json_decode($ds);
            if (count($list)) {
                foreach ($list as $key => $value) {
                    $arr[] = $value;
                }
            }
        }
        if ($val['parent_id'] == $parent) {
            if (old('categories') == $id) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else if (isset($arr) && in_array($id, $arr)) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            categories_properties($data, $id, $str . "----|", $mode);
        }
    }
}

/* Hàm hiển thị các danh mục đã gán vào vào mã khuyến mãi */
function categories_coupons($data, $parent = 0, $str = "---|", $coupon = '')
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $ds = $coupon->group_cate;
        if (!empty($ds)) {
            $list = json_decode($ds);
            if (count($list)) {
                foreach ($list as $key => $value) {
                    $arr[] = $value;
                }
            }
        }
        if ($val['parent_id'] == $parent) {
            if (old('categories') == $id) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else if (isset($arr) && in_array($id, $arr)) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            categories_coupons($data, $id, $str . "----|", $coupon);
        }
    }
}


/* Hàm hiển thị các sản phẩm đã gán vào vào mã khuyến mãi */
function products_coupons($data,$coupon)
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $ds = $coupon->group_product;
        if (!empty($ds)) {
            $list = json_decode($ds);
            if (count($list)) {
                foreach ($list as $key => $value){
                    $arr[] = $value;
                }
            }
        }
             if(in_array($id,$arr)){
                echo "<option value='$id' selected='selected'>$name</option>";
            }else {
                echo "<option value='$id'>$name</option>";
            }
    }
}

/* Hàm hiển thị các danh mục đã gán vào chế độ */
function mode_categories($data, $parent = 0, $str = "---|", $mode = '')
{
    foreach ($data as $val) {
        $id = $val['id'];
        $name = $val['name'];
        $ds = $mode->mode;
        if (!empty($ds)) {
            $list = json_decode($ds);
            if (count($list)) {
                foreach ($list as $key => $value) {
                    $arr[] = $value;
                }
            }
        }
        if ($val['parent_id'] == $parent) {
            if (old('categories') == $id) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else if (isset($arr) && in_array($id, $arr)) {
                echo "<option value='$id' selected='selected'>$str $name</option>";
            } else {
                echo "<option value='$id'>$str $name</option>";
            }
            mode_categories($data, $id, $str . "----|", $mode);
        }
    }
}

function Menus()
{
    return \VNPCMS\Catearticle\CateArticles::where('group','menus')->get();
}
function categories()
{
    return \App\Models\Linktype::where('status','1')->orderBy('order','asc')->get();
}
function articles()
{
    return \App\Models\Linktype::where('status','1')->where('category','1')->orderBy('order','asc')->get();
}
?>