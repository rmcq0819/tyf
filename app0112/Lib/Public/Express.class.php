<?php
/**
 * Express.class.php ��ݲ�ѯ�� v1.0
 *
 * @copyright        ���Ǹ���
 * @license          http://www.25531.com
 * @lastmodify       2014-08-22
 */
class Express
{
    /*
     * ��ҳ���ݻ�ȡ����
    */
    private function getcontent($url)
    {
        if (function_exists("file_get_contents")) {
            $file_contents = file_get_contents($url);
        } else {
            $ch      = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }
    /*
     * ��ȡ��Ӧ���ƺͶ�Ӧ��ֵ�ķ���
    */
    private function expressname($order)
    {
        $name   = json_decode($this->getcontent("http://www.kuaidi100.com/autonumber/auto?num={$order}"), true);
        $result = $name[0]['comCode'];
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }
    /*
     * ����$data array      ��������ѯʧ�ܷ���false
     * @param $order        ��ݵĵ���
     * $data['ischeck'] ==1 �Ѿ�ǩ��
     * $data['data']        ���ʵʱ��ѯ��״̬ array
    */
	
    public function getorder($order,$userfree){
		if($userfree==1){
			$result = $this->getcontent("http://www.kuaidi100.com/query?type=qexpress&postid={$order}");
			$data   = json_decode($result, true);
			return $data;
		}elseif($userfree==3){
			$result = $this->getcontent("http://www.kuaidi100.com/query?type=suteng&postid={$order}");
			$data   = json_decode($result, true);
			return $data;
		}else{
			$keywords = $this->expressname($order);
			if(!$keywords) {
				return false;
			}else{
				$result = $this->getcontent("http://www.kuaidi100.com/query?type={$keywords}&postid={$order}");
				$data   = json_decode($result, true);
				return $data;
			}
		}
    }
	
	public function get_free($freecode){
		//��ݲ�ѯ��ַ http://www.ickd.cn/
		$url = "http://biz.trace.ickd.cn/chengguang/{$freecode}?mailNo={$freecode}&spellName=&exp-textName=&ts=123456&enMailNo=123456789&callback=_jqjsp&_1480405015036=";
		$data = file_get_contents($url);
		$domain = strstr($data, '{');
		$datas = rtrim($domain,')');
		$res = json_decode($datas);
		$array = json_decode(json_encode($res), true);
		foreach($array['data'] as $key => $val){
			$arr[] = $val;
		}
		return $arr;
	}
}
?>