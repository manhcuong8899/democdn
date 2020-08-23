<?php

if (!function_exists('CRMSettings')) {

    /**
     * Returns application setting.
     *
     * @return array
     * @return string
     */
    function CRMSettings($key = null)
    {
        static $settings;

        if (is_null($settings)) {
            $settingsAll = App::make('VNPCMS\Setting\Repository\SettingRepositoryInterface');
            $settings = $settingsAll->getAll()->lists('value', 'key')->toArray();
        }

        return is_null($key) ? $settings : ((is_array($key)) ? array_only($settings, $key) : $settings[$key]);
    }
}

if (!function_exists('crminfo')) {

    /**
     * Returns application config and settings.
     *
     * @return string
     * @return array
     */
    function crminfo($show = 'crmname')
    {
        switch ($show) {
            case 'version':
                $output = Config::get('VNPCMS.version');
                break;
            case 'url':
                $output = CRMSettings('url');
                break;
            case 'basepath':
                $output = Config::get('VNPCMS.basepath');
                break;
            case 'admin_name':
                $output = Config::get('VNPCMS.admin_name');
                break;
            case 'admin_username':
                $output = Config::get('VNPCMS.admin_username');
                break;
            case 'admin_email':
                $output = Config::get('VNPCMS.admin_email');
                break;
            case 'orgname':
                $output = CRMSettings('orgname');
                break;
            case 'orgdescription':
                $output = CRMSettings('orgdescription');
                break;
            case 'address':
                $output = CRMSettings('address');
                break;
            case 'locale':
                $output = CRMSettings('locale');
                break;
            case 'theme':
                $output = CRMSettings('theme');
                break;
            case 'menu_groups':
                $output = Config::get('VNPCMS.menu_groups');
                break;
            case 'enable_registration':
                $output = CRMSettings('enable_registration');
                break;
            case 'new_user_role':
                $output = CRMSettings('new_user_role');
                break;
            case 'supported_locales':
                $output = Config::get('VNPCMS.supported_locales');
                break;
            case 'description':
                $output = CRMSettings('crmdescription');
                break;
            case 'footer':
                $output = CRMSettings('crmfooter');
                break;
            case 'name':
                $output = CRMSettings('crmname');
                break;
            default:
                $output = CRMSettings($show);
                break;
        }

        return $output;
    }

    function createRandomCoupons() {

        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $code = '' ;
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $code = $code . $tmp;
            $i++;
        }

        return $code;

    }

    function createRandomPassword() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789@!#ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        srand((double)microtime()*1000000);
        $i = 0;
        $code = '' ;
        while ($i <= 8) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $code = $code . $tmp;
            $i++;
        }

        return $code;

    }

    /* Hàm định dạng số điện thoại*/
    function format_phone($phone){
        $phone = preg_replace('/^0/','+84',$phone);
        return $phone;
    }
    /* Check định dạng điện thoại*/
    function validatePhone($phone) {
        $regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
        return preg_match( $regex, $phone ) ? 'true' : 'false';
    }
    function getHeader($title,$keyword,$description){
        $header = array(
            'title'=>$title,
            'keyword'=>$keyword,
            'description'=>$description,
            );
        return $header;
    }

    function geturl($link){
        $linkParts = explode('?', $link);
        $link = $linkParts[0];
        return $link;
    }

    function curPageURL() {
        $pageURL = 'http';
        /*  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}*/
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

}
