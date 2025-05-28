<?php
session_set_cookie_params(7200);
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'class/class.php';
$data = new Data();
if(isset($_GET['token'])){
    if(isset($_GET['p'])){
        $printdirect=1;   
    }else{
        $printdirect=0;
    }
    $userid=$_GET['token'];
    $typegetter=0;
    if(isset($_GET['type'])){
        
        if($_GET['type'] == "media"){
            $typegetter=1;
            $stmtq = $data->runQuery("SELECT v.id,v.token_key,v.first_name_en as first_name,v.last_name_en as last_name,v.job_title,v.organization as place_of_job FROM media_agencies v where v.token_key =:token");
            $stmtq->execute(array(":token"=>$userid));
        }else{
            $stmtq = $data->runQuery("SELECT v.id,v.type_id,v.first_name,v.last_name,v.job_title,v.place_of_job,v.token_key,t.name_en as type_name_en,bs.bg_color,bs.font_color FROM visitors v inner join types t on t.id=v.type_id left join badge_settings bs on bs.type_id=v.type_id  where v.token_key =:token");
            $stmtq->execute(array(":token"=>$userid));
        }
    }else{
    	$stmtq = $data->runQuery("SELECT v.id,v.type_id,v.first_name,v.last_name,v.job_title,v.place_of_job,v.token_key,t.name_en as type_name_en,bs.bg_color,bs.font_color FROM visitors v inner join types t on t.id=v.type_id left join badge_settings bs on bs.type_id=v.type_id  where v.token_key =:token");
        $stmtq->execute(array(":token"=>$userid));
    }
    
    if(isset($_GET['return'])){
        $printreturn=1;   
    }else{
        $printreturn=0;
    }
	

    $rowq= $stmtq->fetchAll();
    if($stmtq->rowCount() > 0){
    		$first_name=$rowq[0]['first_name'];
    		$last_name=$rowq[0]['last_name'];
    		$user_name=$first_name." ".$last_name;
    		$user_position=$rowq[0]['job_title'];
    		$user_company_name=$rowq[0]['place_of_job'];
    		$id=$rowq[0]['id'];
    		$token=$rowq[0]['token_key'];
    		if($typegetter == 1){
    		    $user_typeid=2;
    		    $type_name="Media";
    		    $vt_color_print="#602020";
    		}else{
        		$user_typeid=$rowq[0]['type_id'];
        		$type_name=$rowq[0]['type_name_en'];
        		$vt_color_print=$rowq[0]['bg_color'];
    		}
    	
	}else{
        $errormsg="User not found!";
        echo $errormsg;
        die();
    }

		$stmtqa = $data->runQuery("SELECT * FROM badges_details where bd_type_id =1 limit 1");
		$stmtqa->execute();
		$rowqa= $stmtqa->fetchAll();


		if($stmtqa->rowCount() > 0){
			$bdwid=$rowqa[0]['bd_width'];
			$bdheg=$rowqa[0]['bd_height'];
			$bdshowname=$rowqa[0]['bd_name_show'];
			$bdshowtype=$rowqa[0]['bd_type_show'];
			$bdshowcompany=$rowqa[0]['bd_company_show'];
			
			$bdrotatetype=$rowqa[0]['db_rotatetype'];
			
			$bdshowcountry=$rowqa[0]['bd_country_show'];
			$bdshowposition=$rowqa[0]['bd_position_show'];
			$bdshowbarcode=$rowqa[0]['bd_code_show'];
			$bdshowprofile=$rowqa[0]['bd_profile_show'];
			$font_size=$rowqa[0]['s_font'];

			$companyfont=$rowqa[0]['companyfont'];
			$typefont=$rowqa[0]['typefont'];
			$positionfont=$rowqa[0]['positionfont'];
			$tick_type=$rowqa[0]['tick_type'];
			$bdvalwidthxqr=$rowqa[0]['bd_qr_width'];
			$dbmargin=$rowqa[0]['bd_margin'];
			$dbcolor=$rowqa[0]['db_color'];

			$bdrotatename=$rowqa[0]['bd_rotatename'];
			$bdrotatetype=$rowqa[0]['db_rotatetype'];
			$bdrotatecompany=$rowqa[0]['db_rotatecompany'];
			$bdrotatecountry=$rowqa[0]['db_rotatecountry'];
			$bdrotateposition=$rowqa[0]['db_rotatposition'];
		
			
			$bdvalxname=$rowqa[0]['bd_name_positionx'];
			$bdvalxtype=$rowqa[0]['bd_type_positionx'];
			$bdvalxcompany=$rowqa[0]['bd_company_positionx'];
			$bdvalxcountry=$rowqa[0]['bd_country_positionx'];
			$bdvalxposition=$rowqa[0]['bd_position_positionx'];
			$bdvalxbarcode=$rowqa[0]['bd_code_positionx'];
			$bdvalxprofile=$rowqa[0]['bd_profile_positionx'];
			
			$bdvalprofile=$rowqa[0]['bd_profile_position'];
			$bdvalname=$rowqa[0]['bd_name_position'];
			$bdvaltype=$rowqa[0]['bd_type_position'];
			$bdvalcompany=$rowqa[0]['bd_company_position'];
			$bdvalcountry=$rowqa[0]['bd_country_position'];
			$bdvalposition=$rowqa[0]['bd_position_position'];
			$bdvalbarcode=$rowqa[0]['bd_code_position'];
			
			$bdvalwidthxprofile=$rowqa[0]['bd_profile_width'];
		}else{
			$bdwid=1134;
			$bdheg=1603;
			$bdshowname=1;
			$bdshowtype=1;
			$bdshowcompany=1;
			$bdshowcountry=1;
			$bdshowposition=1;
			$bdshowbarcode=1;
			$bdshowprofile=1;
			$font_size=20;

			$companyfont=20;
			$typefont=20;
			$positionfont=20;
			$tick_type=2;
			$bdvalwidthxqr=100;
			$dbmargin=20;	
			$dbcolor='#000000';

			$bdrotatename=0;
			$bdrotatetype=0;
			$bdrotatecompany=0;
			$bdrotatetype=0;
			$bdrotateposition=0;

			$bdvalname=460;
			$bdvalxname=0;
			$bdvalxtype=0;;
			$bdvalprofile=517;
			$bdvalxprofile=0;
			$bdvaltype=570;
			$bdvalcompany=570;
			$bdvalxcompany=0;
			$bdvalcountry=624;
			$bdvalxcountry=0;
			$bdvalposition=687;
			$bdvalxposition=0;
			$bdvalbarcode=1080;
			$bdvalxbarcode=0;
			$bdvalwidthxprofile=100;
		}
	
}else{
	$errormsg="خطا بالصفحة . البيانات غير متوفرة بالكامل";
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/bootstrap.rtl.css" rel="stylesheet">
    <?php 
    
    $fnt="'DiodrumArabic'";
    ?>
     

       
 <style>
@font-face {
    font-family: 'DiodrumArabic';
    src: url('fonts/DiodrumArabic-Semibold.eot');
    src: url('fonts/DiodrumArabic-Semibold.eot?#iefix') format('embedded-opentype'),
        url('fonts/DiodrumArabic-Semibold.woff2') format('woff2'),
        url('fonts/DiodrumArabic-Semibold.woff') format('woff'),
        url('fonts/DiodrumArabic-Semibold.ttf') format('truetype');
    font-weight: 600;
    font-style: normal;
    font-display: swap;
}

div#tttypebox {
    background: #<?=$vt_color_print?>;
    line-height: normal;
        width: 100%;
    padding-bottom: 15px;
}

