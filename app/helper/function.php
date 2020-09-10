<?php

function ShowErrors($errors, $name){
    if($errors->has($name)){
        echo '<div class="alert alert-danger" role="alert">';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}

function GetCategory($data,$parent,$tab,$idSelect){
    foreach($data as $row){
        if($row->parent==$parent){
            if($row->id==$idSelect){
                echo '<option selected value="'.$row->id.'">'.$tab.$row->name.'</option>';
            }
            else{
                echo "<option value='$row->id'>".$tab.$row->name."</option>";
            }
            GetCategory($data,$row->id,$tab.'---|',$idSelect);
        }
    }
}

function ShowCategory($data,$parent,$tab){
    foreach($data as $row){
        if($row->parent==$parent){
            echo "<div class='item-menu'><span>".$tab.$row->name."</span>
                    <div class='category-fix'>
                        <a class='btn-category btn-primary' href='/admin/category/edit/".$row->id."'><i class='fa fa-edit'></i></a>
                        <a onclick='return del_category(\"$row->name\")' class='btn-category btn-danger' href='/admin/category/del/".$row->id."'><i class='fas fa-times'></i></i></a>
                           
                    </div>
                </div>";
            ShowCategory($data,$row->id,$tab.'---|');
        }
    }
}

//input $mang=$product->values   output: array('size'=>array(s,m),'color'=>array('Đỏ',Xanh)) 
function attr_values($mang){
    $result=array();
    foreach($mang as $value){
        $attr=$value->attribute->name;
        $result[$attr][]=$value->value;
    }
    return $result;
}

//get_variant
function get_combinations($arrays) {
	$result = array(array());
	foreach ($arrays as $property => $property_values) {
		$tmp = array();
		foreach ($result as $result_item) {
			foreach ($property_values as $property_value) {
				$tmp[] = array_merge($result_item, array($property => $property_value));
			}
		}
		$result = $tmp;
	}
	return $result;
}

//ckeck value
function check_value($product,$value_check){
    foreach($product->values as $value){
        if($value->id==$value_check){
            return true;
        }
    }
    return false;
}

//check variant
function check_variant($product,$array){
    foreach($product->variant as $row){
        $mang=array();
        foreach($row->values as $value ){
            $mang[]=$value->id;
        }
        if(array_diff($mang,$array)==NULL){
            return false;
        }
    }
    return true;
}

function get_price($product,$array){
    foreach($product->variant as $row){
        $mang=array();
        foreach($row->values as $value){
            $mang[]=$value->value;
        }
        if(array_diff($mang,$array)==NULL){
            if($row->price==0){
                return $product->price;
            }
            return $row->price;
        }
    }
    return $product->price;
}