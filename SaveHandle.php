<?php

	$result=array();
//1、保存到数据库
	include "db_connect.php";
	$username=$_REQUEST['username'];
	$CaseID=$_REQUEST['CaseID'];
	$Problem=$_REQUEST['Problem'];
	$Anwser=$_REQUEST['Anwser'];
	$GetPay=$_REQUEST['GetPay'];
	$AssoPay=$_REQUEST['AssoPay'];
	$InjuryDegree=$_REQUEST['InjuryDegree'];
	$InjRange=$_REQUEST['InjRange'];
	$BearPay=$_REQUEST['BearPay'];
	$PayMeth=$_REQUEST['PayMeth'];
	$DisptRes=$_REQUEST['DisptRes'];
	$AppPay=$_REQUEST['AppPay'];
	$CondUnre=$_REQUEST['CondUnre'];
	$WorkTime=$_REQUEST['WorkTime'];
	$WorkPlace=$_REQUEST['WorkPlace'];
	$JobRel=$_REQUEST['JobRel'];
	$DiseRel=$_REQUEST['DiseRel'];
	$OutForPub=$_REQUEST['OutForPub'];
	$OnOff=$_REQUEST['OnOff'];
	$PrpOnOff=$_REQUEST['PrpOnOff'];
	$WorkDeath=$_REQUEST['WorkDeath'];
	$Rescue=$_REQUEST['Rescue'];
	$Service=$_REQUEST['Service'];
	$Crime=$_REQUEST['Crime'];
	$Drink=$_REQUEST['Drink'];
	$Suicide=$_REQUEST['Suicide'];
	$InjIden=$_REQUEST['InjIden'];
	$Valid=$_REQUEST['Valid'];
	$InjDate=$_REQUEST['InjDate'];
	$Year=$_REQUEST['Year'];
	$Month=$_REQUEST['Month'];
	$Day=$_REQUEST['Day'];
	$AdmitInj=$_REQUEST['AdmitInj'];
	$WillPay=$_REQUEST['WillPay'];
	$AmountDispute=$_REQUEST['AmountDispute'];
	$RangeDispute=$_REQUEST['RangeDispute'];
	$SettlePrivate=$_REQUEST['SettlePrivate'];
	$SickDispute=$_REQUEST['SickDispute'];
	$LaborArbi=$_REQUEST['LaborArbi'];
	$RefuAsct=$_REQUEST['RefuAsct'];
	$LaborDisp=$_REQUEST['LaborDisp'];
	$Employ=$_REQUEST['Employ'];
	$Qualify=$_REQUEST['Qualify'];
	$EndLabor=$_REQUEST['EndLabor'];
	$LaborContr=$_REQUEST['LaborContr'];
	$HaveContr=$_REQUEST['HaveContr'];
	$ValidContr=$_REQUEST['ValidContr'];
	$ConfrmLevel=$_REQUEST['ConfrmLevel'];
	$Level=$_REQUEST['Level'];
	$Death=$_REQUEST['Death'];
	$Slight=$_REQUEST['Slight'];
	$Insurance=$_REQUEST['Insurance'];
	$SuffctIns=$_REQUEST['SuffctIns'];
	$PersonalWage=$_REQUEST['PersonalWage'];
	$SocialWage=$_REQUEST['SocialWage'];
	$HaveMedicalFee=$_REQUEST['HaveMedicalFee'];
	$MedicalFee=$_REQUEST['MedicalFee'];
	$BearMedicalFee=$_REQUEST['BearMedicalFee'];
	$LeftMedFee=$_REQUEST['LeftMedFee'];
	$MaimAstDispute=$_REQUEST['MaimAstDispute'];
	$AllowanceDispute=$_REQUEST['AllowanceDispute'];
	$MedAstDispute=$_REQUEST['MedAstDispute'];
	$MaimOccuDispute=$_REQUEST['MaimOccuDispute'];
	$SalaryDispute=$_REQUEST['SalaryDispute'];
	$HealthFeeDispute=$_REQUEST['HealthFeeDispute'];
	$OldWoundDispute=$_REQUEST['OldWoundDispute'];
	$DeathAstDispute=$_REQUEST['DeathAstDispute'];
	$InsfctInsDispute=$_REQUEST['InsfctInsDispute'];
	$Age=$_REQUEST['Age'];
	$Location=$_REQUEST['Location'];
	$Identity=$_REQUEST['Identity'];
	$sql="insert into feature(username,CaseID,Problem,Anwser,GetPay,AssoPay,InjuryDegree,InjRange,BearPay,PayMeth,DisptRes,AppPay,CondUnre,WorkTime,WorkPlace,JobRel,DiseRel,
							OutForPub,OnOff,PrpOnOff,WorkDeath,Rescue,Service,Crime,Drink,Suicide,InjIden,Valid,InjDate,Year,Month,Day,AdmitInj,WillPay,AmountDispute,RangeDispute,SettlePrivate,SickDispute,
							LaborArbi,RefuAsct,LaborDisp,Employ,Qualify,EndLabor,LaborContr,HaveContr,ValidContr,ConfrmLevel,Level,Death,Slight,Insurance,SuffctIns,PersonalWage,SocialWage,
							HaveMedicalFee,MedicalFee,BearMedicalFee,LeftMedFee,MaimAstDispute,AllowanceDispute,MedAstDispute,MaimOccuDispute,SalaryDispute,HealthFeeDispute,OldWoundDispute,
							DeathAstDispute,InsfctInsDispute,Age,Location,Identity) 
							values('$username','$CaseID','$Problem','$Anwser','$GetPay','$AssoPay','$InjuryDegree','$InjRange','$BearPay','$PayMeth','$DisptRes','$AppPay','$CondUnre','$WorkTime','$WorkPlace','$JobRel','$DiseRel',
							'$OutForPub','$OnOff','$PrpOnOff','$WorkDeath','$Rescue','$Service','$Crime','$Drink','$Suicide','$InjIden','$Valid','$InjDate','$Year','$Month','$Day','$AdmitInj','$WillPay','$AmountDispute','$RangeDispute','$SettlePrivate','$SickDispute',
							'$LaborArbi','$RefuAsct','$LaborDisp','$Employ','$Qualify','$EndLabor','$LaborContr','$HaveContr','$ValidContr','$ConfrmLevel','$Level','$Death','$Slight','$Insurance','$SuffctIns','$PersonalWage','$SocialWage',
							'$HaveMedicalFee','$MedicalFee','$BearMedicalFee','$LeftMedFee','$MaimAstDispute','$AllowanceDispute',
							'$MedAstDispute','$MaimOccuDispute','$SalaryDispute','$HealthFeeDispute','$OldWoundDispute',
							'$DeathAstDispute','$InsfctInsDispute','$Age','$Location','$Identity')";
	
	if(mysql_query($sql,$con)){
		//2、获取下一个文件内容
		$result[]=1;//成功标志

		$path_prefix=$_REQUEST['path_prefix'];
		$filename=$_REQUEST['filename'];
		$flag=$_REQUEST['flag'];
		$dir="";
		if($flag=='0'){
			$dir=$path_prefix."/UnLabelled";
		}else{
			$dir=$path_prefix."/ToLabel";
		}
		$files=scandir($dir);
		if(count($files)==3){	
			$result[]=0;//没有文件可显示了
		}else{
			$result[]=1;
			$cur=0;
			if($flag=='0'){
				$cur=3;
			}else{
				$cur=count($files)-2;
			}
			//获取文件内容
			$file=$dir."/".$files[$cur];
			$fileToGbk = mb_convert_encoding($file, 'utf-8', 'gbk');
			$nextfilename=explode("/",$fileToGbk);
			
			//获得字符串之后马上把字符串转成另一种编码
			$content = file_get_contents($file);
			$content = mb_convert_encoding($content, 'utf-8', 'gbk');
			$str  = explode("\r\n", $content); 
			$problem=substr($str[0],9);
			$anwser=substr($str[1],15);
			
			$result[]=$problem;
			$result[]=$anwser;
			$result[]=$nextfilename[count($nextfilename)-1];
		}
		//echo $result[2];
		//3、将当前UnLabelled文件移动到Labelled中
		$filename = mb_convert_encoding($filename, 'gbk', 'utf-8');
		$file="";
		if($flag=='0'){
			$file=$path_prefix."/UnLabelled/".$filename;
		}else{
			$file=$path_prefix."/ToLabel/".$filename;
		}
		$moveTo=$path_prefix."/Labelled/".$filename;

		copy($file,$moveTo); //拷贝到新目录
		unlink($file); //删除旧目录下的文件
	}else{
		$result[]=0;//失败标志
	}
	echo json_encode($result);
	
?>