body{
       font-family: 'DiodrumArabic';
}
	.bg_box {
		background: #ffffffd6!important;
		padding: 10px;
		border-radius: 8px;
		color: #4a5daa!important;
		outline: none;
		box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
	}
	.hiddenBackgroundzxc{
	    	background:url('badgebackgroundz.jpg');
	}
	.mainbagdeimage{
	
		background-repeat: no-repeat;
		width: <?=$bdwid?>px;
		height: <?=$bdheg?>px;
		position: relative;
		margin: 0 auto;
		background-size: 100% auto;
		padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px ;
		    box-shadow: 0 0 10px 10px #ccc;
    margin-bottom: 50px;
		
	}
	div#collapseExample {
		position: fixed;
		z-index: 99999;
		top: 1%;
	}
	
.ttnamebox {
	<?=(($bdshowname == 0)?'display:none;':'');?>
     position: absolute;
   
    width: <?=$bdwid?>px;
    top: <?=$bdvalname?>px;
    left: <?=$bdvalxname?>px;
    color: <?=$dbcolor?>;
    word-wrap: normal;
    text-align:center;
    font-weight: bold;
  font-size: <?=$font_size?>px;
    line-height: 52px;
   font-family: 'DiodrumArabic';
	padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px 
}

.ttvip_text {
	<?=(($bdshowtype == 0)?'display:none;':'');?>
	direction:ltr;
    position: absolute;
    text-align: center;
    width: <?=$bdwid?>px;
    top: <?=$bdvaltype?>px;
	left: <?=$bdvalxtype?>px;
    color: <?=$dbcolor?>;
    word-wrap: normal;
    text-transform: uppercase;
    font-weight: bold;
	font-size:  <?=$positionfont?>px;
    line-height: 50px;
   font-family: 'DiodrumArabic';
	padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px 
}

