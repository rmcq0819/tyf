<?php
/**
 * 通用通知接口demo
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/
	include_once("./log_.php");
	include_once("./WxPayPubHelper/WxPayPubHelper.php");

    //使用通用通知接口
	$notify = new Notify_pub();

	//存储微信的回调
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
	$notify->saveData($xml);
	
	//验证签名，并回应微信。
	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
	if($notify->checkSign() == FALSE){
		$notify->setReturnParameter("return_code","FAIL");//返回状态码
		$notify->setReturnParameter("return_msg","签名失败");//返回信息
	}else{
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
	}
	$returnXml = $notify->returnXml();
	echo $returnXml;
	
	//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
	
	//以log文件形式记录回调信息
	$log_ = new Log_();
	$log_name="./notify_url.log";//log文件路径
	$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");

	if($notify->checkSign() == TRUE)
	{
		if ($notify->data["return_code"] == "FAIL") {
			//此处应该更新一下订单状态，商户自行增删操作
			$log_->log_result($log_name,"【通信出错】:\n".$xml."\n");
		}
		elseif($notify->data["result_code"] == "FAIL"){
			//此处应该更新一下订单状态，商户自行增删操作
			$log_->log_result($log_name,"【业务出错】:\n".$xml."\n");
		}
		else{
			//此处应该更新一下订单状态，商户自行增删操作
		/******************************************************************************************/
			
			$log_->log_result($log_name,"【支付成功】:\n".$xml."\n");
			
			$xmlObj = simplexml_load_string($xml);
			$out_trade_no = (string)$xmlObj->out_trade_no;
			$log_->log_result($log_name,"【支付成功】:\n".$xml."\n");
			if(!empty($out_trade_no)) {
				$str = "【支付成功】:<br/><br/>";
				$conn = mysql_connect("localhost","root","gqjsj123654");
				$time = time();
		    	mysql_select_db("tyf",$conn);
		    	$strlen = strlen($out_trade_no);
		    	if($strlen == 14){
		    		mysql_query("update weixin_user_apply set support_time=".$time." where orderid = '".$out_trade_no."'",$conn);
		    	}else{
		    		//mysql_query("update weixin_item_order set status=2,support_time=".$time." where orderId='".$out_trade_no."'",$conn);
					mysql_query("update weixin_item_order set status=2,support_time=".$time." where orderId LIKE '".$out_trade_no."%'",$conn);
					
					//2016-04-25 by shuguang 添加 start
					$out_no = substr ($out_trade_no,0, -3);//从右往左截取3个字符 
					mysql_query("update weixin_item_order set status=2,support_time=".$time." where orderId LIKE '%".$out_no."%'",$conn);
					//2016-04-25 by shuguang 添加 end
					
					//更新购买数量
					//$sql = mysql_query("select * from weixin_order_detail where orderId LIKE '".$out_trade_no."%'",$conn);//查错了 傻逼 2016-04-25 by shuguang
					$sql = mysql_query("select * from weixin_order_detail where orderId LIKE '%".$out_no."%'",$conn);//2016-04-25 by shuguang
					while($row=mysql_fetch_array($sql)){
						
						//获取商品的ID
						$itemId = $row['itemId'];
						$sql2 =  mysql_query("select * from weixin_item where id=".$itemId,$conn);
						while($row2=mysql_fetch_array($sql2)){
							$buy_num = $row2['buy_num'];
						}
						//获取改商品的购买数量
						$quantity = $row['quantity']+$buy_num;
						//更新下单的库存
						mysql_query("update weixin_item set buy_num=".$quantity." where id=".$itemId,$conn);
						
					}
		    	}
				//M("item_order")->where(array("orderId"=>$out_trade_no))->save(array("status"=>2));
			} else {
				$str = "【业务出错】:<br/><br/>";
			}
		}
		
		//商户自行增加处理流程,
		//例如：更新订单状态
		//例如：数据库操作
		//例如：推送支付完成信息
	}
?>