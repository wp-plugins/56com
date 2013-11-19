<?php
/**
 * 设定时区.
 */
define('API_TIMEZONE_OFFSET',8);
if(function_exists('date_default_timezone_set')) {
	@date_default_timezone_set('Etc/GMT'.(API_TIMEZONE_OFFSET > 0 ? '-' : '+').(abs(API_TIMEZONE_OFFSET)));
} else {
	putenv('Etc/GMT'.(API_TIMEZONE_OFFSET > 0 ? '-' : '+').(abs(API_TIMEZONE_OFFSET)));
}
/**
 * Open,some useful examples to use 56 api 
 * available apis
 *
	
    User_UserVideos //获取用户的上传的视频
	
    User_UserProfile //获取用户的个人信息
	
    User_UserComment //获得用户的评论或视频的评论
	
    User_AppVideos //获取应用上传的视频
	
    Video_GetVideoInfo //获取视频信息
	
    Video_Search //根据关键字获取搜索结果
	
    Video_Update //获取更新视频信息的接口
	
    Video_Channel //获得频道的视频
	
    Video_Recommend //获得推荐频道的视频

    Video_Hot //获得56网首页热门的视频
	
    Video_RecAlbum //获得56网昨天或某天的推荐的相册视频

    Video_Delete //删除视频

    Album_Info // get album info
 * 
 * @final
 * @package SDK
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
final class Open
{
    public static function Run()
    {
        //self::User_UserVideos();
        //self::User_UserProfile();
        //print_r(self::User_AppVideos());
        //self::User_UserComment();
        //
        //print_r(self::Video_GetVideoInfo());
        //self::Video_Search();
        //self::Video_Channel();
        //self::Video_Recommend();
        //print_r(self::Video_Hot());
        //self::Video_RecAlbum();
        //print_r(json_decode(self::Video_Update()));
        //print_r(self::Video_Delete());
        //print_r(self::Album_Info());
    }

    public static function Album_Info(){
        $conf = include dirname(dirname(__FILE__)).'/conf.php';
        $params = array(
            'aid'=>'10016769',
        );  
        return Open::GetApi('Album/Info',$params);
    }

    public static function User_UserVideos(){
        $conf = include dirname(dirname(__FILE__)).'/conf.php';
        $params = array(
            'useToken'=>true,
            'userid'=>$conf['test_user_id'],
        );  
        return Open::GetApi('User/UserVideos',$params);
    }

    public static function User_UserProfile(){
        $conf = include dirname(dirname(__FILE__)).'/conf.php';
        $params = array(
            'userid'  =>$conf['test_user_id'],
            'useToken'=>true,
        );  
        return Open::GetApi('User/UserProfile',$params);
    }

    public static function User_UserComment(){
        $params = array(
            'tid'=>'onesec',
            'useToken'=>true,
            'type'=>'user',
            'pct'=>1,
        );  
        return Open::GetApi('User/UserComment',$params);
    }

    public static function User_AppVideos(){
        $params = array(
            's'=>'time',
            'page'=>1,
            'rows'=>10,
        );  
        return Open::GetApi('User/AppVideos',$params);
    }

    public static function Video_GetVideoInfo(){
        $params = array(
            'vid'=>'69971765',
        );  
        return Open::GetApi('Video/GetVideoInfo',$params);
    }

    public static function Video_Search(){
        $params = array(
            'keyword'=> 'kobe',  //要查找的关键字
            //'c'=>1, // don't set this value,it still has a bug here
            't'=>'month', //时间，默认为month
            's'=>1,
            'page'=>1,     //当前页数
            'rows'=>10, //10 每页显示多少个
        );  
        return Open::GetApi('Video/Search',$params);
    }

    public static function Video_Update(){
        $params = array(
            //'vid'=>'69803724',
            //'vid'=>'NzE5MTE2MjI', //right video
            'vid'=>'NzAxNjMwNjg', //wrong video
            'title'=>1,
            'desc'=>1,
            'tag'=>1,
        );
        return Open::GetApi('Video/Update',$params);
    }

    public static function Video_Channel(){
        $params = array(
            'cid'=>68,
            'page'=>1,
            'num'=>10,
        );
        return Open::GetApi('Video/Channel',$params);
    }

    public static function Video_Recommend(){
        $params = array(
            'mid'=>16,
            'page'=>1,
            'num'=>10,
        );
        return Open::GetApi('Video/Recommend',$params);
    }


    public static function Video_Hot($params = array()){
        if(!$params)
            $params = array(
                'cid'=>2,
                'page'=>1,
                'num'=>10,
            );
        return Open::GetApi('Video/Hot',$params);
    }

    public static function Video_RecAlbum(){
        $params = array(
            'day'=>'20120705',
        );
        return Open::GetApi('Video/RecAlbum',$params);
    }

    public static function Video_Delete(){
        $conf = include dirname(dirname(__FILE__)).'/conf.php';
        $params = array(
            'vid'=>'NzA2MjM4Mzc',
        );  
        return Open::GetApi('Video/Delete',$params);
    }

    /**
     * @name GetApi 
     * @todo get json api 
     * @author Louis 
     * 
     * @param string $path example : Video/Hot
     * @param array $params
     * @static
     * @access public
     * @return array
     */
    public static function GetApi($path = '',$params = array())
    {
        require_once dirname(dirname(__FILE__)).'/'.$path.'.php';
        $className = (str_replace('/','_',$path));
        $class = new $className;
        return json_decode($class->Get($params),true);
    }

    /**
     * @name GetPluginApi 
     * @todo get plugin api 
     * @author Louis 
     * 
     * @param string $path example : Video/Hot
     * @param array $params 
     * @static
     * @access public
     * @return string
     */
    public static function GetPluginApi($path = '',$params = array(),$conf=false)
    {
        require_once dirname(dirname(__FILE__)).'/'.$path.'.php';
        $className = (str_replace('/','_',$path));
        $class = new $className;
        if($conf)
            return $class->setConf($conf)->Get($params);
        else
            return $class->Get($params);
    }

}
//Open::Run();