.ttcompanybox {
	<?=(($bdshowcompany == 0)?'display:none;':'');?>
		direction:ltr;
	position: absolute;
    text-align: center;
    top: <?=$bdvalcompany?>px;
	left: <?=$bdvalxcompany?>px;
    width: <?=$bdwid?>px;
    color:<?=$dbcolor?>;
    word-wrap: normal;
    text-transform: uppercase;
  font-size:  <?=$companyfont?>px;
    line-height: 50px;
	padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px 
}
.tttypebox {
	<?=(($bdshowtype == 0)?'display:none;':'');?>
		direction:ltr;
	position: absolute;
    text-align: center;
    top: <?=$bdvaltype?>px;
	left: <?=$bdvalxtype?>px;
    width: <?=$bdwid?>px;
    color:#000;
    word-wrap: normal;
    text-transform: uppercase;
    font-size:  <?=$typefont?>px;
    line-height: 50px;
	padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px 
}
.ttcountrybox {
	<?=(($bdshowcountry == 0)?'display:none;':'');?>
    position: absolute;
    text-align: center;
    top: <?=$bdvalcountry?>px;
    width: <?=$bdwid?>px;
	left: <?=$bdvalxcountry?>px;
    color: <?=$dbcolor?>;
    word-wrap: normal;
    text-transform: uppercase;
     line-height: 50px;
	 padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px ;
	 font-size:  <?=$positionfont?>px;
}

.ttpositionbox {
	<?=(($bdshowposition == 0)?'display:none;':'');?>
    position: absolute;
    text-align: center;
    top: <?=$bdvalposition?>px;
    width: <?=$bdwid?>px;
	left: <?=$bdvalxposition?>px;
	color: <?=$dbcolor?>;
    word-wrap: normal;
    text-transform: uppercase;
	font-size:  <?=$positionfont?>px;
    line-height: 52px;
	padding: 0 <?=$dbmargin;?>px  0 <?=$dbmargin;?>px 
}
.inpclsplace {
    width: 200px!important;
    margin-right: auto!important;
}
.barcodebox {
	<?=(($bdshowbarcode == 0)?'display:none;':'');?>
    text-align: Center;
    padding: 0px;
    overflow: auto;
    margin: auto;
    top: <?=$bdvalbarcode?>px;
	left: <?=$bdvalxbarcode?>px;
    position: absolute;
    right: 0;
    transform: rotate( 180deg);
   
}



.ttprofilebox{
	<?=(($bdshowprofile == 0)?'display:none;':'');?>
    text-align: Center;
    padding: 0px;
    overflow: auto;
    margin: auto;
    
    top: <?=$bdvalprofile?>px;
	left: <?=$bdvalxprofile?>px;
    position: absolute;
}
.profileimgc{
	width: <?=$bdvalwidthxprofile?>px;
}
#mdlqrcodeid {
    margin: 0 auto;
}
.msgboxss {
    position: fixed;
	display:none;
    top: 0;
    z-index: 99999;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 20px;
    font-size: 24px;
    width: 77%;
    box-shadow: 0px 0px 5px 1px #ccc;
    border-radius: 10px;
    border-right: 2px solid #1cd64c;
}
.bgcont{
	 
		    padding-top: 12px;
}

