 <?php
    include 'wechatAppPay.class.php';
    //1.ͳһ�µ�����
    $wechatAppPay = new wechatAppPay($appid, $mch_id, $notify_url, $key);
    $params['body'] = '��Ʒ����';                       //��Ʒ����
    $params['out_trade_no'] = 'O20160617021323-001';    //�Զ���Ķ�����
    $params['total_fee'] = '100';                       //������� ֻ��Ϊ���� ��λΪ��
    $params['trade_type'] = 'APP';                      //�������� JSAPI | NATIVE | APP | WAP 
    $result = $wechatAppPay->unifiedOrder( $params );
    print_r($result); // result�о��Ƿ��صĸ�����Ϣ��Ϣ���ɹ��������Ҳ��������Ҫ��prepay_id
    //2.����APP��Ԥ֧������
    /** @var TYPE_NAME $result */
    $data = @$wechatAppPay->getAppPayParams( $result['prepay_id'] );
                // ��������ȡ�õ�֧����������֧������
    print_r($data);
    ?> 