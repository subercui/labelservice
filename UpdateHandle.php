<?php
//1、更新到数据库
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
	$GenMeth=$_REQUEST['GenMeth'];
	$AppPay=$_REQUEST['AppPay'];
	$CondUnre=$_REQUEST['CondUnre'];
	$WorkTime=$_REQUEST['WorkTime'];
	$WorkPlace=$_REQUEST['WorkPlace'];
	$JobRel=$_REQUEST['JobRel'];
	$DiseRel=$_REQUEST['DiseRel'];
	$OutForPub=$_REQUEST['OutForPub'];
	$OnOff=$_REQUEST['OnOff'];
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
	$LaborDisp=$_REQUEST['LaborDisp'];
	$Employ=$_REQUEST['Employ'];
	$ExistEmp=$_REQUEST['ExistEmp'];
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
	$sql="update feature set CaseID='$CaseID',Problem='$Problem',Anwser='$Anwser',GetPay='$GetPay',AssoPay='$AssoPay',InjuryDegree='$InjuryDegree',InjRange='$InjRange',BearPay='$BearPay',PayMeth='$PayMeth',GenMeth='$GenMeth',AppPay='$AppPay',CondUnre='$CondUnre',WorkTime='$WorkTime',WorkPlace='$WorkPlace',JobRel='$JobRel',DiseRel='$DiseRel',
							OutForPub='$OutForPub',OnOff='$OnOff',Rescue='$Rescue',Service='$Service',Crime='$Crime',Drink='$Drink',Suicide='$Suicide',InjIden='$InjIden',Valid='$Valid',InjDate='$InjDate',Year='$Year',Month='$Month',Day='$Day',AdmitInj='$AdmitInj',WillPay='$WillPay',AmountDispute='$AmountDispute',RangeDispute='$RangeDispute',SettlePrivate='$SettlePrivate',SickDispute='$SickDispute',
							LaborArbi='$LaborArbi',LaborDisp='$LaborDisp',Employ='$Employ',ExistEmp='$ExistEmp',Qualify='$Qualify',EndLabor='$EndLabor',LaborContr='$LaborContr',HaveContr='$HaveContr',ValidContr='$ValidContr',ConfrmLevel='$ConfrmLevel',Level='$Level',Insurance='$Insurance',PersonalWage='$PersonalWage',SocialWage='$SocialWage',
							HaveMedicalFee='$HaveMedicalFee',MedicalFee='$MedicalFee',BearMedicalFee='$BearMedicalFee',Identity='$Identity' where CaseID='$CaseID' and username='$username'";
	
	if(mysql_query($sql,$con)){
		echo 1;//成功标志
	}else{
		echo 0;//失败指标
	}
?>