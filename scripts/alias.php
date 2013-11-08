<?php
	
	function template(){
		
		return BM::singleton()->getObject('temp');
		
	}
	
	function page(){
		
		return BM::singleton()->getObject('temp')->getPage();
		
	}
	
	function data_model(){
		
		return BM::singleton()->getObject('db');
		
	}
	
	function set_type($data){
		
		$data = (is_string($data)) ? data_model()->sanitizeData($data):$data;
		$val = (is_string($data)) ? "'$data'":$data;
		return $val; 
		
	}

	function _updatedata($object,$tblname=''){
		header('Content-type:text/javascript;charset=UTF-8');
		$tblname = addslashes($tblname);
    $json=json_decode(stripslashes($_POST["_gt_json"]));
    if($json->{'action'} == 'save'):
      $sql = "";
      $params = array();
      $errors = "";
  
      //deal with those deleted
      $deletedRecords = $json->{'deletedRecords'};
      foreach ($deletedRecords as $value):
        $id = $object->model->get_child($tblname)->getId();
        $object->model->get_child($tblname)->delete($value->$id,$id);
      endforeach;
  
      //deal with those updated
      $updatedRecords = $json->{'updatedRecords'};
      foreach ($updatedRecords as $value):
        $id = $object->model->get_child($tblname)->getId();
        $data = get_object_vars($value);
        $model = $object->model->get_child($tblname);
        $model->get($data[$id]);
        $model->change_status($data);
        $model->save();
      endforeach;
  
      //deal with those inserted
      $insertedRecords = $json->{'insertedRecords'};
      foreach ($insertedRecords as $value):
        $data = get_object_vars($value);
        $model = $object->model->get_child($tblname);
        $model->get($data['id']);
        $model->change_status($data);
        $model->save(); 
      endforeach;
  
      $ret = "{success : true,exception:''}";
    endif;
	}

  function _updatedata_cd($object,$tblname,$field,$val){
    header('Content-type:text/javascript;charset=UTF-8');
    $tblname = addslashes($tblname);
    $json=json_decode(stripslashes($_POST["_gt_json"]));
    if($json->{'action'} == 'save'):
      $sql = "";
      $params = array();
      $errors = "";
  
      //deal with those deleted
      $deletedRecords = $json->{'deletedRecords'};
      foreach ($deletedRecords as $value):
        $id = $object->model->get_child($tblname)->getId(); 
        $object->model->get_child($tblname)->delete($value->$id,$id);
        $h_data = array();
        $h_data['usuario'] = Session::getUser();
        $h_data['descripcion'] = "se elimina producto ".$value->$id;
        $h_data['fecha_hora'] = date("y-m-d h:m:s");
        $h_data['modulo'] = "inventario";
        $historial = $object->model->get_child('historial');
        $historial->get(0);
        $historial->change_status($h_data);
        $historial->save();
      endforeach;
  
      //deal with those updated
      $updatedRecords = $json->{'updatedRecords'};
      foreach ($updatedRecords as $value):
        $data = get_object_vars($value);
        $id = $object->model->get_child($tblname)->getId();
        $model = $object->model->get_child($tblname);
        $model->get($data[$id]);
        $model->change_status($data);
        $model->save();
        $h_data = array();
        $h_data['usuario'] = Session::getUser();
        $h_data['descripcion'] = "se actualiza producto ".$data['estilo'];
        $h_data['fecha_hora'] = date("y-m-d h:m:s");
        $h_data['modulo'] = "inventario";
        $historial = $object->model->get_child('historial');
        $historial->get(0);
        $historial->change_status($h_data);
        $historial->save();
      endforeach;
  
      //deal with those inserted
      $insertedRecords = $json->{'insertedRecords'};
      foreach ($insertedRecords as $value):
        $data = get_object_vars($value);
        $model = $object->model->get_child($tblname);
        $model->get($data['id']);
        $data[$field] = $val;
        $model->change_status($data);
        $model->save();
        $h_data = array();
        $h_data['usuario'] = Session::getUser();
        $h_data['descripcion'] = "se inserta producto ".$data['estilo'];
        $h_data['fecha_hora'] = date("y-m-d h:m:s");
        $h_data['modulo'] = "inventario";
        $historial = $object->model->get_child('historial');
        $historial->get(0);
        $historial->change_status($h_data);
        $historial->save(); 
      endforeach;
  
      $ret = "{success : true,exception:''}";
      echo $ret;
    endif;
  }

	function _loaddata($tblname=''){
		header('Content-type:text/javascript;charset=UTF-8');
		$tblname = addslashes($tblname);
    $json=json_decode(stripslashes($_POST["_gt_json"]));
    $pageNo = $json->{'pageInfo'}->{'pageNum'};
    $pageSize = 10;//10 rows per page

    //to get how many records totally.
    $sql = "select count(*) as cnt from $tblname";
    $handle = mysql_query($sql);
    $row = mysql_fetch_object($handle);
    $totalRec = $row->cnt;

    //make sure pageNo is inbound
    if($pageNo<1||$pageNo>ceil(($totalRec/$pageSize))):
      $pageNo = 1;
    endif;

    if($json->{'action'} == 'load'):
      $sql = "select * from $tblname limit " . ($pageNo - 1)*$pageSize . ", " . $pageSize;
      $handle = mysql_query($sql);
      $retArray = array();
      while ($row = mysql_fetch_object($handle)):
        $retArray[] = $row;
      endwhile;
      $data = json_encode($retArray);
      $ret = "{data:" . $data .",\n";
      $ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
      $ret .= "recordType : 'object'}";
      echo $ret;
    endif;
	}

  function _loaddata_cf($tblname='',$field,$value){
    header('Content-type:text/javascript;charset=UTF-8');
    $tblname = addslashes($tblname);
    $json=json_decode(stripslashes($_POST["_gt_json"]));
    $pageNo = $json->{'pageInfo'}->{'pageNum'};
    $pageSize = 10;//10 rows per page

    //to get how many records totally.
    $sql = "select count(*) as cnt from $tblname WHERE {$field} = '{$value}' AND visible=0";
    $handle = mysql_query($sql);
    $row = mysql_fetch_object($handle);
    $totalRec = $row->cnt;

    //make sure pageNo is inbound
    if($pageNo<1||$pageNo>ceil(($totalRec/$pageSize))):
      $pageNo = 1;
    endif;

    if($json->{'action'} == 'load'):
      $sql = "select * from $tblname WHERE {$field} = '{$value}' AND visible=0 limit " . ($pageNo - 1)*$pageSize . ", " . $pageSize;
      $handle = mysql_query($sql);
      $retArray = array();
      while ($row = mysql_fetch_object($handle)):
        $retArray[] = $row;
      endwhile;
      $data = json_encode($retArray);
      $ret = "{data:" . $data .",\n";
      $ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
      $ret .= "recordType : 'object'}";
      echo $ret;
    endif;
  }

  function pagina_simple($rutaHtml,$titulo='',$menu=''){
    template()->buildFromTemplates('template.html');
    page()->setTitle($titulo);
    page()->addEstigma("menu",$menu);
    template()->addTemplateBit('content',$rutaHtml);
    template()->addTemplateBit('footer','footer.html');
    template()->parseOutput();
    template()->parseExtras();
    print page()->getContent();
  }

  function alert($str){
    echo '<script type="text/javascript">alert("'.$str.'");</script>';
  }

  function upload_image($destination_dir,$name_media_field,$productid){
        $tmp_name = $_FILES[$name_media_field]['tmp_name']; 
        if ( is_dir($destination_dir) && is_uploaded_file($tmp_name))
        {      
            $img_file  = 'thumbnail_'.$productid;                      
            $img_type  = $_FILES[$name_media_field]['type'];            
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type,"jpg")) || strpos($img_type,"png") ))
            {
                if(move_uploaded_file($tmp_name, $destination_dir.'/'.$img_file))
                {                
                    return true;
                }
            }
        }
        return false;
    }

?>