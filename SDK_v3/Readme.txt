1���ļ��ṹ˵��
| | |~demo/  // ���ļ��д��һЩʵ������
| | | |~plugin/ // plugin �ϴ��������
| | | | |-custom.php
| | | | |-customEasy.php
| | | | `-upload.php
| | | |-Example.php // һ������������
| | | `-Open.php  // ���ļ���װ�����нӿڵ�ʹ�÷���
| | |+User/   //��� ����User��Ľӿ�
| | |+Video/ //��� ����Video��Ľӿ�
| | |-ApiAbstract.php // �ӿڻ���
| | `-conf.php //�����ļ����޸�appkey����Ϣ

2��������ĸ�������
return array(
    'is_developer'=>true, // �ظģ��Ƿ��php������ʾ����ʽ����������ǵø�Ϊfalse
    'appkey'      =>'',   // �ظģ�����56����ƽ̨��Ӧ�ö�Ӧ��appKey
    'secret'      =>'',   // �ظģ�����56����ƽ̨��Ӧ�ö�Ӧ��secret
    'domain'      =>'http://oapi.56.com', // Ĭ�ϣ��������
    'token'       =>'',   // ��ѡ����ĳЩ�ӿ���Ҫʹ�õ�token��д�룬token�Ļ�ȡ��ʽhttp://dev.56.com/wiki/doc-view-7.html
    'test_user_id'=>'',   // ��ѡ����Ҫ�������user id�Ǵ��룬��������ʹ��
    );

3��һ���򵥵Ľӿ�ʹ������
<?php
//�����װ�����нӿڵ�ʹ�÷������ļ�
require_once dirname(__FILE__).'/Open.php';
$params = array(
    'cid'=>2,
    'page'=>1,
    'num'=>10,
);
// ����������Ļ���ʹ��demo�������
Open::Video_Hot($params);

4�����ӿ�����

4.1�������ࣺ
    User_UserVideos //��ȡ�û����ϴ�����Ƶ

    User_UserProfile //��ȡ�û��ĸ�����Ϣ

    User_UserComment //����û������ۻ���Ƶ������

    User_AppVideos //��ȡӦ���ϴ�����Ƶ

    Video_GetVideoInfo //��ȡ��Ƶ��Ϣ

    Video_Search //���ݹؼ��ֻ�ȡ�������

    Video_Update //��ȡ������Ƶ��Ϣ�Ľӿ�

    Video_Channel //���Ƶ������Ƶ

    Video_Recommend //����Ƽ�Ƶ������Ƶ

    Video_Hot //���56����ҳ���ŵ���Ƶ

    Video_RecAlbum //���56�������ĳ����Ƽ��������Ƶ

4.2���ϴ��ࣺ
SDK/demo/plugin/
������ customEasy.php // �����ϴ��࣬�����ύ��Ƶ����
������ custom.php	// �����ϴ��࣬���Զ����ϴ�����ʽ���ϴ���Ƶͬʱ��Ҫ��д���⡢��������ǩ
������ upload.php  // ��ª�ϴ��࣬�ϴ���Ƶͬʱ��Ҫ��д���⡢��������ǩ


������ʹ�ø�SDK�������κ����⣬����ϵLouis email:zixing.li@renren-inc.com QQ:838431609
56������ƽ̨QQȺ 233921452
����ƽ̨��ҳ http://dev.56.com/
�������ֲ� http://dev.56.com/developers.html
�����ҵ�Ӧ�� http://dev.56.com/wiki/basic-addapp.html
����ƽ̨wiki http://dev.56.com/wiki/
