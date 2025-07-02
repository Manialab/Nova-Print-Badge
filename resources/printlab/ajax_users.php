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
  if($action == 'printticket'){
     	if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
    		$codeticket=$_POST['codeticket'];
			$usertype=$_POST['usertype'];
			$stmt = $data->runQuery("INSERT INTO printing (print_token,print_userid) VALUES (:ticketcode,:print_userid)");
			$stmt->execute(array(":ticketcode"=>$codeticket,":print_userid"=>$userid));
			$resulty['resp']=1;
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
			$resulty['msg']="Saved Successfully";
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