.font-size-label { margin-right: 20px; }
.inc_dec{ width: 40px;height: 40px;
    background-color: #1d3b81;font-size: 35px;border: 0;line-height: 35px;color: #ffffff;}
	.font-box { width: 60px;font-size: 18px; background-color: #009ec3;color: #ffffff;text-align: center;}
#comp-size { width: 60px;line-height: 40px;font-size: 18px; background-color: #009ec3;color: #ffffff;text-align: center;}

	.formplacec{
		height: 27px;
	}
	.input-group-text{height: 27px;border-radius: 0;}
	.hd_title{padding: 0 5px 0 0;font-size: 20px;}

div#qrimgcbox img {
	width: <?=$bdvalwidthxqr?>px;

}
.hibzzzaaa {
    display: none;
}
.showasblock {
    display: none;
}
.my-2 {
	margin-top: 7px !important; margin-bottom: 7px !important;
}
div#qrimgcbox img {
    margin: auto;
        border: 10px solid #ffff;
}
    </style>
  </head>
  <body id="page-top">
        <div class="container-fluid bgcont">
			<div class="d-sm-flex align-items-center justify-content-between mb-4 bg_box">
				<h1 class="h3 mb-0  decolor2">طباعة </h1>
				<div class="text-left">
				 	<button class="btn btn-success" onclick="showhidebackgound()" type="button" >Show/Hide Background</button>
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">الاختيارات</button>
					<button class="btn btn-success" onclick="printthepdfticket()" type="button" >طباعة</button>
					
				</div>
			</div>
		<div class="collapse" id="collapseExample">
		    
                			<div class="card card-body"  id="the_content_passcodee">
                			    <div class="hideifnoteligible">
                    		        <input type="text"  id="passcodeee" value="" />
                    		        <button class="btn-succss" onclick="showoptions()">Submit</button>
                    		    </div>
                			  
                				<div class="mb-3 hibzzzaaa">
                					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">اغلاق</button>
                				<button class="btn btn-success" onclick="savetheinfo()" type="button" >حفظ للكل مستقبليا</button>
                				<input type="color" name="txt_color" id="ttdbcolor=" class="colorpickerin" value="<?=$dbcolor?>" onchange="changecolor(this)"  >
                				<input type="hidden" name="no" id="newdbcolor" value="<?=$dbcolor?>"  >
                				</div>
                				
                			<div class="form- showasblock">
                				<label class="form-check-label" for="ttcheckbadge" style="float: right;">البادج</label>
                				<div class="input-group inpclsplace">
                					<div class="input-group-prepend">
                						<div class="input-group-text">الطول</div>
                					</div>
                					<input type="number" value="<?=$bdheg?>" id="ttbagdeheightmm" onchange="changebadgeheight(this)" class="form-control formplacec" placeholder="1603">
                				</div>
                				
                				<div class="input-group my-2 inpclsplace">
                					<div class="input-group-prepend">
                						<div class="input-group-text">العرض</div>
                					</div>
                					<input type="number" value="<?=$bdwid?>" id="ttbagdewidthmm" onchange="changebadgewidth(this)" class="form-control formplacec" placeholder="1134">
                				</div>
                
                				<div class="input-group my-2 inpclsplace">
                					<div class="input-group-prepend">
                						<div class="input-group-text">التباعد</div>
                					</div>
                					<input type="number" value="<?=$dbmargin?>" id="ttbagdemarginmm" onchange="changebadgemargin(this)" class="form-control formplacec" placeholder="1134">
                				</div>
                			</div>
                    <hr class="my-0">
                
                
                
                		<div class="form-inline hibzzzaaa">
                			<input class="form-check-input" type="checkbox" id="ttcheckname" onclick="changedchecker(this,'ttnamebox')" <?=(($bdshowname == 1)?'checked':'');?>>
                			<label class="form-check-label hd_title" for="ttcheckname">الاسم</label>
                			<div class="input-group my-2 mr-sm-2 inpclsplace">
                						<div class="input-group-prepend">
                						<div class="input-group-text">الخط</div>
                						</div>
                						<input type="number" value="<?=$font_size?>"  onchange="changefont(this,'ttnamebox')" class="form-control formplacec font-box" id="font-size" placeholder="0">
                						</div>
                	  </div>
                
                	   <div class="form-inline hibzzzaaa">
                
                        <label class="form-check-label" for="ttcheckcompany">الموقع</label>
                		 <div class="input-group my-2 mr-sm-2 inpclsplace">
                				<div class="input-group-prepend">
                				<div class="input-group-text">px</div>
                				</div>
                				<input type="number" value="<?=$bdvalname?>" onchange="changeplace(this,'ttnamebox')" class="form-control formplacec" id="ttnameboxdplace" placeholder="460">
                				<input type="number" value="<?=$bdvalxname?>" onchange="changexplace(this,'ttnamebox')" class="form-control formplacec" id="ttnamexboxdplace" placeholder="0">
                			</div>
                			<input class="form-check-input" type="checkbox" id="ttrotatename"  style="display: none" <?=(($bdrotatename == 1)?'checked':'');?>>
                			<img src="rotate_right.png"  onclick="rotate('ttrotatename','ttnamebox')" style="width:30px;padding: 0 5px 0 0;">   
                		
                		</div>
                	 
                		
                		<hr class="my-0">	
                		
                		<div class="form-inline hibzzzaaa">
                        <input class="form-check-input" type="checkbox" id="ttcheckcompany" onclick="changedchecker(this,'ttcompanybox')" <?=(($bdshowcompany == 1)?'checked':'');?>>
                        <label class="form-check-label hd_title" for="ttcheckcompany" >الشركة</label>
                		
                	
                						<div class="input-group my-2 mr-sm-2 inpclsplace">
                						<div class="input-group-prepend">
                						<div class="input-group-text">الخط</div>
                						</div>
                						<input type="number" value="<?=$companyfont?>"  onchange="changefont(this,'ttcompanybox')" class="form-control formplacec  font-box" id="companyfont" placeholder="0">
                						</div>
                	  </div>
                
                	   <div class="form-inline hibzzzaaa">
                
                        <label class="form-check-label" for="ttcheckcompany">الموقع</label>
                		 <div class="input-group my-2 mr-sm-2 inpclsplace">
                    <div class="input-group-prepend">
                      <div class="input-group-text">px</div>
                    </div>
                    <input type="number" value="<?=$bdvalcompany?>" onchange="changeplace(this,'ttcompanybox')" class="form-control formplacec" id="ttcompanyboxdplace" placeholder="500">
                	<input type="number" value="<?=$bdvalxcompany?>" onchange="changexplace(this,'ttcompanybox')" class="form-control formplacec" id="ttcompanyxboxdplace" placeholder="0">
                  </div>
                  			<input class="form-check-input" type="checkbox" id="ttrotatecompany"  style="display: none"  <?=(($bdrotatecompany == 1)?'checked':'');?>>
                			<img src="rotate_right.png"  onclick="rotate('ttrotatecompany','ttcompanybox')" style="width:30px;padding: 0 5px 0 0;">
                      
                      </div>
                      
                      
                	  <hr class="my-0">
                        <div class="form-inline hibzzzaaa">
                                <input class="form-check-input" type="checkbox" id="ttchecktype" onclick="changedchecker(this,'tttypebox')" <?=(($bdshowtype == 1)?'checked':'');?>>
                                <label class="form-check-label hd_title" for="ttchecktype" >النوع</label>
                        		
                        	
                        						<div class="input-group my-2 mr-sm-2 inpclsplace">
                        						<div class="input-group-prepend">
                        						<div class="input-group-text">الخط</div>
                        						</div>
                        						<input type="number" value="<?=$typefont?>"  onchange="changefont(this,'tttypebox')" class="form-control formplacec  font-box" id="typefont" placeholder="0">
                        						</div>
                        	  </div>
                        
                        	   <div class="form-inline hibzzzaaa">
                        
                                <label class="form-check-label" for="ttchecktype">الموقع</label>
                        		 <div class="input-group my-2 mr-sm-2 inpclsplace">
                            <div class="input-group-prepend">
                              <div class="input-group-text">px</div>
                            </div>
                            <input type="number" value="<?=$bdvaltype?>" onchange="changeplace(this,'tttypebox')" class="form-control formplacec" id="tttypeboxdplace" placeholder="500">
                        	<input type="number" value="<?=$bdvalxtype?>" onchange="changexplace(this,'tttypebox')" class="form-control formplacec" id="tttypexboxdplace" placeholder="0">
                          </div>
                  			<input class="form-check-input" type="checkbox" id="ttrotatetype"  style="display: none"  <?=(($bdrotatetype == 1)?'checked':'');?>>
                			<img src="rotate_right.png"  onclick="rotate('ttrotatetype','tttypebox')" style="width:30px;padding: 0 5px 0 0;">
                      
                      </div>
                	  <hr class="my-0">
                
                	  <div class="form-inline hibzzzaaa">
                        <input class="form-check-input" type="checkbox" id="ttcheckposition" onclick="changedchecker(this,'ttpositionbox')" <?=(($bdshowposition == 1)?'checked':'');?>>
                        <label class="form-check-label hd_title" for="ttcheckposition" > المنصب</label>
                			
                					<div class="input-group my-2 mr-sm-2 inpclsplace">
                					<div class="input-group-prepend">
                					<div class="input-group-text">الخط</div>
                					</div>
                					<input type="number" value="<?=$positionfont?>"  onchange="changefontpos(this,'ttpositionbox')" class="form-control formplacec  font-box" id="positionfont" placeholder="0">
                					</div>
                			</div>
                
                	   <div class="form-inline hibzzzaaa">
                
                        <label class="form-check-label" for="ttcheckcompany">الموقع</label>
                		 <div class="input-group my-2 mr-sm-2 inpclsplace">
                    <div class="input-group-prepend">
                      <div class="input-group-text">px</div>
                    </div>
                    <input type="number" value="<?=$bdvalposition?>" onchange="changeplace(this,'ttpositionbox')" class="form-control formplacec" id="ttpositionboxdplace" placeholder="500">
                	<input type="number" value="<?=$bdvalxposition?>" onchange="changexplace(this,'ttpositionbox')" class="form-control formplacec" id="ttpositionxboxdplace" placeholder="0">
                  </div>
                
                      </div>
                
                	  <hr class="my-0">
                		
                	  <div class="form-inline hibzzzaaa">
                        <label class="form-check-label hd_title" for="ttcheckbarcode">نوع التذكرة</label>
                		 <div class="input-group my-2 mr-sm-2 inpclsplace">
                
                			<input type="radio" value="2"  class="" id="ch_qrcode"  name="tick_type" onclick="viewboxtype(this,'qrimgcbox','barimgcbox')" style="margin: 0 5px 0 5px" <?php if ($tick_type==2) {echo "checked";} ?>> QR code
                		</div>
                		
                
                      </div> 	  
                	 
                	 
                	  <div class="form-inline hibzzzaaa">
                        <input class="form-check-input" type="checkbox" id="ttcheckbarcode" onclick="changedcodeview(this,'barcodebox')" <?=(($bdshowbarcode == 1)?'checked':'');?>>
                        <label class="form-check-label" for="ttcheckbarcode">رمز التذكرة</label>
                		 <div class="input-group my-2 mr-sm-2 inpclsplace">
                			<div class="input-group-prepend">
                			<div class="input-group-text">px</div>
                			</div>
                			<input type="number" value="<?=$bdvalbarcode?>" onchange="changeplace(this,'barcodebox')" class="form-control formplacec" id="ttbarcodeboxdplace" placeholder="500">
                			<input type="number" value="<?=$bdvalxbarcode?>" onchange="changexplace(this,'barcodebox')" class="form-control formplacec" id="ttbarcodexboxdplace" placeholder="0">
                		
                			<div class="input-group my-2 mr-sm-2 inpclsplace">
                		<div class="input-group-prepend">
                		  <div class="input-group-text">الحجم</div>
                		</div>
                		<input type="number" value="<?=$bdvalwidthxqr?>" onchange="changexwidth(this,'zxcqrcode img')" class="form-control formplacec" id="ttqrxboxdwidth" placeholder="0">
                		</div>
                		</div>
                		
                
                      </div> 
                	  <hr class="my-0">
                   
                	  
                			</div>
		</div>
			<div class="card-body mainbagdeimage " id="tobedownloadedpdf" style="color: #cccccc !important">
				<div  id="" class="badgebox" >
                    <div id="ttnamebox"  class="ttnamebox <?php if($bdrotatename==1) {echo 'rotate';} else {echo 'unrotate';}?>" >
                        <div style="text-align: center;max-width: 500px;margin: auto;line-height: 60px;"><?=$user_name?></div>
                    </div>
		
                
                    <div id="ttcompanybox" class="ttcompanybox  <?php if($bdrotatecompany==1) {echo 'rotate';} else {echo 'unrotate';}?>">
                        <?=$user_company_name?>
                    </div>
			
                    <div id="ttpositionbox" class="ttpositionbox  <?php if($bdrotateposition==1) {echo 'rotate';} else {echo 'unrotate';}?>">
                        <?=$user_position?>
                    </div>
                    <div id="tttypebox" class="tttypebox  <?php if($bdrotatetype==1) {echo 'rotate';} else {echo 'unrotate';}?>">
                        <?=$type_name?>
                    </div>
                    <div  class="barcodebox" >
							<div id="qrimgcbox" class="zxcqrcode"  style="<?=(($tick_type == 2)?'':'display:none;');?>">
							
							</div>
					</div>
                </div>  
			</div>
			<div class="msgboxss">
				
			</div>
