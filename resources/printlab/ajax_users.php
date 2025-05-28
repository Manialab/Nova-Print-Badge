<?php
session_set_cookie_params(7200);
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'class/class.php';
$data = new Data();
$resulty  = array();
if(isset($_POST['action'])){
  $action = $_POST['action'];
  if($action == 'changestatus'){
      if (isset($_POST['userid'])  && isset($_POST['value'])) {
        $userid = (int)$_POST['userid'];
        $value = $_POST['value'];
        $stmt = $data->runQuery("UPDATE users SET user_status=:user_status where user_id=:user_id");
          $stmt->execute(array(":user_id"=>$userid,":user_status"=>$value,));
          $resulty['resp']=1;
          $resulty['msg']="User Status updated!";
      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
  }else if($action == 'searchSeatweb'){
       if (isset($_POST['token'])  && isset($_POST['token'])) {
            $value = $_POST['token'];
            $stmt = $data->runQuery("SELECT * FROM visitors WHERE token=:seatval LIMIT 1");
            $stmt->execute(array(":seatval" => $value));
            $rowq = $stmt->fetch(PDO::FETCH_OBJ);
            if ($stmt->rowCount() > 0) {
                $resulty['info'] = $rowq;
                $resulty['token'] = $rowq->token;
                $resulty['success'] = true;
                $resulty['status'] = 1;
            } else {
                $resulty['msg'] = "Token Not Found";
                $resulty['success'] = false;
                $resulty['status'] = 2;
            }
        } else {
            $resulty['msg'] = "Token Not Exist";
            $resulty['success'] = false;
            $resulty['status'] = 2;
        }
	}else if($action == 'changestatusadmin'){
	  if (isset($_POST['userid'])  && isset($_POST['value'])) {
        $userid = (int)$_POST['userid'];
        $value = $_POST['value'];
        $stmt = $data->runQuery("UPDATE admins SET ad_status=:user_status where admin_id=:user_id");
          $stmt->execute(array(":user_id"=>$userid,":user_status"=>$value,));
          $resulty['resp']=1;
          $resulty['msg']="تم تحديث حالة المستخدم";
      }else{
        $resulty['resp']=2;
        $resulty['msg']="البيانات مفقودة!";
      }
  }else if($action == 'delete'){
        if (isset($_POST['userid'])) {
            $userid = (int)$_POST['userid'];
            $stmt = $data->runQuery("UPDATE users SET user_deleted=1 where user_id=:user_id");
            $stmt->execute(array(":user_id"=>$userid,));
            $resulty['resp']=1;
            $resulty['msg']="User Deleted!";
        }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
        }
  }else if($action == 'deleteuser'){
	if (isset($_POST['userid'])) {
		$userid = (int)$_POST['userid'];
		$stmt = $data->runQuery("delete from users  where user_id=:user_id");
		$stmt->execute(array(":user_id"=>$userid,));
		$resulty['resp']=1;
		$resulty['msg']="User Deleted!";
	}else{
	  $resulty['resp']=2;
	  $resulty['msg']="data is missing!";
	}
}else if($action == 'deleteticketarea'){
     if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $stmt = $data->runQuery("Delete from area_tickets where att_id=:id");
        $stmt->execute(array(":id"=>$id,));
        $resulty['resp']=1;
        $resulty['msg']="Ticket Deleted!";
      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
  }
	}else if($action == 'deletephoto'){
        if (isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $stmt = $data->runQuery("Delete from photos where photo_id=:pb_id");
            $stmt->execute(array(":pb_id"=>$id));
            $resulty['resp']=1;
            $resulty['msg']="Photo Deleted!";
        }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
        }
	}else if($action == 'deleteadmin'){
        if (isset($_POST['userid'])) {
            $userid = (int)$_POST['userid'];
            $stmt = $data->runQuery("Delete from admins where admin_id=:user_id");
            $stmt->execute(array(":user_id"=>$userid,));
            $resulty['resp']=1;
            $resulty['msg']="User Deleted!";
        }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
        }
	}else if($action == 'deletetype'){
        if (isset($_POST['userid'])) {
            $userid = (int)$_POST['userid'];
            $stmt = $data->runQuery("Delete from users_types where ut_id=:user_id");
            $stmt->execute(array(":user_id"=>$userid,));
            $resulty['resp']=1;
            $resulty['msg']="Type Deleted!";
        }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
        }
  }else if($action == 'searchticket'){
		if (isset($_POST['searchval'])) {
			$searchval = $_POST['searchval'];
			$typesdropd = $_POST['typesdropd'];
			if($typesdropd == "vip" || $typesdropd == "vvip" || $typesdropd == "participant"  || $typesdropd == "exhibitor"  || $typesdropd == "organizer"){
			    $stmt = $data->runQuery("SELECT * FROM confirmed_invitees where token_key=:searchval");
			    $stmt->execute(array(":searchval"=>$searchval));
			    $rowq= $stmt->fetchAll();
			    if($stmt->rowCount() > 0){
    			    $userid=$rowq[0]['id'];
    			    $usertokenn=$rowq[0]['token_key'];
    			    $last_name=$rowq[0]['name'];
    			    $username=$last_name;
    			    $company=$rowq[0]['side'];
    			    $positionn=$rowq[0]['position'];
    				$resulty['haveval']=1;
    				$resulty['name']=$username;
    				$resulty['token']=$usertokenn;
    				$resulty['userid']=$userid;
    				$resulty['company']=$company;
    				$resulty['position']=$positionn;
    				$resulty['data']=$rowq;
    			}else{
    				$resulty['haveval']=0;
    			}
    			
			}else if($typesdropd == "registrant" ){
			      $stmt = $data->runQuery("SELECT * FROM registrants where token_key=:searchval");
			    $stmt->execute(array(":searchval"=>$searchval));
			    $rowq= $stmt->fetchAll();
			    if($stmt->rowCount() > 0){
    			    $firstusername=$rowq[0]['first_name'];
    			    $userid=$rowq[0]['id'];
    			    $usertokenn=$rowq[0]['token_key'];
    			    $last_name=$rowq[0]['last_name'];
    			    $username= $firstusername." ".$last_name;
    			    $company=$rowq[0]['company'];
			    
    				$resulty['haveval']=1;
    				$resulty['name']=$username;
    				$resulty['token']=$usertokenn;
    				$resulty['userid']=$userid;
    				$resulty['company']=$company;
    				$resulty['position']="Registrant";
    				$resulty['data']=$rowq;
    			}else{
    				$resulty['haveval']=0;
    			}
			}
		
          $resulty['resp']=1;
      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
	}else if($action == 'searchqrcode'){
		if (isset($_POST['searchval'])) {
			$searchval = $_POST['searchval'];
			$stmt = $data->runQuery("SELECT * FROM users u inner join users_types us on us.ut_id=u.user_typeid inner join countries cn on cn.country_id=u.user_country where u.token=:searchval");
			$stmt->execute(array(":searchval"=>$searchval));
			$rowq= $stmt->fetchAll();
			if($stmt->rowCount() > 0){
				$resulty['haveval']=1;
				$resulty['data']=$rowq;
			}else{
				$resulty['haveval']=0;
			}
          $resulty['resp']=1;
      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
	}else if($action == 'approveticket'){
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
			$stmt = $data->runQuery("SELECT * FROM users where user_id=:userid");
			$stmt->execute(array(":userid"=>$userid));
			$rowq= $stmt->fetchAll();
			if($stmt->rowCount() > 0){
				$stmt = $data->runQuery("UPDATE users SET user_ticketvalidity=1 where user_id=:user_id");
				$stmt->execute(array(":user_id"=>$userid));
				$resulty['resp']=1;
			}else{
				$resulty['resp']=2;
				$resulty['msg']="User not found!";
			}

      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
	 }else if($action == 'savepermissions'){
		if (isset($_POST['typeid'])) {
			extract($_POST);
			$stmt = $data->runQuery("Delete from permissions_roles where pr_typeid=:pr_typeid");
            $stmt->execute(array(":pr_typeid"=>$typeid));
			$pagesnamepl = array("admins", "userstypes", "permissions", "configurations","ticketchecker","users","companies","photobooth");
			foreach ($pagesnamepl as $apageact) {
					$sadd = ${"add_".$apageact};
					$sedit = ${"edit_".$apageact};
					$sdelete = ${"delete_".$apageact};
					$sexport = ${"export_".$apageact};
					$sprint = ${"print_".$apageact};
					$sview = ${"view_".$apageact};
				$stmt = $data->runQuery("INSERT INTO permissions_roles (pr_typeid,pr_pagename,pr_add,pr_edit,pr_delete,pr_print,pr_export,pr_view)
				VALUES (:pr_typeid,:apageact,:sadd,:sedit,:sdelete,:sprint,:sexport,:sview)");
				$stmt->execute(array(
				":pr_typeid"=>$typeid,
				":apageact"=>$apageact,
				":sadd"=>$sadd,
				":sedit"=>$sedit,
				":sdelete"=>$sdelete,
				":sprint"=>$sprint,
				":sexport"=>$sexport,
				":sview"=>$sview));
			}
			$resulty['resp']=1;

			/*
			$stmt = $data->runQuery("SELECT * FROM users where user_id=:userid");
			$stmt->execute(array(":userid"=>$userid));
			$rowq= $stmt->fetchAll();
			if($stmt->rowCount() > 0){
				$stmt = $data->runQuery("UPDATE users SET user_ticketvalidity=1 where user_id=:user_id");
				$stmt->execute(array(":user_id"=>$userid));
				$resulty['resp']=1;
			}else{
				$resulty['resp']=2;
				$resulty['msg']="User not found!";
			}
          */

      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
	}else if($action == 'printticket'){
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
    		$codeticket=$_POST['codeticket'];
			$usertype=$_POST['usertype'];
			$stmt = $data->runQuery("INSERT INTO printing (print_token,print_userid) VALUES (:ticketcode,:print_userid)");
			$stmt->execute(array(":ticketcode"=>$codeticket,":print_userid"=>$userid));
// 			$stmt = $data->runQuery("UPDATE visitors SET print=1 where id=:emp_id");
// 			$stmt->execute(array(":emp_id"=>$userid));
			$resulty['resp']=1;
        }else{
            $resulty['resp']=2;
            $resulty['msg']="data is missing!";
        }
	}else if($action == 'printemployee'){
		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
			$stmt = $data->runQuery("SELECT * FROM employees where emp_id=:emp_id");
			$stmt->execute(array(":emp_id"=>$userid));
			$rowq= $stmt->fetchAll();
			if($stmt->rowCount() > 0){
        $stmt = $data->runQuery("UPDATE employees SET emp_downloaded=1 where emp_id=:emp_id");
				$stmt->execute(array(":emp_id"=>$userid));
				$resulty['resp']=1;
			}else{
				$resulty['resp']=2;
				$resulty['msg']="Employee not found!";
			}

      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
	}else if($action == 'savebadgeinfo'){
		
		if (isset($_POST['typeid'])) {
			$typeid = $_POST['typeid'];
			$ttbagdeheightmm = $_POST['ttbagdeheightmm'];
			$ttbagdewidthmm = $_POST['ttbagdewidthmm'];
			$ttcheckname = $_POST['ttcheckname'];
			$ttfontsize = $_POST['ttfontsize'];
			$ttcheckcountry = $_POST['ttcheckcountry'];
			$ttcheckcompany = $_POST['ttcheckcompany'];
			$ttcheckposition = $_POST['ttcheckposition'];
			$ttchecktype = $_POST['ttchecktype'];
			$ttcheckbarcode = $_POST['ttcheckbarcode'];

			$ttrotatename =$_POST['ttrotatename'];
			$ttrotatetype =$_POST['ttrotatetype'];
			$ttrotatecountry =$_POST['ttrotatecountry'];
			$ttrotatecompany =$_POST['ttrotatecompany'];
			$ttrotateposition =$_POST['ttrotateposition'];
			

			$ttnameboxdplace = $_POST['ttnameboxdplace'];
			$ttcountryboxdplace = $_POST['ttcountryboxdplace'];
			$ttcompanyboxdplace = $_POST['ttcompanyboxdplace'];
			$ttpositionboxdplace = $_POST['ttpositionboxdplace'];
			$tttypeboxdplace = $_POST['tttypeboxdplace'];
			$ttbarcodeboxdplace = $_POST['ttbarcodeboxdplace'];


			$ttcheckprofile = $_POST['ttcheckprofile'];
			$ttprofileboxdplace = $_POST['ttprofileboxdplace'];
			$ttprofilexboxdplace = $_POST['ttprofilexboxdplace'];
			$ttprofilexboxdwidth = $_POST['ttprofilexboxdwidth'];

			$ttnamexboxdplace = $_POST['ttnamexboxdplace'];
			$ttcountryxboxdplace = $_POST['ttcountryxboxdplace'];
			$ttcompanyxboxdplace = $_POST['ttcompanyxboxdplace'];
			$ttpositionxboxdplace = $_POST['ttpositionxboxdplace'];
			$tttypexboxdplace = $_POST['tttypexboxdplace'];
			$ttbarcodexboxdplace = $_POST['ttbarcodexboxdplace'];
			$tttypefont = $_POST['tttypefont'];

			$ttcompanyfont = $_POST['ttcompanyfont'];
			$ttpositionfont = $_POST['ttpositionfont'];
			$tttick_type = $_POST['tttick_type'];
			$ttqrxboxdwidth = $_POST['ttqrxboxdwidth'];
			$ttbagdemarginmm = $_POST['ttbagdemarginmm'];
			$ttdbcolor = $_POST['ttdbcolor'];


			$stmt = $data->runQuery("Delete from badges_details where bd_type_id=:bd_type_id");
			$stmt->execute(array(":bd_type_id"=>$typeid));

			
			$stmta = $data->runQuery("INSERT INTO badges_details (
			bd_type_id,
			bd_width,
			bd_height,
			bd_name_show,
			bd_name_position,
			bd_country_show,
			bd_country_position,
			bd_company_show,
			bd_company_position,
			bd_position_show,
			bd_position_position,
			bd_type_show,
			bd_type_position,
			bd_code_show,
			bd_code_position,
			bd_name_positionx,
			bd_country_positionx,
			bd_company_positionx,
			bd_position_positionx,
			bd_type_positionx,
			bd_code_positionx,
			bd_profile_show,
			bd_profile_position,
			bd_profile_positionx,
			bd_profile_width,
			s_font,
			bd_rotatename,
			db_rotatetype,
			db_rotatecountry,
			db_rotatecompany,
			db_rotatposition,
			companyfont,
			positionfont,
			tick_type,
			bd_qr_width,
			bd_margin,
			typefont,
			db_color) VALUES
			(
			:typeid,
			:ttbagdewidthmm,
			:ttbagdeheightmm,
			:ttcheckname,
			:ttnameboxdplace,
			:ttcheckcountry,
			:ttcountryboxdplace,
			:ttcheckcompany,
			:ttcompanyboxdplace,
			:ttcheckposition,
			:ttpositionboxdplace,
			:ttchecktype,
			:tttypeboxdplace,
			:ttcheckbarcode,
			:ttbarcodeboxdplace,
			:ttnamexboxdplace,
			:ttcountryxboxdplace,
			:ttcompanyxboxdplace,
			:ttpositionxboxdplace,
			:tttypexboxdplace,
			:ttbarcodexboxdplace,
			:ttcheckprofile,
			:ttprofileboxdplace,
			:ttprofilexboxdplace,
			:ttprofilexboxdwidth,
			:ttfontsize,
			:ttrotatename,
			:ttrotatetype,
			:ttrotatecountry,
			:ttrotatecompany,
			:ttrotateposition,
			:ttcompanyfont,
			:ttpositionfont,
			:tttick_type,
			:ttqrxboxdwidth,
			:ttbagdemarginmm,
			:tttypefont,
			:ttdbcolor		
			)");


			$stmta->execute(array(
			":typeid"=>$typeid,
			":ttbagdewidthmm"=>$ttbagdewidthmm,
			":ttbagdeheightmm"=>$ttbagdeheightmm,
			":ttcheckname"=>$ttcheckname,
			":ttcheckcountry"=>$ttcheckcountry,
			":ttcheckcompany"=>$ttcheckcompany,
			":ttcheckposition"=>$ttcheckposition,
			":ttchecktype"=>$ttchecktype,
			":ttcheckbarcode"=>$ttcheckbarcode,
			":ttnameboxdplace"=>$ttnameboxdplace,
			":ttcountryboxdplace"=>$ttcountryboxdplace,
			":ttcompanyboxdplace"=>$ttcompanyboxdplace,
			":ttpositionboxdplace"=>$ttpositionboxdplace,
			":tttypeboxdplace"=>$tttypeboxdplace,
			":ttbarcodeboxdplace"=>$ttbarcodeboxdplace,
			":ttnamexboxdplace"=>$ttnamexboxdplace,
			":ttcountryxboxdplace"=>$ttcountryxboxdplace,
			":ttcompanyxboxdplace"=>$ttcompanyxboxdplace,
			":ttpositionxboxdplace"=>$ttpositionxboxdplace,
			":tttypexboxdplace"=>$tttypexboxdplace,
			":ttbarcodexboxdplace"=>$ttbarcodexboxdplace,
			":ttcheckprofile"=>$ttcheckprofile,
			":ttprofileboxdplace"=>$ttprofileboxdplace,
			":ttprofilexboxdplace"=>$ttprofilexboxdplace,
			":ttprofilexboxdwidth"=>$ttprofilexboxdwidth,
			":ttfontsize"=>$ttfontsize,
			":ttrotatename"=>$ttrotatename,
			":ttrotatetype"=>$ttrotatetype,
			":ttrotatecountry"=>$ttrotatecountry,
			":ttrotatecompany"=>$ttrotatecompany,
			":ttrotateposition"=>$ttrotateposition,
			":ttcompanyfont"=>$ttcompanyfont,
			":ttpositionfont"=>$ttpositionfont,
			":tttick_type"=>$tttick_type,
			":ttqrxboxdwidth"=>$ttqrxboxdwidth,
			":ttbagdemarginmm"=>$ttbagdemarginmm,
			":tttypefont"=>$tttypefont,
			":ttdbcolor"=>$ttdbcolor	
			));
			
			$resulty['resp']=1;
			$resulty['msg']="تم الحفظ";
      }else{
        $resulty['resp']=2;
        $resulty['msg']="data is missing!";
      }
  }else if($action == 'getuser'){
      if (isset($_POST['userid'])) {
          $userid = (int)$_POST['userid'];
          $stmt = $data->runQuery("SELECT * FROM users u inner join users_types us on us.ut_id=u.user_typeid inner join countries cn on cn.country_id=u.user_country where u.user_id=:user_id");
          $stmt->execute(array(":user_id"=>$userid));
          $rowq= $stmt->fetchAll();
          if($stmt->rowCount() > 0){
              $data=$rowq;
              $resulty['data']=$data;
              $resulty['resp']=1;
          }else{
            $resulty['msg']="User not found!";
            $resulty['resp']=2;
          }
          $resulty['msg']="User Status updated!";
      }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
      }
  }else if($action == 'getcompany'){
      if (isset($_POST['userid'])) {
          $userid = (int)$_POST['userid'];
          $stmt = $data->runQuery("SELECT * FROM company where comp_id=:comp_id");
          $stmt->execute(array(":comp_id"=>$userid));
          $rowq= $stmt->fetchAll();
          if($stmt->rowCount() > 0){
              $data=$rowq;
              $resulty['data']=$data;
              $resulty['resp']=1;
          }else{
              $resulty['msg']="Company not found!";
              $resulty['resp']=2;
          }
      }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
      }
	}else if($action == 'getadmin'){
      if (isset($_POST['userid'])) {
          $userid = (int)$_POST['userid'];
          $stmt = $data->runQuery("SELECT * FROM admins inner join users_types on admins.ad_type = users_types.ut_id where admins.admin_id=:user_id");
          $stmt->execute(array(":user_id"=>$userid));
          $rowq= $stmt->fetchAll();
          if($stmt->rowCount() > 0){
              $data=$rowq;
              $resulty['data']=$data;
              $resulty['resp']=1;
          }else{
            $resulty['msg']="User not found!";
            $resulty['resp']=2;
          }
      }else{
          $resulty['resp']=2;
          $resulty['msg']="data is missing!";
      }
  }

}else{
  $resulty['resp']=2;
  $resulty['msg']="action is missing!";
}
echo json_encode($resulty);
?>
