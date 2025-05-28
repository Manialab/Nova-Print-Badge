<?php
require_once 'connection.php';
class Data{
 private $conn;
 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
  $this->conn->query("SET NAMES 'utf8'");
  $this->conn->query("SET CHARACTER SET utf8");
    }

 public function runQuery($sql){
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }
  public function getcon($sql){
  $stmt = $this->conn->query($sql);
  return $stmt;
 }
 public function lasdID(){
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }

 /*custom functions*/
 public function register_new_exhbweb($comp_name,$first_name,$last_name,$email_address,$phone_number,$country,$bried_startup,$sector,$investment_phase,$attend_objective,$img){
  try{
      	
    $statusistwo=2;
   $stmt = $this->conn->prepare("INSERT INTO exhibitors
   (exh_firstname,exh_lastname,exh_phone,exh_email,exh_country_id,exh_company_name,exh_brief_about_startup,exh_industry_type_id,exh_company_logo,exh_company_investment,exh_objective_attend,exh_status)
   VALUES(:exh_firstname,:exh_lastname,:exh_phone,:exh_email,:exh_country_id,:exh_company_name,:exh_brief_about_startup,:exh_industry_type_id,:exh_company_logo,:exh_company_investment,:exh_objective_attend,:exh_status)");
   $stmt->bindparam(":exh_firstname",$first_name);
   $stmt->bindparam(":exh_lastname",$last_name);
   $stmt->bindparam(":exh_phone",$phone_number);
   $stmt->bindparam(":exh_email",$email_address);
   $stmt->bindparam(":exh_country_id",$country);
   $stmt->bindparam(":exh_company_name",$comp_name);
   $stmt->bindparam(":exh_brief_about_startup",$bried_startup);
   $stmt->bindparam(":exh_industry_type_id",$sector);
   $stmt->bindparam(":exh_company_logo",$img);
   $stmt->bindparam(":exh_company_investment",$investment_phase);
   $stmt->bindparam(":exh_objective_attend",$attend_objective);
   $stmt->bindparam(":exh_status",$statusistwo);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }

 public function register_new_areaticket($att_comp_id,$att_name,$att_price,$att_count){
  try{
   $stmt = $this->conn->prepare("INSERT INTO area_tickets(att_comp_id,att_name,att_price,att_count)
   VALUES(:att_comp_id,:att_name,:att_price,:att_count)");
   $stmt->bindparam(":att_comp_id",$att_comp_id);
   $stmt->bindparam(":att_name",$att_name);
   $stmt->bindparam(":att_price",$att_price);
   $stmt->bindparam(":att_count",$att_count);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }
 public function register_new_company($comp_name,$comp_description,$comp_logoimgd,$comp_email,$comp_phone,$comp_password,
$comp_employees_num,$comp_badgeimgd){
  try{
   $stmt = $this->conn->prepare("INSERT INTO company(comp_name,comp_description,comp_logo,comp_email,comp_phone,
   comp_password,comp_employees_num,comp_badge)
   VALUES(:comp_name,:comp_description,:comp_logoimgd,:comp_email,:comp_phone,:comp_password,:comp_employees_num,
   :comp_badgeimgd)");
   $stmt->bindparam(":comp_name",$comp_name);
   $stmt->bindparam(":comp_description",$comp_description);
   $stmt->bindparam(":comp_logoimgd",$comp_logoimgd);
   $stmt->bindparam(":comp_email",$comp_email);
   $stmt->bindparam(":comp_phone",$comp_phone);
   $stmt->bindparam(":comp_password",$comp_password);
   $stmt->bindparam(":comp_employees_num",$comp_employees_num);
   $stmt->bindparam(":comp_badgeimgd",$comp_badgeimgd);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }


 public function register_new_user($user_name,$last_name,$user_identification,$user_phone,$user_email,$user_gender,$ut_badge_image,$user_position,
	$user_company_name,$user_typeid,$user_country,$user_status,$token){
  try{
	  $newtokencode=uniqid(("T".rand(111,999)));
   $stmt = $this->conn->prepare("INSERT INTO users(user_name,last_name,user_identification,user_phone,user_email,user_gender,user_profile,
   user_position,user_company_name,user_typeid,user_country,user_status,user_ticketcode,token)
   VALUES(:user_name,:last_name,:user_identification,:user_phone,:user_email,:user_gender,:ut_badge_image,:user_position,:user_company_name,
   :user_typeid,:user_country,:user_status,:newtokencode,:token)");
   $stmt->bindparam(":user_name",$user_name);
   $stmt->bindparam(":last_name",$last_name);
   $stmt->bindparam(":user_identification",$user_identification);
   $stmt->bindparam(":user_phone",$user_phone);
   $stmt->bindparam(":user_email",$user_email);
   $stmt->bindparam(":user_gender",$user_gender);
   $stmt->bindparam(":ut_badge_image",$ut_badge_image);
   $stmt->bindparam(":user_position",$user_position);
   $stmt->bindparam(":user_company_name",$user_company_name);
   $stmt->bindparam(":user_typeid",$user_typeid);
   $stmt->bindparam(":user_country",$user_country);
   $stmt->bindparam(":user_status",$user_status);
   $stmt->bindparam(":newtokencode",$newtokencode);
   $stmt->bindparam(":token",$token);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }

 public function register_update_user($userid,$username,$userphone,$useremail,$userbd,$usergender,$userbloodtype,$userweight,$userheight,$useraddress,$usernote){
  try{
   $stmt = $this->conn->prepare("update users set
   user_name=:user_name,
   user_phone=:user_phone,
   user_email=:user_email,
   user_gender=:user_gender,
   user_bd=:user_bd,
   user_weight=:user_weight,
   user_height=:user_height,
   user_bloodtype=:user_bloodtype,
   user_address=:user_address,
   user_note=:user_note
   where user_id=:userid");

   $stmt->bindparam(":userid",$userid);
   $stmt->bindparam(":user_name",$username);
   $stmt->bindparam(":user_phone",$userphone);
   $stmt->bindparam(":user_email",$useremail);
   $stmt->bindparam(":user_gender",$usergender);
   $stmt->bindparam(":user_bd",$userbd);
   $stmt->bindparam(":user_weight",$userweight);
   $stmt->bindparam(":user_height",$userheight);
   $stmt->bindparam(":user_bloodtype",$userbloodtype);
   $stmt->bindparam(":user_address",$useraddress);
   $stmt->bindparam(":user_note",$usernote);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }

 public function register_new_admin($username,$userphone,$useremail,$user_password,$usertype){
  try{
	  $newddpass=md5($user_password);
   $stmt = $this->conn->prepare("INSERT INTO admins(ad_name,ad_phone,ad_email,ad_password,ad_type)
                                                VALUES(:user_name,:user_phone,:user_email,:ad_password,:ad_type)");
   $stmt->bindparam(":user_name",$username);
   $stmt->bindparam(":user_phone",$userphone);
   $stmt->bindparam(":user_email",$useremail);
   $stmt->bindparam(":ad_password",$newddpass);
   $stmt->bindparam(":ad_type",$usertype);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }
public function register_update_admin($userid,$username,$userphone,$useremail,$user_password,$usertype){
  try{
   $stmt = $this->conn->prepare("update admins set
   ad_name=:user_name,
   ad_phone=:user_phone,
   ad_email=:user_email,
   ad_password=:ad_password,
   ad_type=:ad_type
   where admin_id=:userid");

   $stmt->bindparam(":userid",$userid);
   $stmt->bindparam(":user_name",$username);
   $stmt->bindparam(":user_phone",$userphone);
   $stmt->bindparam(":user_email",$useremail);
   $stmt->bindparam(":ad_password",$user_password);
   $stmt->bindparam(":ad_type",$usertype);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }
 public function register_new_type($ut_name,$ut_badge_image,$ut_isadmin_type){
  try{
   $stmt = $this->conn->prepare("INSERT INTO users_types(ut_name,ut_badge_image,ut_isadmin_type)
                                                VALUES(:ut_name,:ut_badge_image,:ut_isadmin_type)");
   $stmt->bindparam(":ut_name",$ut_name);
   $stmt->bindparam(":ut_badge_image",$ut_badge_image);
   $stmt->bindparam(":ut_isadmin_type",$ut_isadmin_type);
   $stmt->execute();
   return $stmt;
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }

 public function add_months($months, DateTime $dateObject) {
    $next = new DateTime($dateObject->format('Y-m-d'));
    $next->modify('last day of +'.$months.' month');
    if($dateObject->format('d') > $next->format('d')) {
        return $dateObject->diff($next);
    } else {
        return new DateInterval('P'.$months.'M');
    }
}
public function endCycle($d1, $months){
    $date = new DateTime($d1);
  //  $newDate = $date->add($this->add_months($months, $date));
    $date->add(new DateInterval('P'.$months.'D'));
    $dateReturned = $date->format('Y-m-d');
    return $dateReturned;
}

 public function login($username,$upass){
  try{
   $stmt = $this->conn->prepare("SELECT * FROM admins WHERE ad_email=:ad_username");
   $stmt->execute(array(":ad_username"=>$username));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   if($stmt->rowCount() == 1){
        if($userRow['ad_password']==md5($upass)){
            if($userRow['ad_status']==1){
                $_SESSION['admin_id'] = ($userRow['admin_id']);
                $_SESSION['admin_name'] = $userRow['ad_name'];
                $_SESSION['admin_type'] = $userRow['ad_type'];
                return 1;
            }else{
                return 3;
            }
        }else{
            return 2;
        }
   }else{
        return 2;
   }
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }
 public function logincompany($username,$upass){
  try{
   $stmt = $this->conn->prepare("SELECT * FROM company WHERE comp_email=:comp_email");
   $stmt->execute(array(":comp_email"=>$username));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   if($stmt->rowCount() == 1){
        if($userRow['comp_password']==($upass)){
            if($userRow['comp_status']==1){
                $_SESSION['compadmin_id'] = ($userRow['comp_id']);
                $_SESSION['compadmin_name'] = $userRow['comp_name'];
                $_SESSION['compadmin_logo'] = $userRow['comp_logo'];
                return 1;
            }else{
                return 3;
            }
        }else{
            return 2;
        }
   }else{
        return 4;
   }
  }
  catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }

 public function is_logged_in(){
  if(isset($_SESSION['admin_id'])){
   return true;
  }
 }

/*
public function getuserinfo($id){
  try{
   $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id=:id");
   $stmt->execute(array(":id"=>$id));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   if($stmt->rowCount() == 1){
        $_SESSION['userSession'] = $userRow['id'];
        $_SESSION['userEmailAddress'] = $userRow['email'];
        return $userRow['email'];
    }
  }catch(PDOException $ex){
   echo $ex->getMessage();
  }
 }
*/
 public function redirect($url){
  header("Location: $url");
 }

 public function logout(){
  session_destroy();
  $_SESSION['admin_id'] = false;
 }

 function send_mail($email,$message,$subject)
 {
    $messagee = $message;
    $to_email = $email;
    $subjectt = $subject;
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: No-reply';
    $result = mail($to_email, $subjectt, $messagee, implode("\r\n", $headers));
    return $result;
 }
}