<style>
.rotate {
    
    transform:             rotate( -180deg );            
        -moz-transform:    rotate( -180deg );            
        -ms-transform:     rotate( -180deg );            
        -o-transform:      rotate( -180deg );            
        -webkit-transform: rotate( -180deg );            
    transition:             transform 550ms ease;
        -moz-transition:    -moz-transform 550ms ease;
        -ms-transition:     -ms-transform 550ms ease;
        -o-transition:      -o-transform 550ms ease;
        -webkit-transition: -webkit-transform 550ms ease;
}
.unrotate {
    
    transform:             rotate( -360deg );            
        -moz-transform:    rotate( -360deg );            
        -ms-transform:     rotate( -360deg );            
        -o-transform:      rotate( -360deg );            
        -webkit-transform: rotate( -360deg );            
    transition:             transform 550ms ease;
        -moz-transition:    -moz-transform 550ms ease;
        -ms-transition:     -ms-transform 550ms ease;
        -o-transition:      -o-transform 550ms ease;
        -webkit-transition: -webkit-transform 550ms ease;
}

input[type=checkbox] + label[for=rotate]
{
	display: block;
	width: 150px;
	height: 180px;
	border: 3px solid transparent;
	text-align: center;
	font-weight: bold;
}


</style>
<?php include 'footer.php';?>
<!--<script src="js/jquery-barcode.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="qrcode.js"></script>

