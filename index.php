<?php
	include "session.php";
	include "db_connect.php";

	$username =$_SESSION['username'];
	$password=$_SESSION['password'];
    $sql=mysql_query("select * from user where username='$username' and password='$password'");
    $result=mysql_fetch_array($sql);
	$path_prefix=$result['filepath'];
	$path_prefix=str_replace("\\","/",$path_prefix);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!--bootstrap-->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

<!--日期插件-->
<link rel="stylesheet" href="beatpicker/css/BeatPicker.css"/>
<script src="beatpicker/js/jquery-1.11.0.min.js"></script>
<script src="beatpicker/js/BeatPicker.js"></script>

<style>
	
	.mynav{
		position:fixed;
		top:0px;
		left:0px;
		height:60px;
		width:100%;
		background-color:black;
	}
	
	h2{
		color:#FFF;
		font-family: Georgia, serif;
		margin-left:15px;
		float:left;
	}
	
	.left{
		width:30%;
		float:left;
		margin:80px 20px 20px 20px;
	}
	.left_bottom{
		width:30%;
		height:20%;
		position:fixed;
		margin:20px;
		left:0;
		bottom:0;
	}
	.right{
		width:60%;
		float:left;
		margin:62px 5px 5px 0px;
		padding:15px;
		border-left:2px solid black;  
		
	}
	ul{
		list-style-type:none;
	}
	li{
		display:inline;
		margin:10px;
	}
	label{
		display:inline;
	}
}
</style>
<title>标注系统</title>
</head>
<body style="background-color:aliceblue">
	<div class="mynav">
		<h2>标注系统</h2>
		<span style="font-size:18px;color:#FFF;display:block;margin-top:8px;position:absolute;right:10px;"><input type="text" class="form-control" name="whatFile" style="margin-top:10px;">
		<button type="button" id="search" class="btn btn-primary" onclick="Search()">搜索</button>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
		<label><input name="choose" type="radio" value="0" checked="checked"/>未标记(<span id="UnL"></span>)&nbsp;&nbsp;&nbsp;</label>
		<label><input name="choose" type="radio" value="1" />已标记(<span id="Lab"></span>)&nbsp;&nbsp;&nbsp;</label> 
		<label><input name="choose" type="radio" value="2" />待商量(<span id="ToL"></span>)&nbsp;&nbsp;&nbsp;</label> 
		|&nbsp;&nbsp;<?=$_SESSION['username']?>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="logout()" style="cursor:pointer">登出</a></span>
	</div>
	
	<div id="show" style="display:none">
    <div class="left">
		<div class="left_top">
		<span style="font-size:17px;font-family:Microsoft YaHei;color:#0000E3">问题【<span id="caseid"></span>】：</span><span id="problem"></span><br><br>
		<span style="font-size:17px;font-family:Microsoft YaHei;color:#0000E3">采纳回答：</span><span id="anwser"></span>
		</div>
		<div class="left_bottom">
			<div style="margin:10%;">
				<div id="wbjBt">
				<button type="button" id="jumpbutt" class="btn btn-primary" onclick="Jump()" style="margin-left:25%">跳过</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" id="savebutt" class="btn btn-primary" onclick="Save(0)">保存</button>
				</div>
				<div id="ybjBt" style="display:none">
				<button type="button" id="prebutt" class="btn btn-primary" onclick="PreDoc(0)">上一文档</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" id="updatebutt" class="btn btn-primary" onclick="Update()">更新</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" id="nextbutt" class="btn btn-primary" onclick="NextDoc(0)">下一文档</button>
				</div>
				<div id="dslBt" style="display:none">
				<button type="button" id="prebutt2" class="btn btn-primary" onclick="PreDoc(1)">上一文档</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" id="savebutt2" class="btn btn-primary" onclick="Save(1)">保存</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" id="nextbutt2" class="btn btn-primary" onclick="NextDoc(1)">下一文档</button>
				</div>
				<div id="searchBt" style="display:none">
				<button type="button" id="saOrUp" class="btn btn-primary" style="margin-left:40%" onclick="SaveOrUpdate()">保存/更新</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			</div>
		</div>
    </div>
    <div class="right">
				<ul>
					<li>1.问题
						<ul>
							<li id="GetPay">1.1 是否算工伤/是否可以拿到赔偿</li>
									<label><input name="GetPay" type="radio" value="1" onclick="changeColor('GetPay')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="GetPay" type="radio" value="0" onclick="changeColor('GetPay')"/>NO&nbsp;&nbsp;&nbsp;</label> 
							<br>
							<li id="AssoPay">1.2 是否询问赔偿金额</li>
									<label><input name="AssoPay" type="radio" value="1" onclick="changeColor('AssoPay')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="AssoPay" type="radio" value="0" onclick="changeColor('AssoPay')"/>NO&nbsp;&nbsp;&nbsp;</label> 
							<br>
							<li id="InjuryDegree">1.3 是否询问工伤分级</li>
									<label><input name="InjuryDegree" type="radio" value="1" onclick="changeColor('InjuryDegree')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="InjuryDegree" type="radio" value="0" onclick="changeColor('InjuryDegree')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
							<li id="InjRange">1.4 是否询问工伤赔偿的覆盖范围</li>
									<label><input name="InjRange" type="radio" value="1" onclick="changeColor('InjRange')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="InjRange" type="radio" value="0" onclick="changeColor('InjRange')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
							<li id="BearPay">1.5 是否询问赔偿金承担方</li>
									<label><input name="BearPay" type="radio" value="1" onclick="changeColor('BearPay')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="BearPay" type="radio" value="0" onclick="changeColor('BearPay')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
							<li id="PayMeth">1.6 是否询问赔偿支付方式选择</li>
									<label><input name="PayMeth" type="radio" value="1" onclick="changeColor('PayMeth')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="PayMeth" type="radio" value="0" onclick="changeColor('PayMeth')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
							<li id="GenMeth">1.7 是否是一般性解决方案</li>
									<label><input name="GenMeth" type="radio" value="1" onclick="changeColor('GenMeth')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="GenMeth" type="radio" value="0" onclick="changeColor('GenMeth')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
							<li id="AppPay">1.8 是否询问申请工伤赔偿的解决方案</li>
									<label><input name="AppPay" type="radio" value="1" onclick="changeColor('AppPay')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="AppPay" type="radio" value="0" onclick="changeColor('AppPay')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
							<li id="CondUnre">1.9 其他状态无关的问题</li>
									<label><input name="CondUnre" type="radio" value="1" onclick="changeColor('CondUnre')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="CondUnre" type="radio" value="0" onclick="changeColor('CondUnre')"/>NO&nbsp;&nbsp;&nbsp;</label>
							<br>
						</ul>
					</li>
					<li>2.状态
					<ul>
							<li>2.1 工伤判定依据
								<ul>
									<li id="WorkTime">2.1.1 是否是工作时间</li>
									<label><input name="WorkTime" type="radio" value="1" onclick="changeColor('WorkTime')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="WorkTime" type="radio" value="0" onclick="changeColor('WorkTime')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="WorkTime" type="radio" value="2" onclick="changeColor('WorkTime')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="WorkTime" type="radio" value="3" onclick="changeColor('WorkTime')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="WorkPlace">2.1.2 是否在工作场所</li>
									<label><input name="WorkPlace" type="radio" value="1" onclick="changeColor('WorkPlace')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="WorkPlace" type="radio" value="0" onclick="changeColor('WorkPlace')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="WorkPlace" type="radio" value="2" onclick="changeColor('WorkPlace')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="WorkPlace" type="radio" value="3" onclick="changeColor('WorkPlace')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="JobRel">2.1.3 是否从事和工作相关事务</li>
									<label><input name="JobRel" type="radio" value="1" onclick="changeColor('JobRel')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="JobRel" type="radio" value="0" onclick="changeColor('JobRel')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="JobRel" type="radio" value="2" onclick="changeColor('JobRel')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="JobRel" type="radio" value="3" onclick="changeColor('JobRel')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="DiseRel">2.1.4 是否和职业病相关</li>
									<label><input name="DiseRel" type="radio" value="1" onclick="changeColor('DiseRel')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="DiseRel" type="radio" value="0" onclick="changeColor('DiseRel')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="DiseRel" type="radio" value="2" onclick="changeColor('DiseRel')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="DiseRel" type="radio" value="3" onclick="changeColor('DiseRel')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="OutForPub">2.1.5 是否因公外出</li>
									<label><input name="OutForPub" type="radio" value="1" onclick="changeColor('OutForPub')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="OutForPub" type="radio" value="0" onclick="changeColor('OutForPub')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="OutForPub" type="radio" value="2" onclick="changeColor('OutForPub')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="OutForPub" type="radio" value="3" onclick="changeColor('OutForPub')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="OnOff">2.1.6 是否上下班</li>
									<label><input name="OnOff" type="radio" value="1" onclick="changeColor('OnOff')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="OnOff" type="radio" value="0" onclick="changeColor('OnOff')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="OnOff" type="radio" value="2" onclick="changeColor('OnOff')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="OnOff" type="radio" value="3" onclick="changeColor('OnOff')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="Rescue">2.1.7 是否抢险救灾</li>
									<label><input name="Rescue" type="radio" value="1" onclick="changeColor('Rescue')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Rescue" type="radio" value="0" onclick="changeColor('Rescue')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Rescue" type="radio" value="2" onclick="changeColor('Rescue')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Rescue" type="radio" value="3" onclick="changeColor('Rescue')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="Service">2.1.8 是否服役相关</li>
									<label><input name="Service" type="radio" value="1" onclick="changeColor('Service')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Service" type="radio" value="0" onclick="changeColor('Service')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Service" type="radio" value="2" onclick="changeColor('Service')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Service" type="radio" value="3" onclick="changeColor('Service')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="Crime">2.1.9 是否故意犯罪</li>
									<label><input name="Crime" type="radio" value="1" onclick="changeColor('Crime')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Crime" type="radio" value="0" onclick="changeColor('Crime')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Crime" type="radio" value="2" onclick="changeColor('Crime')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Crime" type="radio" value="3" onclick="changeColor('Crime')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="Drink">2.1.10 是否醉酒或吸毒</li>
									<label><input name="Drink" type="radio" value="1" onclick="changeColor('Drink')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Drink" type="radio" value="0" onclick="changeColor('Drink')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Drink" type="radio" value="2" onclick="changeColor('Drink')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Drink" type="radio" value="3" onclick="changeColor('Drink')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="Suicide">2.1.11 是否自残或自杀</li>
									<label><input name="Suicide" type="radio" value="1" onclick="changeColor('Suicide')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Suicide" type="radio" value="0" onclick="changeColor('Suicide')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Suicide" type="radio" value="2" onclick="changeColor('Suicide')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Suicide" type="radio" value="3" onclick="changeColor('Suicide')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
								</ul>
							</li>
							<li>2.2 工伤认定状态
								<ul>
									<li id="InjIden">2.2.1 是否已做工伤认定</li>
									<label><input name="InjIden" type="radio" value="1" onclick="changeColor('InjIden')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="InjIden" type="radio" value="0" onclick="changeColor('InjIden')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="InjIden" type="radio" value="2" onclick="changeColor('InjIden')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="InjIden" type="radio" value="3" onclick="changeColor('InjIden')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="Valid">2.2.2 是否在工伤认定有效期内</li>
									<label><input name="Valid" type="radio" value="1" onclick="changeColor('Valid')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Valid" type="radio" value="0" onclick="changeColor('Valid')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Valid" type="radio" value="2" onclick="changeColor('Valid')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Valid" type="radio" value="3" onclick="changeColor('Valid')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="InjDate">2.2.3 工伤发生的时间</li>
									<input id="dateid" name="InjDate" type="text" data-beatpicker="true" data-beatpicker-position="['*','*']"  data-beatpicker-module="today,clear" onclick="changeColor('InjDate')"/>
									<br>
									<li id="RelDate">2.2.4 工伤发生相对时间</li>
									距今&nbsp;<input type="text" name="Year" style="height:20px;width:30px">&nbsp;年&nbsp;<input type="text" name="Month" style="height:20px;width:30px">&nbsp;月&nbsp;<input type="text" name="Day" style="height:20px;width:30px">&nbsp;日
								</ul>
							</li>
							<li>2.3 争议
								<ul>
									<li id="AdmitInj">2.3.1 雇主是否承认工伤</li>
									<label><input name="AdmitInj" type="radio" value="1" onclick="changeColor('AdmitInj')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="AdmitInj" type="radio" value="0" onclick="changeColor('AdmitInj')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="AdmitInj" type="radio" value="2" onclick="changeColor('AdmitInj')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="AdmitInj" type="radio" value="3" onclick="changeColor('AdmitInj')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="WillPay">2.3.2 雇主是否原意赔付</li>
									<label><input name="WillPay" type="radio" value="1" onclick="changeColor('WillPay')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="WillPay" type="radio" value="0" onclick="changeColor('WillPay')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="WillPay" type="radio" value="2" onclick="changeColor('WillPay')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="WillPay" type="radio" value="3" onclick="changeColor('WillPay')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="AmountDispute">2.3.3 数额是否存在争议</li>
									<label><input name="AmountDispute" type="radio" value="1" onclick="changeColor('AmountDispute')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="AmountDispute" type="radio" value="0" onclick="changeColor('AmountDispute')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="AmountDispute" type="radio" value="2" onclick="changeColor('AmountDispute')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="AmountDispute" type="radio" value="3" onclick="changeColor('AmountDispute')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="RangeDispute">2.3.4 覆盖范围是否存在争议</li>
									<label><input name="RangeDispute" type="radio" value="1" onclick="changeColor('RangeDispute')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="RangeDispute" type="radio" value="0" onclick="changeColor('RangeDispute')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="RangeDispute" type="radio" value="2" onclick="changeColor('RangeDispute')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="RangeDispute" type="radio" value="3" onclick="changeColor('RangeDispute')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="SettlePrivate">2.3.5 雇主是否想私了</li>
									<label><input name="SettlePrivate" type="radio" value="1" onclick="changeColor('SettlePrivate')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="SettlePrivate" type="radio" value="0" onclick="changeColor('SettlePrivate')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="SettlePrivate" type="radio" value="2" onclick="changeColor('SettlePrivate')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="SettlePrivate" type="radio" value="3" onclick="changeColor('SettlePrivate')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="SickDispute">2.3.6 是否有病假争议</li>
									<label><input name="SickDispute" type="radio" value="1" onclick="changeColor('SickDispute')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="SickDispute" type="radio" value="0" onclick="changeColor('SickDispute')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="SickDispute" type="radio" value="2" onclick="changeColor('SickDispute')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="SickDispute" type="radio" value="3" onclick="changeColor('SickDispute')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="LaborArbi">2.3.7 是否经过劳动仲裁</li>
									<label><input name="LaborArbi" type="radio" value="1" onclick="changeColor('LaborArbi')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="LaborArbi" type="radio" value="0" onclick="changeColor('LaborArbi')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="LaborArbi" type="radio" value="2" onclick="changeColor('LaborArbi')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="LaborArbi" type="radio" value="3" onclick="changeColor('LaborArbi')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
								</ul>
							</li>
							<li>2.4 劳动关系
								<ul>
									<li>2.4.1 劳务性质
										<ul>
											<li id="LaborDisp">2.4.1.1 是否是劳务派遣</li>
											<label><input name="LaborDisp" type="radio" value="1" onclick="changeColor('LaborDisp')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="LaborDisp" type="radio" value="0" onclick="changeColor('LaborDisp')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="LaborDisp" type="radio" value="2" onclick="changeColor('LaborDisp')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="LaborDisp" type="radio" value="3" onclick="changeColor('LaborDisp')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
											<li id="Employ">2.4.1.2 和单位还是个人存在雇佣关系</li>
											<label><input name="Employ" type="radio" value="1" onclick="changeColor('Employ')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="Employ" type="radio" value="0" onclick="changeColor('Employ')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="Employ" type="radio" value="2" onclick="changeColor('Employ')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="Employ" type="radio" value="3" onclick="changeColor('Employ')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
											<li id="ExistEmp">2.4.1.3 是否存在雇佣关系</li>
											<label><input name="ExistEmp" type="radio" value="1" onclick="changeColor('ExistEmp')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="ExistEmp" type="radio" value="0" onclick="changeColor('ExistEmp')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="ExistEmp" type="radio" value="2" onclick="changeColor('ExistEmp')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="ExistEmp" type="radio" value="3" onclick="changeColor('ExistEmp')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
											<li id="Qualify">2.4.1.4 雇主是否有资质</li>
											<label><input name="Qualify" type="radio" value="1" onclick="changeColor('Qualify')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="Qualify" type="radio" value="0" onclick="changeColor('Qualify')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="Qualify" type="radio" value="2" onclick="changeColor('Qualify')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="Qualify" type="radio" value="3" onclick="changeColor('Qualify')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
											<li id="EndLabor">2.4.1.5 是否终止劳动关系</li>
											<label><input name="EndLabor" type="radio" value="1" onclick="changeColor('EndLabor')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="EndLabor" type="radio" value="0" onclick="changeColor('EndLabor')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="EndLabor" type="radio" value="2" onclick="changeColor('EndLabor')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="EndLabor" type="radio" value="3" onclick="changeColor('EndLabor')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
										</ul>
									</li>
									<li>2.4.2 劳动合同
										<ul>
											<li id="LaborContr">2.4.2.1 工伤发生时是否有劳动合同</li>
											<label><input name="LaborContr" type="radio" value="1" onclick="changeColor('LaborContr')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="LaborContr" type="radio" value="0" onclick="changeColor('LaborContr')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="LaborContr" type="radio" value="2" onclick="changeColor('LaborContr')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="LaborContr" type="radio" value="3" onclick="changeColor('LaborContr')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
											<li id="HaveContr">2.4.2.2 是否有劳动合同在手上</li>
											<label><input name="HaveContr" type="radio" value="1" onclick="changeColor('HaveContr')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="HaveContr" type="radio" value="0" onclick="changeColor('HaveContr')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="HaveContr" type="radio" value="2" onclick="changeColor('HaveContr')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="HaveContr" type="radio" value="3" onclick="changeColor('HaveContr')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
											<li id="ValidContr">2.4.2.3 劳动合同是否有效</li>
											<label><input name="ValidContr" type="radio" value="1" onclick="changeColor('ValidContr')"/>Yes&nbsp;&nbsp;&nbsp; </label>
											<label><input name="ValidContr" type="radio" value="0" onclick="changeColor('ValidContr')"/>NO&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="ValidContr" type="radio" value="2" onclick="changeColor('ValidContr')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
											<label><input name="ValidContr" type="radio" value="3" onclick="changeColor('ValidContr')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
											<br>
										</ul>
									</li>
								</ul>
							</li>
							<li>2.5 工伤级别鉴定
								<ul>
									<li id="ConfrmLevel">2.5.1 是否已由权威机构定级</li>
									<label><input name="ConfrmLevel" type="radio" value="1" onclick="changeColor('ConfrmLevel')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="ConfrmLevel" type="radio" value="0" onclick="changeColor('ConfrmLevel')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="ConfrmLevel" type="radio" value="2" onclick="changeColor('ConfrmLevel')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="ConfrmLevel" type="radio" value="3" onclick="changeColor('ConfrmLevel')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li>2.5.2 其他 (待补充)</li>
									<br>
									<li id="Level">2.5.3 分级（0：11，0为死亡，11为不够伤残）</li>
									<input type="text" class="form-control" name="Level">
								</ul>
							</li>
							<li>2.6 保险相关
								<ul>
									<li id="Insurance">2.6.1 是否已投保</li>
									<label><input name="Insurance" type="radio" value="1" onclick="changeColor('Insurance')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="Insurance" type="radio" value="0" onclick="changeColor('Insurance')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Insurance" type="radio" value="2" onclick="changeColor('Insurance')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="Insurance" type="radio" value="3" onclick="changeColor('Insurance')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li>2.6.2 其他 (待补充)</li>
								</ul>
							</li>
							<li>2.7 工资相关
								<ul>
									<li id="PersonalWage">2.7.1 个人平均月工资</li>
									<input type="text" class="form-control" name="PersonalWage">
									<br>
									<li id="SocialWage">2.7.2 社会平均月工资</li>
									<input type="text" class="form-control" name="SocialWage">
									<br>
								</ul>
							</li>
							<li>2.8 医疗费相关
								<ul>
									<li id="HaveMedicalFee">2.8.1 是否有医疗费开销</li>
									<label><input name="HaveMedicalFee" type="radio" value="1" onclick="changeColor('HaveMedicalFee')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="HaveMedicalFee" type="radio" value="0" onclick="changeColor('HaveMedicalFee')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="HaveMedicalFee" type="radio" value="2" onclick="changeColor('HaveMedicalFee')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="HaveMedicalFee" type="radio" value="3" onclick="changeColor('HaveMedicalFee')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
									<li id="MedicalFee">2.8.2 医疗费</li>
									<input type="text" class="form-control" name="MedicalFee">
									<br>
									<li id="BearMedicalFee">2.8.3 雇主是否已承担医疗费</li>
									<label><input name="BearMedicalFee" type="radio" value="1" onclick="changeColor('BearMedicalFee')"/>Yes&nbsp;&nbsp;&nbsp; </label>
									<label><input name="BearMedicalFee" type="radio" value="0" onclick="changeColor('BearMedicalFee')"/>NO&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="BearMedicalFee" type="radio" value="2" onclick="changeColor('BearMedicalFee')"/>ProYes&nbsp;&nbsp;&nbsp;</label> 
									<label><input name="BearMedicalFee" type="radio" value="3" onclick="changeColor('BearMedicalFee')"/>ProNo&nbsp;&nbsp;&nbsp;</label>
									<br>
								</ul>
							</li>
						</ul>
					</li>
					<li>3.提问者身份
						<ul>
							<li id="Identity">3.1 伤者、伤者家属、雇主、其他</li>
							<label><input name="Identity" type="radio" value="1" onclick="changeColor('Identity')"/>伤者&nbsp;&nbsp;&nbsp; </label>
							<label><input name="Identity" type="radio" value="0" onclick="changeColor('Identity')"/>伤者家属&nbsp;&nbsp;&nbsp;</label> 
							<label><input name="Identity" type="radio" value="2" onclick="changeColor('Identity')"/>雇主&nbsp;&nbsp;&nbsp;</label> 
							<label><input name="Identity" type="radio" value="3" onclick="changeColor('Identity')"/>其他&nbsp;&nbsp;&nbsp;</label>
							<br>
						</ul>
					</li>
				<ul>
	</div>
	</div>
	<div id="hide" style="display:none">
		没有文档显示了啵(╯3╰)
	</div>
	<script type="text/javascript">
	
	//全局变量
	var path_prefix="<?=$path_prefix?>";
	var username="<?=$username?>";
	var filename;
	var curPage;
	var FileBelong;
    var Fields=new Array("GetPay","AssoPay","InjuryDegree","InjRange","BearPay","PayMeth","GenMeth","AppPay","CondUnre","WorkTime","WorkPlace","JobRel","DiseRel","OutForPub","OnOff","Rescue","Service","Crime","Drink","Suicide","InjIden","Valid","InjDate","Year","Month","Day","AdmitInj","WillPay","AmountDispute","RangeDispute","SettlePrivate","SickDispute","LaborArbi","LaborDisp","Employ","ExistEmp","Qualify","EndLabor","LaborContr","HaveContr","ValidContr","ConfrmLevel","Level","Insurance","PersonalWage","SocialWage","HaveMedicalFee","MedicalFee","BearMedicalFee","Identity");
	
	$(document).ready(function(){
	  $.post("GetInitPro.php",{path_prefix:path_prefix},function(msg){
				data=JSON.parse(msg);
				if(data[0]==0){//未标记数量为0
					$("#UnL").html(0);
					$("#Lab").html(data[1]);
					$("#ToL").html(data[2]);
					$("#hide").show().css({"text-align":"center","font-size":"40px","margin-top":"200px"});
				}else{//未标记数量不为0
					$("#show").show();
					$("#UnL").html(data[1]);
					$("#Lab").html(data[2]);
					$("#ToL").html(data[3]);
					$("#problem").html(data[4]);
					$("#anwser").html(data[5]);
					filename=data[6];
					$("#caseid").html(filename.substr(0,filename.length-4));
				}
			});
		
	  $("#dateid").closest("div").css("display","inline");
	  //文本框失去焦点且有数值，标红
	  $("input[type='text']").blur(function(){
		  if($(this).val()!=0){
			  var id=$(this).attr("name");
			  if(id=="Year" || id=="Month" || id=="Day") $("#RelDate").css("color","red");
			  $("#"+id).css("color","red");
		  }
	  });
	  
	  //清除所选
	  $("li").click(function(){
		  var id=$(this).attr("id");
		  if(typeof(id)!="undefined"){
			  if(id=="InjDate"){
				  $("input[name='"+id+"']").val("");
			  }
			  $("input[name='"+id+"']").removeAttr("checked");
			  $("li[id='"+id+"']").attr("style","");
		  }
	  });
	  
	 
	  $("input:radio[name='choose']").change(function (){
		    
		  
			var folder;
			if($("input[name='choose']:checked").val()==0){//未标注
				//清除radio选中状态，清除li显示颜色，清除文本框内容
				$(":radio:not(input[name='choose'])").removeAttr('checked');
				$("li").attr("style","");
				$("input[type='text']").val("");
			
				$("#jumpbutt").css("visibility","visible");
				folder="UnLabelled";
				if($("#UnL").text()==0){
					$("#show").hide();
					$("#hide").show().css({"text-align":"center","font-size":"40px","margin-top":"200px"});
					return ;
				}
				$("#show").show();
				$("#ybjBt").hide();
				$("#wbjBt").show();
				$("#dslBt").hide();
				$("#searchBt").hide();
				$("#hide").hide();
				
				$.post("GetFirstPro.php",{path_prefix:path_prefix,folder:folder},function(msg){
					data=JSON.parse(msg);
					$("#problem").html(data[0]);
					$("#anwser").html(data[1]);
					filename=data[2];
					$("#caseid").html(filename.substr(0,filename.length-4));
				});
			}else if($("input[name='choose']:checked").val()==1){//已标注
				
				folder="Labelled";
				if($("#Lab").text()==0){
					$("#show").hide();
					$("#hide").show().css({"text-align":"center","font-size":"40px","margin-top":"200px"});
					return ;
				}
				$("#show").show();
				$("#ybjBt").show();
				$("#wbjBt").hide();
				$("#dslBt").hide();
				$("#searchBt").hide();
				$("#hide").hide();
				//首次下一文档置灰
				$("#nextbutt").attr("disabled","disabled");
				//如果已标记文档只有一个，上一文档置灰
				if(parseInt($("#Lab").text())==1){
					$("#prebutt").attr("disabled","disabled");
				}else{
					$("#prebutt").removeAttr("disabled");
				}
				//记录当前页面
				curPage=parseInt($("#Lab").text());
				
				$.post("GetLastPro.php",{flag:1,path_prefix:path_prefix,folder:folder,username:username},function(msg){
					data=JSON.parse(msg);
					$("#problem").html(data[0]);
					$("#anwser").html(data[1]);
					filename=data[2];
					$("#caseid").html(filename.substr(0,filename.length-4));
					showResult(data[4]);
					/*
					//给右侧标注赋值
					count=1;
					for(var key in data[4]){
						if(count>data[3]/2+4){
							if(data[4][key]!=-1){
								if(key=="InjDate" && data[4][key]=="0000-00-00") continue;
								if(key=="Year" || key=="Month" || key=="Day") changeColor("RelDate");
								if(key=="InjDate" || key=="Year" || key=="Month" || key=="Day" || key=="Level" || key=="PersonalWage" || key=="SocialWage" || key=="MedicalFee" ){
									$("input[name='"+key+"']").val(data[4][key]);
								}else{
									$("input[name='"+key+"'][value="+data[4][key]+"]").prop("checked","checked"); 
								}	
								changeColor(key);
							}
						}
						count++;
					}*/
				});
			}else{//待商量
				//清除radio选中状态，清除li显示颜色，清除文本框内容
				$(":radio:not(input[name='choose'])").removeAttr('checked');
				$("li").attr("style","");
				$("input[type='text']").val("");
				folder="ToLabel"; 
				if($("#ToL").text()==0){
					$("#show").hide();
					$("#hide").show().css({"text-align":"center","font-size":"40px","margin-top":"200px"});
					return ;
				}
				$("#show").show();
				$("#ybjBt").hide();
				$("#wbjBt").hide();
				$("#dslBt").show();
				$("#searchBt").hide();
				$("#hide").hide();
				//首次下一文档置灰
				$("#nextbutt2").attr("disabled","disabled");
				//如果待商量文档只有一个，上一文档置灰
				if(parseInt($("#ToL").text())==1){	
					$("#prebutt2").attr("disabled","disabled");
				}else{
					$("#prebutt2").removeAttr("disabled");
				}
				//记录当前页面
				curPage=parseInt($("#ToL").text());
				
				//获取文档
				$.post("GetLastPro.php",{flag:0,path_prefix:path_prefix,folder:folder},function(msg){
					//alert(msg);
					data=JSON.parse(msg);
					$("#problem").html(data[0]);
					$("#anwser").html(data[1]);
					filename=data[2];
					$("#caseid").html(filename.substr(0,filename.length-4));
				});
			}
			
	  });
	});

	 //右侧赋值
	  function showResult(data){
		  for(var f in Fields){
			  var key=Fields[f];
			  var val=data[key];
			  if(val!=-1){
				  if(key=="InjDate" && val=="0000-00-00") continue;
				  if(key=="Year" || key=="Month" || key=="Day") changeColor("RelDate");
				  if(key=="InjDate" || key=="Year" || key=="Month" || key=="Day" || key=="Level" || key=="PersonalWage" || key=="SocialWage" || key=="MedicalFee" ){
						$("input[name='"+key+"']").val(val);
				  }else{
						$("input[name='"+key+"'][value="+val+"]").prop("checked","checked"); 
				  }	
				  changeColor(key);
			  }
		  }
	  }
	  
	
	function changeColor(id){
		$("#"+id).css("color","red");
	}
	
	function Jump(){
		//清除radio选中状态，清除li显示颜色，清除文本框内容
		$(":radio:not(input[name='choose'])").removeAttr('checked');
		$("li").attr("style","");
		$("input[type='text']").val("");
		$("#UnL").html(parseInt($("#UnL").text())-1);//未标记-1
		$("#ToL").html(parseInt($("#ToL").text())+1);//待商量+1
		
		$.post("JumpHandle.php",{path_prefix:path_prefix,filename:filename},function(msg){
			data=JSON.parse(msg);
			$("#problem").html(data[0]);
			$("#anwser").html(data[1]);
			filename=data[2];
			$("#caseid").html(filename.substr(0,filename.length-4));//更换caseid
		});
		
		if(parseInt($("#UnL").text())==0){
			$("#show").hide();
			$("#hide").show().css({"text-align":"center","font-size":"40px","margin-top":"200px"});
		}
		
	}
	
	function Save(flag){
		CaseID=$("#caseid").text();
		Problem=$("#problem").text();
		Anwser=$("#anwser").text();
		GetPay=$("input[name='GetPay']:checked").val()==null?-1:$("input[name='GetPay']:checked").val();
		AssoPay=$("input[name='AssoPay']:checked").val()==null?-1:$("input[name='AssoPay']:checked").val();
		InjuryDegree=$("input[name='InjuryDegree']:checked").val()==null?-1:$("input[name='InjuryDegree']:checked").val();
		InjRange=$("input[name='InjRange']:checked").val()==null?-1:$("input[name='InjRange']:checked").val();
		BearPay=$("input[name='BearPay']:checked").val()==null?-1:$("input[name='BearPay']:checked").val();
		PayMeth=$("input[name='PayMeth']:checked").val()==null?-1:$("input[name='PayMeth']:checked").val();
		GenMeth=$("input[name='GenMeth']:checked").val()==null?-1:$("input[name='GenMeth']:checked").val();
		AppPay=$("input[name='AppPay']:checked").val()==null?-1:$("input[name='AppPay']:checked").val();
		CondUnre=$("input[name='CondUnre']:checked").val()==null?-1:$("input[name='CondUnre']:checked").val();
		WorkTime=$("input[name='WorkTime']:checked").val()==null?-1:$("input[name='WorkTime']:checked").val();;
		WorkPlace=$("input[name='WorkPlace']:checked").val()==null?-1:$("input[name='WorkPlace']:checked").val();
		JobRel=$("input[name='JobRel']:checked").val()==null?-1:$("input[name='JobRel']:checked").val();
		DiseRel=$("input[name='DiseRel']:checked").val()==null?-1:$("input[name='DiseRel']:checked").val();
		OutForPub=$("input[name='OutForPub']:checked").val()==null?-1:$("input[name='OutForPub']:checked").val();
		OnOff=$("input[name='OnOff']:checked").val()==null?-1:$("input[name='OnOff']:checked").val();
		Rescue=$("input[name='Rescue']:checked").val()==null?-1:$("input[name='Rescue']:checked").val();
		Service=$("input[name='Service']:checked").val()==null?-1:$("input[name='Service']:checked").val();
		Crime=$("input[name='Crime']:checked").val()==null?-1:$("input[name='Crime']:checked").val();
		Drink=$("input[name='Drink']:checked").val()==null?-1:$("input[name='Drink']:checked").val();
		Suicide=$("input[name='Suicide']:checked").val()==null?-1:$("input[name='Suicide']:checked").val();
		InjIden=$("input[name='InjIden']:checked").val()==null?-1:$("input[name='InjIden']:checked").val();
		Valid=$("input[name='Valid']:checked").val()==null?-1:$("input[name='Valid']:checked").val();;
		InjDate=$("input[name='InjDate']").val()==null?"0000-00-00":$("input[name='InjDate']").val();
		Month=$("input[name='Month']").val()==0?-1:$("input[name='Month']").val();
		Year=$("input[name='Year']").val()==0?-1:$("input[name='Year']").val();
		Day=$("input[name='Day']").val()==0?-1:$("input[name='Day']").val();
		AdmitInj=$("input[name='AdmitInj']:checked").val()==null?-1:$("input[name='AdmitInj']:checked").val();
		WillPay=$("input[name='WillPay']:checked").val()==null?-1:$("input[name='WillPay']:checked").val();
		AmountDispute=$("input[name='AmountDispute']:checked").val()==null?-1:$("input[name='AmountDispute']:checked").val();
		RangeDispute=$("input[name='RangeDispute']:checked").val()==null?-1:$("input[name='RangeDispute']:checked").val();
		SettlePrivate=$("input[name='SettlePrivate']:checked").val()==null?-1:$("input[name='SettlePrivate']:checked").val();
		SickDispute=$("input[name='SickDispute']:checked").val()==null?-1:$("input[name='SickDispute']:checked").val();
		LaborArbi=$("input[name='LaborArbi']:checked").val()==null?-1:$("input[name='LaborArbi']:checked").val();
		LaborDisp=$("input[name='LaborDisp']:checked").val()==null?-1:$("input[name='LaborDisp']:checked").val();
		Employ=$("input[name='Employ']:checked").val()==null?-1:$("input[name='Employ']:checked").val();
		ExistEmp=$("input[name='ExistEmp']:checked").val()==null?-1:$("input[name='ExistEmp']:checked").val();
		Qualify=$("input[name='Qualify']:checked").val()==null?-1:$("input[name='Qualify']:checked").val();
		EndLabor=$("input[name='EndLabor']:checked").val()==null?-1:$("input[name='EndLabor']:checked").val();
		LaborContr=$("input[name='LaborContr']:checked").val()==null?-1:$("input[name='LaborContr']:checked").val();
		HaveContr=$("input[name='HaveContr']:checked").val()==null?-1:$("input[name='HaveContr']:checked").val();
		ValidContr=$("input[name='ValidContr']:checked").val()==null?-1:$("input[name='ValidContr']:checked").val();
		ConfrmLevel=$("input[name='ConfrmLevel']:checked").val()==null?-1:$("input[name='ConfrmLevel']:checked").val();
		Level=$("input[name='Level']").val()==0?-1:$("input[name='Level']").val();
		Insurance=$("input[name='Insurance']:checked").val()==null?-1:$("input[name='Insurance']:checked").val();
		PersonalWage=$("input[name='PersonalWage']").val()==0?-1:$("input[name='PersonalWage']").val();
		SocialWage=$("input[name='SocialWage']").val()==0?-1:$("input[name='SocialWage']").val();
		HaveMedicalFee=$("input[name='HaveMedicalFee']:checked").val()==null?-1:$("input[name='HaveMedicalFee']:checked").val();
		MedicalFee=$("input[name='MedicalFee']").val()==0?-1:$("input[name='MedicalFee']").val();
		BearMedicalFee=$("input[name='BearMedicalFee']:checked").val()==null?-1:$("input[name='BearMedicalFee']:checked").val();
		Identity=$("input[name='Identity']:checked").val()==null?-1:$("input[name='Identity']:checked").val();
		
		var moneyReg=new RegExp("^(([0-9]|([1-9][0-9]{0,9}))((\.[0-9]{1,2})?))$");
		if(PersonalWage!=-1 && !moneyReg.test(PersonalWage)){
			alert("个人平均月工资输入有误!");
			return ;
		}
		if(SocialWage!=-1 && !moneyReg.test(SocialWage)){
			alert("社会平均月工资输入有误!");
			return ;
		}
		if(MedicalFee!=-1 && !moneyReg.test(MedicalFee)){
			alert("医疗费输入有误!");
			return ;
		}
		
		$.post("SaveHandle.php",{path_prefix:path_prefix,filename:filename,flag:flag,username:username,CaseID:CaseID,Problem:Problem,Anwser:Anwser,GetPay:GetPay,AssoPay:AssoPay,InjuryDegree:InjuryDegree,InjRange:InjRange,BearPay:BearPay,PayMeth:PayMeth,
							GenMeth:GenMeth,AppPay:AppPay,CondUnre:CondUnre,WorkTime:WorkTime,WorkPlace:WorkPlace,JobRel:JobRel,DiseRel:DiseRel,
							OutForPub:OutForPub,OnOff:OnOff,Rescue:Rescue,Service:Service,Crime:Crime,Drink:Drink,Suicide:Suicide,InjIden:InjIden,Valid:Valid,
							InjDate:InjDate,Year:Year,Month:Month,Day:Day,AdmitInj:AdmitInj,WillPay:WillPay,AmountDispute:AmountDispute,RangeDispute:RangeDispute,SettlePrivate:SettlePrivate,SickDispute:SickDispute,
							LaborArbi:LaborArbi,LaborDisp:LaborDisp,Employ:Employ,ExistEmp:ExistEmp,Qualify:Qualify,EndLabor:EndLabor,LaborContr:LaborContr,
							HaveContr:HaveContr,ValidContr:ValidContr,ConfrmLevel:ConfrmLevel,Level:Level,Insurance:Insurance,PersonalWage:PersonalWage,SocialWage:SocialWage,
							HaveMedicalFee:HaveMedicalFee,MedicalFee:MedicalFee,BearMedicalFee:BearMedicalFee,Identity:Identity},function(msg){		
			data=JSON.parse(msg);
			if(data[0]==1){//成功标志
				if(data[1]==0){//无文档显示标志
					$("#show").hide();
					$("#hide").show().css({"text-align":"center","font-size":"40px","margin-top":"200px"});
				}else{//有文档显示标志
					$("#problem").html(data[2]);
					$("#anwser").html(data[3]);
					filename=data[4];
					$("#caseid").html(filename.substr(0,filename.length-4));
					
					//清除radio选中状态，清除li显示颜色，清除文本框内容
					$(":radio:not(input[name='choose'])").removeAttr('checked');
					$("li").attr("style","");
					$("input[type='text']").val("");
				}
				if(flag=='0'){
					$("#UnL").html(parseInt($("#UnL").text())-1);
					$("#Lab").html(parseInt($("#Lab").text())+1);
				}else{
					$("#ToL").html(parseInt($("#ToL").text())-1);
					$("#Lab").html(parseInt($("#Lab").text())+1);
					if($("#ToL").text()==1){
						$("#prebutt2").attr("disabled","disabled");
						$("#nextbutt2").attr("disabled","disabled");
					}
				}
			}else{
				alert("未保存成功，请重新录入");
			}
			
		});	

	}
	
	
	
	function PreDoc(flag){
		//清除radio选中状态，清除li显示颜色，清除文本框内容
		$(":radio:not(input[name='choose'])").removeAttr('checked');
		$("li").attr("style","");
		$("input[type='text']").val("");
		
		if(flag=='0'){
			folder="Labelled";
			$("#nextbutt").removeAttr("disabled");
		}else {
			folder="ToLabel";
			$("#nextbutt2").removeAttr("disabled");
		}
		
		$.post("SearchLastPro.php",{path_prefix:path_prefix,username:username,folder:folder,curPage:curPage},function(msg){
			data=JSON.parse(msg);
			$("#problem").html(data[0]);
			$("#anwser").html(data[1]);
			filename=data[2];
			$("#caseid").html(filename.substr(0,filename.length-4));
			
			//给右侧标注赋值
			showResult(data[4]);
			/*count=1;
			for(var key in data[4]){
				if(count>data[3]/2+4){
					if(data[4][key]!=-1){
						if(key=="InjDate" && data[4][key]=="0000-00-00") continue;
						if(key=="Year" || key=="Month" || key=="Day") changeColor("RelDate");
						if(key=="InjDate" || key=="Year" || key=="Month" || key=="Day" || key=="Level" || key=="PersonalWage" || key=="SocialWage" || key=="MedicalFee" ){
							$("input[name='"+key+"']").val(data[4][key]);
						}else{
							$("input[name='"+key+"'][value="+data[4][key]+"]").prop("checked","checked"); 
						}	
						changeColor(key);
					}
				}
				count++;
			}*/		
		});
		curPage--;
		if(curPage==1){
			if(flag=='0'){
				$("#prebutt").attr("disabled","disabled");
			}else{
				$("#prebutt2").attr("disabled","disabled");
			}
			
		}

		
	}
	
	function NextDoc(flag){
		//清除radio选中状态，清除li显示颜色，清除文本框内容
		$(":radio:not(input[name='choose'])").removeAttr('checked');
		$("li").attr("style","");
		$("input[type='text']").val("");
		if(flag=='0'){
			folder="Labelled";
			$("#prebutt").removeAttr("disabled");
		}else {
			folder="ToLabel";
			$("#prebutt2").removeAttr("disabled");
		}
		$.post("SearchLastPro.php",{path_prefix:path_prefix,username:username,folder:folder,curPage:curPage+2},function(msg){
			data=JSON.parse(msg);
			$("#problem").html(data[0]);
			$("#anwser").html(data[1]);
			filename=data[2];
			$("#caseid").html(filename.substr(0,filename.length-4));
			
			//给右侧标注赋值
			showResult(data[4]);
			/*count=1;
			for(var key in data[4]){
				if(count>data[3]/2+4){
					if(data[4][key]!=-1){
						if(key=="InjDate" && data[4][key]=="0000-00-00") continue;
						if(key=="Year" || key=="Month" || key=="Day") changeColor("RelDate");
						if(key=="InjDate" || key=="Year" || key=="Month" || key=="Day" || key=="Level" || key=="PersonalWage" || key=="SocialWage" || key=="MedicalFee" ){
							$("input[name='"+key+"']").val(data[4][key]);
						}else{
							$("input[name='"+key+"'][value="+data[4][key]+"]").prop("checked","checked"); 
						}	
						changeColor(key);
					}
				}
				count++;
			}		*/
		});
		curPage++;
		if(flag=='0'){
			if(curPage==parseInt($("#Lab").text())){
				$("#nextbutt").attr("disabled","disabled");
			}
		}else{
			if(curPage==parseInt($("#ToL").text())){
				$("#nextbutt2").attr("disabled","disabled");
			}
		}
		
	}
	
	function Update(){
		CaseID=$("#caseid").text();
		Problem=$("#problem").text();
		Anwser=$("#anwser").text();
		GetPay=$("input[name='GetPay']:checked").val()==null?-1:$("input[name='GetPay']:checked").val();
		AssoPay=$("input[name='AssoPay']:checked").val()==null?-1:$("input[name='AssoPay']:checked").val();
		InjuryDegree=$("input[name='InjuryDegree']:checked").val()==null?-1:$("input[name='InjuryDegree']:checked").val();
		InjRange=$("input[name='InjRange']:checked").val()==null?-1:$("input[name='InjRange']:checked").val();
		BearPay=$("input[name='BearPay']:checked").val()==null?-1:$("input[name='BearPay']:checked").val();
		PayMeth=$("input[name='PayMeth']:checked").val()==null?-1:$("input[name='PayMeth']:checked").val();
		GenMeth=$("input[name='GenMeth']:checked").val()==null?-1:$("input[name='GenMeth']:checked").val();
		AppPay=$("input[name='AppPay']:checked").val()==null?-1:$("input[name='AppPay']:checked").val();
		CondUnre=$("input[name='CondUnre']:checked").val()==null?-1:$("input[name='CondUnre']:checked").val();
		WorkTime=$("input[name='WorkTime']:checked").val()==null?-1:$("input[name='WorkTime']:checked").val();;
		WorkPlace=$("input[name='WorkPlace']:checked").val()==null?-1:$("input[name='WorkPlace']:checked").val();
		JobRel=$("input[name='JobRel']:checked").val()==null?-1:$("input[name='JobRel']:checked").val();
		DiseRel=$("input[name='DiseRel']:checked").val()==null?-1:$("input[name='DiseRel']:checked").val();
		OutForPub=$("input[name='OutForPub']:checked").val()==null?-1:$("input[name='OutForPub']:checked").val();
		OnOff=$("input[name='OnOff']:checked").val()==null?-1:$("input[name='OnOff']:checked").val();
		Rescue=$("input[name='Rescue']:checked").val()==null?-1:$("input[name='Rescue']:checked").val();
		Service=$("input[name='Service']:checked").val()==null?-1:$("input[name='Service']:checked").val();
		Crime=$("input[name='Crime']:checked").val()==null?-1:$("input[name='Crime']:checked").val();
		Drink=$("input[name='Drink']:checked").val()==null?-1:$("input[name='Drink']:checked").val();
		Suicide=$("input[name='Suicide']:checked").val()==null?-1:$("input[name='Suicide']:checked").val();
		InjIden=$("input[name='InjIden']:checked").val()==null?-1:$("input[name='InjIden']:checked").val();
		Valid=$("input[name='Valid']:checked").val()==null?-1:$("input[name='Valid']:checked").val();;
		InjDate=$("input[name='InjDate']").val()==null?"0000-00-00":$("input[name='InjDate']").val();
		Month=$("input[name='Month']").val()==0?-1:$("input[name='Month']").val();
		Year=$("input[name='Year']").val()==0?-1:$("input[name='Year']").val();
		Day=$("input[name='Day']").val()==0?-1:$("input[name='Day']").val();
		AdmitInj=$("input[name='AdmitInj']:checked").val()==null?-1:$("input[name='AdmitInj']:checked").val();
		WillPay=$("input[name='WillPay']:checked").val()==null?-1:$("input[name='WillPay']:checked").val();
		AmountDispute=$("input[name='AmountDispute']:checked").val()==null?-1:$("input[name='AmountDispute']:checked").val();
		RangeDispute=$("input[name='RangeDispute']:checked").val()==null?-1:$("input[name='RangeDispute']:checked").val();
		SettlePrivate=$("input[name='SettlePrivate']:checked").val()==null?-1:$("input[name='SettlePrivate']:checked").val();
		SickDispute=$("input[name='SickDispute']:checked").val()==null?-1:$("input[name='SickDispute']:checked").val();
		LaborArbi=$("input[name='LaborArbi']:checked").val()==null?-1:$("input[name='LaborArbi']:checked").val();
		LaborDisp=$("input[name='LaborDisp']:checked").val()==null?-1:$("input[name='LaborDisp']:checked").val();
		Employ=$("input[name='Employ']:checked").val()==null?-1:$("input[name='Employ']:checked").val();
		ExistEmp=$("input[name='ExistEmp']:checked").val()==null?-1:$("input[name='ExistEmp']:checked").val();
		Qualify=$("input[name='Qualify']:checked").val()==null?-1:$("input[name='Qualify']:checked").val();
		EndLabor=$("input[name='EndLabor']:checked").val()==null?-1:$("input[name='EndLabor']:checked").val();
		LaborContr=$("input[name='LaborContr']:checked").val()==null?-1:$("input[name='LaborContr']:checked").val();
		HaveContr=$("input[name='HaveContr']:checked").val()==null?-1:$("input[name='HaveContr']:checked").val();
		ValidContr=$("input[name='ValidContr']:checked").val()==null?-1:$("input[name='ValidContr']:checked").val();
		ConfrmLevel=$("input[name='ConfrmLevel']:checked").val()==null?-1:$("input[name='ConfrmLevel']:checked").val();
		Level=$("input[name='Level']").val()==0?-1:$("input[name='Level']").val();
		Insurance=$("input[name='Insurance']:checked").val()==null?-1:$("input[name='Insurance']:checked").val();
		PersonalWage=$("input[name='PersonalWage']").val()==0?-1:$("input[name='PersonalWage']").val();
		SocialWage=$("input[name='SocialWage']").val()==0?-1:$("input[name='SocialWage']").val();
		HaveMedicalFee=$("input[name='HaveMedicalFee']:checked").val()==null?-1:$("input[name='HaveMedicalFee']:checked").val();
		MedicalFee=$("input[name='MedicalFee']").val()==0?-1:$("input[name='MedicalFee']").val();
		BearMedicalFee=$("input[name='BearMedicalFee']:checked").val()==null?-1:$("input[name='BearMedicalFee']:checked").val();
		Identity=$("input[name='Identity']:checked").val()==null?-1:$("input[name='Identity']:checked").val();
		
		var moneyReg=new RegExp("^(([0-9]|([1-9][0-9]{0,9}))((\.[0-9]{1,2})?))$");
		if(PersonalWage!=-1 && !moneyReg.test(PersonalWage)){
			alert("个人平均月工资输入有误!");
			return ;
		}
		if(SocialWage!=-1 && !moneyReg.test(SocialWage)){
			alert("社会平均月工资输入有误!");
			return ;
		}
		if(MedicalFee!=-1 && !moneyReg.test(MedicalFee)){
			alert("医疗费输入有误!");
			return ;
		}
		
		$.post("UpdateHandle.php",{username:username,CaseID:CaseID,Problem:Problem,Anwser:Anwser,GetPay:GetPay,AssoPay:AssoPay,InjuryDegree:InjuryDegree,InjRange:InjRange,BearPay:BearPay,PayMeth:PayMeth,
							GenMeth:GenMeth,AppPay:AppPay,CondUnre:CondUnre,WorkTime:WorkTime,WorkPlace:WorkPlace,JobRel:JobRel,DiseRel:DiseRel,
							OutForPub:OutForPub,OnOff:OnOff,Rescue:Rescue,Service:Service,Crime:Crime,Drink:Drink,Suicide:Suicide,InjIden:InjIden,Valid:Valid,
							InjDate:InjDate,Year:Year,Month:Month,Day:Day,AdmitInj:AdmitInj,WillPay:WillPay,AmountDispute:AmountDispute,RangeDispute:RangeDispute,SettlePrivate:SettlePrivate,SickDispute:SickDispute,
							LaborArbi:LaborArbi,LaborDisp:LaborDisp,Employ:Employ,ExistEmp:ExistEmp,Qualify:Qualify,EndLabor:EndLabor,LaborContr:LaborContr,
							HaveContr:HaveContr,ValidContr:ValidContr,ConfrmLevel:ConfrmLevel,Level:Level,Insurance:Insurance,PersonalWage:PersonalWage,SocialWage:SocialWage,
							HaveMedicalFee:HaveMedicalFee,MedicalFee:MedicalFee,BearMedicalFee:BearMedicalFee,Identity:Identity},function(msg){
			if(msg=='0'){
				alert("未更新成功，请重新更新");
			}
		});
	}
	
	function Search(){
		$("#ybjBt").hide();
		$("#wbjBt").hide();
		$("#dslBt").hide();
		var searchFile=$("input[name='whatFile']").val();
		
		//清除radio选中状态，清除li显示颜色，清除文本框内容
		$(":radio:not(input[name='choose'])").removeAttr('checked');
		$("li").attr("style","");
		$("input[type='text']").val("");

		//先搜文件，锁定位置
		$.post("searchHandle.php",{path_prefix:path_prefix,searchFile:searchFile},function(msg){
			data=JSON.parse(msg);
			if(data[0]==1){
				$("#problem").html(data[1]);
				$("#anwser").html(data[2]);
				$("#caseid").html(searchFile);
				$("#searchBt").show();
				FileBelong=0;//该文件属于未标记
			}else if(data[0]==2){
				$("#problem").html(data[1]);
				$("#anwser").html(data[2]);
				$("#caseid").html(searchFile);
				$("#searchBt").show();
				FileBelong=1;//该文件属于已标记
				//给右侧标注赋值
				showResult(data[4]);
				/*count=1;
				for(var key in data[4]){
					if(count>data[3]/2+4){
						if(data[4][key]!=-1){
							if(key=="InjDate" && data[4][key]=="0000-00-00") continue;
							if(key=="Year" || key=="Month" || key=="Day") changeColor("RelDate");
							if(key=="InjDate" || key=="Year" || key=="Month" || key=="Day" || key=="Level" || key=="PersonalWage" || key=="SocialWage" || key=="MedicalFee" ){
								$("input[name='"+key+"']").val(data[4][key]);
							}else{
								$("input[name='"+key+"'][value="+data[4][key]+"]").prop("checked","checked"); 
							}	
							changeColor(key);
						}
					}
					count++;
				}*/
			}else if(data[0]==3){
				$("#problem").html(data[1]);
				$("#anwser").html(data[2]);
				$("#caseid").html(searchFile);
				$("#searchBt").show();
				FileBelong=2;//该文件属于待商量
			}else{
				alert("没有找到文件");
			}
			$("input[name='choose']").removeAttr('checked');
		});
		//如果存入数据库那么显示feature
	}
	
	function SaveOrUpdate(){
		CaseID=$("#caseid").text();
		Problem=$("#problem").text();
		Anwser=$("#anwser").text();
		GetPay=$("input[name='GetPay']:checked").val()==null?-1:$("input[name='GetPay']:checked").val();
		AssoPay=$("input[name='AssoPay']:checked").val()==null?-1:$("input[name='AssoPay']:checked").val();
		InjuryDegree=$("input[name='InjuryDegree']:checked").val()==null?-1:$("input[name='InjuryDegree']:checked").val();
		InjRange=$("input[name='InjRange']:checked").val()==null?-1:$("input[name='InjRange']:checked").val();
		BearPay=$("input[name='BearPay']:checked").val()==null?-1:$("input[name='BearPay']:checked").val();
		PayMeth=$("input[name='PayMeth']:checked").val()==null?-1:$("input[name='PayMeth']:checked").val();
		GenMeth=$("input[name='GenMeth']:checked").val()==null?-1:$("input[name='GenMeth']:checked").val();
		AppPay=$("input[name='AppPay']:checked").val()==null?-1:$("input[name='AppPay']:checked").val();
		CondUnre=$("input[name='CondUnre']:checked").val()==null?-1:$("input[name='CondUnre']:checked").val();
		WorkTime=$("input[name='WorkTime']:checked").val()==null?-1:$("input[name='WorkTime']:checked").val();;
		WorkPlace=$("input[name='WorkPlace']:checked").val()==null?-1:$("input[name='WorkPlace']:checked").val();
		JobRel=$("input[name='JobRel']:checked").val()==null?-1:$("input[name='JobRel']:checked").val();
		DiseRel=$("input[name='DiseRel']:checked").val()==null?-1:$("input[name='DiseRel']:checked").val();
		OutForPub=$("input[name='OutForPub']:checked").val()==null?-1:$("input[name='OutForPub']:checked").val();
		OnOff=$("input[name='OnOff']:checked").val()==null?-1:$("input[name='OnOff']:checked").val();
		Rescue=$("input[name='Rescue']:checked").val()==null?-1:$("input[name='Rescue']:checked").val();
		Service=$("input[name='Service']:checked").val()==null?-1:$("input[name='Service']:checked").val();
		Crime=$("input[name='Crime']:checked").val()==null?-1:$("input[name='Crime']:checked").val();
		Drink=$("input[name='Drink']:checked").val()==null?-1:$("input[name='Drink']:checked").val();
		Suicide=$("input[name='Suicide']:checked").val()==null?-1:$("input[name='Suicide']:checked").val();
		InjIden=$("input[name='InjIden']:checked").val()==null?-1:$("input[name='InjIden']:checked").val();
		Valid=$("input[name='Valid']:checked").val()==null?-1:$("input[name='Valid']:checked").val();;
		InjDate=$("input[name='InjDate']").val()==null?"0000-00-00":$("input[name='InjDate']").val();
		Month=$("input[name='Month']").val()==0?-1:$("input[name='Month']").val();
		Year=$("input[name='Year']").val()==0?-1:$("input[name='Year']").val();
		Day=$("input[name='Day']").val()==0?-1:$("input[name='Day']").val();
		AdmitInj=$("input[name='AdmitInj']:checked").val()==null?-1:$("input[name='AdmitInj']:checked").val();
		WillPay=$("input[name='WillPay']:checked").val()==null?-1:$("input[name='WillPay']:checked").val();
		AmountDispute=$("input[name='AmountDispute']:checked").val()==null?-1:$("input[name='AmountDispute']:checked").val();
		RangeDispute=$("input[name='RangeDispute']:checked").val()==null?-1:$("input[name='RangeDispute']:checked").val();
		SettlePrivate=$("input[name='SettlePrivate']:checked").val()==null?-1:$("input[name='SettlePrivate']:checked").val();
		SickDispute=$("input[name='SickDispute']:checked").val()==null?-1:$("input[name='SickDispute']:checked").val();
		LaborArbi=$("input[name='LaborArbi']:checked").val()==null?-1:$("input[name='LaborArbi']:checked").val();
		LaborDisp=$("input[name='LaborDisp']:checked").val()==null?-1:$("input[name='LaborDisp']:checked").val();
		Employ=$("input[name='Employ']:checked").val()==null?-1:$("input[name='Employ']:checked").val();
		ExistEmp=$("input[name='ExistEmp']:checked").val()==null?-1:$("input[name='ExistEmp']:checked").val();
		Qualify=$("input[name='Qualify']:checked").val()==null?-1:$("input[name='Qualify']:checked").val();
		EndLabor=$("input[name='EndLabor']:checked").val()==null?-1:$("input[name='EndLabor']:checked").val();
		LaborContr=$("input[name='LaborContr']:checked").val()==null?-1:$("input[name='LaborContr']:checked").val();
		HaveContr=$("input[name='HaveContr']:checked").val()==null?-1:$("input[name='HaveContr']:checked").val();
		ValidContr=$("input[name='ValidContr']:checked").val()==null?-1:$("input[name='ValidContr']:checked").val();
		ConfrmLevel=$("input[name='ConfrmLevel']:checked").val()==null?-1:$("input[name='ConfrmLevel']:checked").val();
		Level=$("input[name='Level']").val()==0?-1:$("input[name='Level']").val();
		Insurance=$("input[name='Insurance']:checked").val()==null?-1:$("input[name='Insurance']:checked").val();
		PersonalWage=$("input[name='PersonalWage']").val()==0?-1:$("input[name='PersonalWage']").val();
		SocialWage=$("input[name='SocialWage']").val()==0?-1:$("input[name='SocialWage']").val();
		HaveMedicalFee=$("input[name='HaveMedicalFee']:checked").val()==null?-1:$("input[name='HaveMedicalFee']:checked").val();
		MedicalFee=$("input[name='MedicalFee']").val()==0?-1:$("input[name='MedicalFee']").val();
		BearMedicalFee=$("input[name='BearMedicalFee']:checked").val()==null?-1:$("input[name='BearMedicalFee']:checked").val();
		Identity=$("input[name='Identity']:checked").val()==null?-1:$("input[name='Identity']:checked").val();
		
		
		var moneyReg=new RegExp("^(([0-9]|([1-9][0-9]{0,9}))((\.[0-9]{1,2})?))$");
		if(PersonalWage!=-1 && !moneyReg.test(PersonalWage)){
			alert("个人平均月工资输入有误!");
			return ;
		}
		if(SocialWage!=-1 && !moneyReg.test(SocialWage)){
			alert("社会平均月工资输入有误!");
			return ;
		}
		if(MedicalFee!=-1 && !moneyReg.test(MedicalFee)){
			alert("医疗费输入有误!");
			return ;
		}
		
		$.post("searchSaveHandle.php",{FileBelong:FileBelong,path_prefix:path_prefix,username:username,CaseID:CaseID,Problem:Problem,Anwser:Anwser,GetPay:GetPay,AssoPay:AssoPay,InjuryDegree:InjuryDegree,InjRange:InjRange,BearPay:BearPay,PayMeth:PayMeth,
							GenMeth:GenMeth,AppPay:AppPay,CondUnre:CondUnre,WorkTime:WorkTime,WorkPlace:WorkPlace,JobRel:JobRel,DiseRel:DiseRel,
							OutForPub:OutForPub,OnOff:OnOff,Rescue:Rescue,Service:Service,Crime:Crime,Drink:Drink,Suicide:Suicide,InjIden:InjIden,Valid:Valid,
							InjDate:InjDate,Year:Year,Month:Month,Day:Day,AdmitInj:AdmitInj,WillPay:WillPay,AmountDispute:AmountDispute,RangeDispute:RangeDispute,SettlePrivate:SettlePrivate,SickDispute:SickDispute,
							LaborArbi:LaborArbi,LaborDisp:LaborDisp,Employ:Employ,ExistEmp:ExistEmp,Qualify:Qualify,EndLabor:EndLabor,LaborContr:LaborContr,
							HaveContr:HaveContr,ValidContr:ValidContr,ConfrmLevel:ConfrmLevel,Level:Level,Insurance:Insurance,PersonalWage:PersonalWage,SocialWage:SocialWage,
							HaveMedicalFee:HaveMedicalFee,MedicalFee:MedicalFee,BearMedicalFee:BearMedicalFee,Identity:Identity},function(msg){
			if(msg==1){
				if(FileBelong!=1 && FileBelong!=3){
					$("#Lab").html(parseInt($("#Lab").text())+1);
				}
				if(FileBelong==0){
					$("#UnL").html(parseInt($("#UnL").text())-1);
					FileBelong=3;//防止又点一次，如果再点击则是更新
				}else if(FileBelong==2){
					$("#ToL").html(parseInt($("#ToL").text())-1);
					FileBelong=3;//防止又点一次，如果再点击则是更新
				}
			}else{
				alert("没有保存或更新成功，请重试！");
			}
		});
	}
	function logout(){
		$.post("logoutAction.php",{},function(msg){
			window.location.href="index.php";
		})
	}
	</script>
	
	<!--Jquery(necessary for bootstrap plugins)-->
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	
	
	<!--<script src="http://code.jquery.com/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="flavr/js/common.js"></script>-->
</body>

</html>

