<?php
//--��ǰ����ֻ����ܶ������Σ������Σ�δ���ĺ�Դ�������Ϊ����ʱ����Ҫע����ַ���������ݡ�


set_time_limit(0);//0��ʾ����ʱ
ignore_user_abort(false);//�������Ϊ false����ҳ�Ͽ��ᵼ�½ű�ֹͣ���С�
ini_set("date.timezone","Asia/Chongqing");


for($i=0;$i<=3600;$i++){
    echo '��'.($i+1).'��</br>';
    zhuhanshu();

    sleep(rand(10,30)); //rand(1,3)��ʾ1��3���ڣ�sleep���治֧��С���㣬�������С����ֱ��ȡȥ��С�������ֵ��
    ob_flush();
    flush();//��һ����ʹcache���������ݱ�����ȥ����ʾ���Ķ�����
}

function zhuhanshu(){
    $post_fields='strSta=/UrpOnline/Home/Index/7_330_2019-01-29_1__&orgId=7&deptCode=330&sex=0&date=2019-01-29&page=1&orderType=1&orgType=1';
    $url='https://www.xmsmjk.com/UrpOnline/Home/GetIndexList';
    $referer='https://www.xmsmjk.com/UrpOnline/Home/Index/7_330_2019-01-29_1__1';//α����Դreferer



    $ch = curl_init();//��ʼ��curlģ��
    curl_setopt($ch, CURLOPT_URL, $url);//��¼�ύ�ĵ�ַ
    curl_setopt($ch, CURLOPT_HEADER, 0);//�Ƿ���ʾͷ��Ϣ
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//�Ƿ��Զ���ʾ���ص���Ϣ 1��ʾ���Զ���ʾ��0��ʾ�Զ���ʾ?
    //curl_setopt($ch, CURLOPT_COOKIE,$cookie_str);//���ֲ�ͬ��cookie��ʽ
    //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);//���ֲ�ͬ��cookie��ʽ
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0');//���������ͷ
    curl_setopt ($ch,CURLOPT_REFERER,$referer);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);//���ú�cURL����ֹ�ӷ���˽�����֤��
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);//Ϊ1 ��������SSL֤�����Ƿ����һ��������(common name)�� ������Ϊ2
    curl_setopt($ch, CURLOPT_POST, 1);//�Ƿ���post��ʽ
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    //curl_setopt($ch ,CURLOPT_PROXY,'192.168.1.39:8888');//���ô��������
    curl_setopt($ch, CURLOPT_TIMEOUT,30);//����cURL����ִ�е��������curl��ʱ���ƣ���������ddos�ȷ������·ǳ���ʱ��û�з���һֱ��ס�������Ƿ������У�����Ŀ�ǵ�Ҫ���ã���������Է���վ�����������ֵ����̫С�������׷��ؿ����ݣ���

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8','X-Requested-With: XMLHttpRequest', 'DNT: 1','Connection: keep-alive' ,'Pragma: no-cache','Cache-Control: no-cache', 'Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2', 'Accept-Encoding: gzip, deflate, br'));

    $neirong0=curl_exec($ch);//ִ��cURL
    curl_close($ch);//�ر�cURL��Դ�������ͷ�ϵͳ��Դ

    $shuliang=preg_match_all('%<div class="index_top_in">(.*?)</ul>  </div>%si', $neirong0, $tiquneirong);
    //echo '��ƥ������Ϊ��'.$shuliang.'</br>'; //���ƥ���������δ�з��ϵ���Ϊ0

    for($i=0;$i<=($shuliang-1);$i++){


        if(preg_match_all('%����%si', $tiquneirong[1][$i])){

            if(preg_match_all('%���ܶ�01/29\|��%si', $tiquneirong[1][$i])){ //|Ϊ�����ַ�����Ҫת��
                echo '������δ����Ҫ��ԤԼ�ţ�������Ӧ�������Ρ������κ���</br>';
            }else{
                echo $tiquneirong[1][$i].'</br>';
                echo '���ܶ�������Ҫ��ԤԼ�ţ��Ͻ���Ʊ,�����ʼ������Ͼ�ʱ���ټ��������ʼ�������Ƶ�������ʼ��������ֶ���ֹ����</br>';
                $youjianbiaoti='���ܶ�������Ҫ��ԤԼ�ţ��Ͻ���Ʊ,�����ʼ������Ͼ�ʱ���ټ��������ʼ�������Ƶ�������ʼ��������ֶ���ֹ����';
                file_get_contents('http://XXX.com/fayoujian.php?biaoti='.$youjianbiaoti);//���ʼ�֪ͨ���߷�����֪ͨ����ʹ�ýӿڣ��������á�

                sleep(rand(5*60,10*60)); //rand(1,3)��ʾ1��3���ڣ�sleep���治֧��С���㣬�������С����ֱ��ȡȥ��С�������ֵ��
                ob_flush();
                flush();//��һ����ʹcache���������ݱ�����ȥ����ʾ���Ķ�����


            }
        }

    }
}


?>