<script>
var qrcode = new QRCode(document.getElementById("qrimgcbox"), {
	width : 100,
	height : 100,
	colorDark : "#000000",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H
});



  function showoptions() {
        // Get the value of the passcode input field
        var passcodeValue = $("#passcodeee").val();

        // Check if the passcode value is "2206"
        if (passcodeValue === "123") {
            // Show elements with class "hibzzzaaa"
            $(".hibzzzaaa").css("display", "flex");
            $(".hideifnoteligible").slideUp();
            $(".showasblock").slideDown();
            
        }
    }
function showhidebackgound(){
    $("#tobedownloadedpdf").toggleClass("hiddenBackgroundzxc");
}
function changedchecker(tt,filedclass){
	var cchecked = $(tt).is(":checked");

	
	if(cchecked){
		$('.'+filedclass).slideDown();
	}else{
		$('.'+filedclass).slideUp();
	}
}

function changedcodeview(tt,filedclass){
	var cchecked = $(tt).is(":checked");
	var tk=$('input:radio[name=tick_type]:checked').val();
	
	if(cchecked){
		$('.'+filedclass).slideDown();
	}else{
		$('.'+filedclass).slideUp();
	}
}


function viewboxtype(tt,first,sec){
	var tk=$('input:radio[name=tick_type]:checked').val();
	

		$('#'+first).slideDown();
		$('#'+sec).slideUp();
	


}



function rotate(tt,filedclass){

	
	var cchecked = $("#"+tt).is(":checked");
	if(cchecked){
		$('#'+tt).prop('checked', false);
		$('.'+filedclass).toggleClass('rotate unrotate');
	}else{
		$('#'+tt).prop('checked', true);
		$('.'+filedclass).toggleClass('unrotate rotate');
	}
}


function changeplace(tt,placeclass){
	var vall= $(tt).val();
	$('.'+placeclass).css("top", vall+"px");
}
function changexplace(tt,placeclass){
	var vall= $(tt).val();
	$('.'+placeclass).css("left", vall+"px");
}
function changexwidth(tt,placeclass){
	var vall= $(tt).val();
	$('.'+placeclass).css("width", vall+"px");
}

