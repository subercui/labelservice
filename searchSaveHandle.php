<?php
//1、保存或者更新到数据库
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
	$Insurance=$_REQUEST['Insurance'];
	$PersonalWage=$_REQUEST['PersonalWage'];
	$SocialWage=$_REQUEST['SocialWage'];
	$HaveMedicalFee=$_REQUEST['HaveMedicalFee'];
	$MedicalFee=$_REQUEST['MedicalFee'];
	$BearMedicalFee=$_REQUEST['BearMedicalFee'];
	$Identity=$_REQUEST['Identity'];
	
	
	$FileBelong=$_REQUEST['FileBelong'];
	$path_prefix=$_REQUEST['path_prefix'];

	if($FileBelong==0 || $FileBelong==2){
		$sql="insert into feature(username,CaseID,Problem,Anwser,GetPay,AssoPay,InjuryDegree,InjRange,BearPay,PayMeth,DisptRes,AppPay,CondUnre,WorkTime,WorkPlace,JobRel,DiseRel,
							OutForPub,OnOff,PrpOnOff,WorkDeath,Rescue,Service,Crime,Drink,Suicide,InjIden,Valid,InjDate,Year,Month,Day,AdmitInj,WillPay,AmountDispute,RangeDispute,SettlePrivate,SickDispute,
							LaborArbi,RefuAsct,LaborDisp,Employ,Qualify,EndLabor,LaborContr,HaveContr,ValidContr,ConfrmLevel,Level,Insurance,PersonalWage,SocialWage,
							HaveMedicalFee,MedicalFee,BearMedicalFee,Identity) 
							values('$username','$CaseID','$Problem','$Anwser','$GetPay','$AssoPay','$InjuryDegree','$InjRange','$BearPay','$PayMeth','$DisptRes','$AppPay','$CondUnre','$WorkTime','$WorkPlace','$JobRel','$DiseRel',
							'$OutForPub','$OnOff','$PrpOnOff','$WorkDeath','$Rescue','$Service','$Crime','$Drink','$Suicide','$InjIden','$Valid','$InjDate','$Year','$Month','$Day','$AdmitInj','$WillPay','$AmountDispute','$RangeDispute','$SettlePrivate','$SickDispute',
							'$LaborArbi','$RefuAsct','$LaborDisp','$Employ','$Qualify','$EndLabor','$LaborContr','$HaveContr','$ValidContr','$ConfrmLevel','$Level','$Insurance','$PersonalWage','$SocialWage',
							'$HaveMedicalFee','$MedicalFee','$BearMedicalFee','$Identity')";
	}else if($FileBelong==1 || $FileBelong==3){
		$sql="update feature set CaseID='$CaseID',Problem='$Problem',Anwser='$Anwser',GetPay='$GetPay',AssoPay='$AssoPay',InjuryDegree='$InjuryDegree',InjRange='$InjRange',BearPay='$BearPay',PayMeth='$PayMeth',DisptRes='$DisptRes',AppPay='$AppPay',CondUnre='$CondUnre',WorkTime='$WorkTime',WorkPlace='$WorkPlace',JobRel='$JobRel',DiseRel='$DiseRel',
							OutForPub='$OutForPub',OnOff='$OnOff',PrpOnOff='$PrpOnOff',WorkDeath='$WorkDeath',Rescue='$Rescue',Service='$Service',Crime='$Crime',Drink='$Drink',Suicide='$Suicide',InjIden='$InjIden',Valid='$Valid',InjDate='$InjDate',Year='$Year',Month='$Month',Day='$Day',AdmitInj='$AdmitInj',WillPay='$WillPay',AmountDispute='$AmountDispute',RangeDispute='$RangeDispute',SettlePrivate='$SettlePrivate',SickDispute='$SickDispute',
							LaborArbi='$LaborArbi',RefuAsct='$RefuAsct',LaborDisp='$LaborDisp',Employ='$Employ',Qualify='$Qualify',EndLabor='$EndLabor',LaborContr='$LaborContr',HaveContr='$HaveContr',ValidContr='$ValidContr',ConfrmLevel='$ConfrmLevel',Level='$Level',Insurance='$Insurance',PersonalWage='$PersonalWage',SocialWage='$SocialWage',
							HaveMedicalFee='$HaveMedicalFee',MedicalFee='$MedicalFee',BearMedicalFee='$BearMedicalFee',Identity='$Identity' where CaseID='$CaseID' and username='$username'";
	}

	if(mysql_query($sql,$con)){
		//2、将当前UnLabelled文件或者ToLabel文件移动到Labelled中
		if($FileBelong==0){
			$file=$path_prefix."/UnLabelled/".$CaseID.".txt";
			$file=iconv('UTF-8','gbk',$file);
			$moveTo=$path_prefix."/Labelled/".$CaseID.".txt";
			$moveTo=iconv('UTF-8','gbk',$moveTo);
			copy($file,$moveTo); //拷贝到新目录
			unlink($file); //删除旧目录下的文件
		}else if($FileBelong==2){
			$file=$path_prefix."/ToLabel/".$CaseID.".txt";
			$file=iconv('UTF-8','gbk',$file);
			$moveTo=$path_prefix."/Labelled/".$CaseID.".txt";
			$moveTo=iconv('UTF-8','gbk',$moveTo);
			copy($file,$moveTo); //拷贝到新目录
			unlink($file); //删除旧目录下的文件
		}
		echo 1;//成功标志

	}else{
		echo 0;//失败指标
	}
	
	
?>