function changebadgeheight(tt){
	var vall= $(tt).val();
	$('.mainbagdeimage').css("height", vall+"px");
	
}
function changebadgemargin(tt){
	var vall= $(tt).val();
	$('.mainbagdeimage').css("padding","0 "+ vall+"px 0 " + vall+"px  " );
	$('.ttnamebox').css("padding","0 "+ vall+"px 0 " + vall+"px  " );
	$('.ttvip_text').css("padding","0 "+ vall+"px 0 " + vall+"px  " );
	$('.ttcompanybox').css("padding","0 "+ vall+"px 0 " + vall+"px  " );
	$('.ttcountrybox').css("padding","0 "+ vall+"px 0 " + vall+"px  " );
	$('.ttpositionbox').css("padding","0 "+ vall+"px 0 " + vall+"px  " );
}

function changebadgewidth(tt){
	var vall= $(tt).val();
	$('.mainbagdeimage').css("width", vall+"px");
	$('.ttnamebox').css("width", vall+"px");
	$('.ttvip_text').css("width", vall+"px");
	$('.ttcompanybox').css("width", vall+"px");
	$('.ttcountrybox').css("width", vall+"px");
	$('.ttpositionbox').css("width", vall+"px");
}

function changecolor(tt){
	var vall= $(tt).val();
	$('.mainbagdeimage').css("color", vall);
	$('.ttnamebox').css("color", vall);

	$('.ttcompanybox').css("color", vall);

	$('.ttpositionbox').css("color", vall);
	$('#newdbcolor').val(vall);
}

function printthepdfticket(){
	$.ajax({
      url : 'ajax_users.php',
      type : 'POST',
      data : {'userid' : <?=$id?>,'action':'printticket','codeticket':'<?=$token?>','usertype':'<?=$user_typeid?>'},
      success : function(data) {
          var resp = (JSON.parse(data)).resp;
	    },
	});
	
    html2canvas(document.getElementById("tobedownloadedpdf"),{
			allowTaint: true,
			useCORS: true
	}).then(function (canvas) {			
	        var anchorTag = document.createElement("a");
			document.body.appendChild(anchorTag);
			anchorTag.download = "Ticket-<?=str_replace(' ', '-', $user_name)?>.jpg";
			anchorTag.href = canvas.toDataURL();
			var myImage = anchorTag.href;
			PrintImage(myImage)
	});
}     
   
function ImagetoPrint(source){
        return "<html><head><scri"+"pt>function step1(){\n" +
                "setTimeout('step2()', 10);}\n" +
                "function step2(){window.print();window.close()}\n" +
                "</scri" + "pt></head><body onload='step1()' style='padding:0;margin:0'>\n" +
  "<img src='" + source + "' style='margin-left:5px;margin-right:5px;margin-top:11px' /></body></html>";
}
function PrintImage(source){
    var Pagelink = "about:blank";
    var pwa = window.open(Pagelink, "_new");
    pwa.document.open();
    pwa.document.write(ImagetoPrint(source));
    pwa.document.close();
    <?php if($printreturn == 1){ ?>
        window.location.href = "scan.php";
    <?php }else{ ?>
    
    <?php } ?>
}
function savetheinfo(){
	var ttbagdeheightmm= $("#ttbagdeheightmm").val();
	var ttbagdewidthmm= $("#ttbagdewidthmm").val();
	var ttbagdemarginmm= $("#ttbagdemarginmm").val();
	var ttcheckname =0;
	var ttcheckcountry =0;
	var ttcheckcompany =0;
	var ttcheckposition =0;
	var ttchecktype =0;

	var ttrotatename =0;
	var ttrotatecountry =0;
	var ttrotatecompany =0;
	var ttrotateposition =0;
	var ttrotatetype =0;
	var ttdbcolor = $("#newdbcolor").val();

	var ttcheckbarcode =0;
// 	var ttcheckprofile =0;
// 	var ttprofileboxdplace= $("#ttprofileboxdplace").val();
// 	var ttprofilexboxdplace= $("#ttprofilexboxdplace").val();
// 	var ttprofilexboxdwidth= $("#ttprofilexboxdwidth").val();
	
	var ttnameboxdplace= $("#ttnameboxdplace").val();
// 	var ttcountryboxdplace= $("#ttcountryboxdplace").val();
	var ttcompanyboxdplace= $("#ttcompanyboxdplace").val();
	var ttpositionboxdplace= $("#ttpositionboxdplace").val();
	var tttypeboxdplace= $("#tttypeboxdplace").val();
	var ttbarcodeboxdplace= $("#ttbarcodeboxdplace").val();
	
	var ttnamexboxdplace= $("#ttnamexboxdplace").val();
// 	var ttcountryxboxdplace= $("#ttcountryxboxdplace").val();
	var ttcompanyxboxdplace= $("#ttcompanyxboxdplace").val();
	var ttpositionxboxdplace= $("#ttpositionxboxdplace").val();
	var tttypexboxdplace= $("#tttypexboxdplace").val();
	var ttbarcodexboxdplace= $("#ttbarcodexboxdplace").val();
	
	var ttfontsize= $("#font-size").val();
	var ttcompanyfont=$("#companyfont").val();;
	var tttypefont=$("#typefont").val();;
	var	ttpositionfont=$("#positionfont").val();;
	var	tttick_type=$('input:radio[name=tick_type]:checked').val();;
	var	ttqrxboxdwidth=$("#ttqrxboxdwidth").val();



	
	
// 	if($("#ttcheckprofile").is(":checked")){ttcheckprofile =1;}
	if($("#ttcheckname").is(":checked")){ttcheckname =1;}
// 	if($("#ttcheckcountry").is(":checked")){ttcheckcountry =1;}
	if($("#ttcheckcompany").is(":checked")){ttcheckcompany =1;}
	if($("#ttcheckposition").is(":checked")){ttcheckposition=1;}
	if($("#ttchecktype").is(":checked")){ttchecktype=1;}

	if($("#ttrotatename").is(":checked")){ttrotatename =1;}
// 	if($("#ttrotatecountry").is(":checked")){ttrotatecountry =1;}
	if($("#ttrotatecompany").is(":checked")){ttrotatecompany =1;}
	if($("#ttrotateposition").is(":checked")){ttrotateposition	=1;}
// 	if($("#ttrotatetype").is(":checked")){ttrotatetype	=1;}

	if($("#ttcheckbarcode").is(":checked")){ttcheckbarcode =1;}
	$.ajax({
		url : 'ajax_users.php',
		type : 'POST',
		data : {'action':'savebadgeinfo','typeid':1,
		'ttbagdeheightmm' : ttbagdeheightmm,
		'ttbagdewidthmm' : ttbagdewidthmm,
		'ttcheckname' : ttcheckname,'ttfontsize' : ttfontsize,
		'ttcheckcountry' :  1,
		'ttcheckcompany' : ttcheckcompany,
		'ttcheckposition' : ttcheckposition,
		'ttchecktype' : ttchecktype,
		'ttcheckbarcode' : ttcheckbarcode,
		'ttrotatename' : ttrotatename,
		'ttrotatetype' : ttrotatetype,
		'ttrotatecountry' : 0,
		'ttrotatecompany' : ttrotatecompany,
		'ttrotateposition' : ttrotateposition,

		'ttnameboxdplace' : ttnameboxdplace,
		'ttcountryboxdplace' : 1,
		'ttcompanyboxdplace' : ttcompanyboxdplace,
		'ttpositionboxdplace' : ttpositionboxdplace,
		'tttypeboxdplace' : tttypeboxdplace,
		'ttbarcodeboxdplace' : ttbarcodeboxdplace,
		'ttcheckprofile' : 1,
		'ttprofileboxdplace' : 1,
		'ttprofilexboxdplace' : 1,
		'ttnamexboxdplace' : ttnamexboxdplace,
		'ttcountryxboxdplace' : 1,
		'ttcompanyxboxdplace' : ttcompanyxboxdplace,
		'ttpositionxboxdplace' : ttpositionxboxdplace,
		'tttypexboxdplace' : tttypexboxdplace,
		'ttbarcodexboxdplace' : ttbarcodexboxdplace,
		'ttprofilexboxdwidth' : 0,
		'ttcompanyfont':ttcompanyfont,'ttdbcolor':ttdbcolor,
		'tttypefont':tttypefont,
		'ttpositionfont':ttpositionfont,
		'tttick_type':tttick_type,
		'ttqrxboxdwidth':ttqrxboxdwidth,
		'ttbagdemarginmm':ttbagdemarginmm
		},
		success : function(data) {
			var resp = (JSON.parse(data)).resp;
			if(resp == 1){
				var msg = (JSON.parse(data)).msg;
				$('.msgboxss').html(msg);
				$('.msgboxss').slideDown();
				setTimeout(
			  function() 
			  {
				$('.msgboxss').slideUp();
			  }, 3000);
				
			}else{
				var msg = (JSON.parse(data)).msg;
				$('#msgbox').html(msg);
			}	
		},	
	});
}	

function changefont(main,id){

var fsize = $(main).val();
	$( "#"+id ).css("font-size",fsize+'px');
}

function changefontpos(main,id){

var fsize = $(main).val();
	$( "#"+id ).css("font-size",fsize+'px');
	$( "#ttcountrybox" ).css("font-size",fsize+'px');
	$( "#ttvip_text" ).css("font-size",fsize+'px');
}

$(document).ready(function() {
    var data="<?=$token?>";
    qrcode.makeCode(data);
    
    
    <?php if($printdirect==1){ ?>
    setTimeout(
  function() 
  {
			printthepdfticket();
  }, 1000);
      
    <?php } ?>
 });
</script>

