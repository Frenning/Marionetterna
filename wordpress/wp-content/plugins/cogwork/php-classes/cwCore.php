<?php 

class cwCore {
    /* Name values have to also been added to public function userDomainName for each domain */
    private static $acceptedDomains = ["dans.se", "idrott.se", "minaaktiviteter.se"];
    
    public static function init() {
        self::cwInitGlobalUserOptions();
    }
    
    public static function userOrgCode() {
        $value = (string) self::getOption('userOrgCode');
        if (empty($value)) $value = '';
        return $value;
    }
    
    public static function userDomain() {
        $value = (string) self::getOption('userDomain');
        if (empty($value)) $value = 'minaaktiviteter.se';
        return $value;
       
    }
    
    public static function userDomainName() {
             
        $userDomain = (string) self::getOption('userDomain');
        
        switch ($userDomain) {
            case "dans.se":
                $value = "Dans.se";
                break;
            case "idrott.se":
                $value = "Idrott.se";
                break;
           default:
               $value = "Mina Aktiviteter";
        }          
        
        return $value;
        
    }
    
    private static function getOption($optionName) {
        if (empty($GLOBALS[CW_PHP_NAMESPACE][$optionName])) return null;
        return $GLOBALS[CW_PHP_NAMESPACE][$optionName];
    }
    
    /**
     * @param string $optionName
     * @return string
     */
    private static function catchAndSaveUserOption($optionName) {
        
        require_once(CW_PHP_CLASSES_DIR.'cwResources.php');
        
        if(!empty($_GET[$optionName])) {
            $value = cwResources::washCode($_GET[$optionName]);
            setcookie($optionName, $value, time() + 1314000);
            return $value;
        }
        if(!empty($_COOKIE[$optionName])) {
            return cwResources::washCode($_COOKIE[$optionName]);
        }
        
        return '';
    }
    
    private static function cwInitGlobalUserOptions() {
        
        $cwDomain = self::catchAndSaveUserOption('cwDomain');
        if(in_array($cwDomain, self::$acceptedDomains)) {
            $GLOBALS[CW_PHP_NAMESPACE]['userDomain'] = $cwDomain;            
        }
        
        $cwOrgCode = self::catchAndSaveUserOption('cwOrgCode');
        if (!empty($cwOrgCode)) {
            $GLOBALS[CW_PHP_NAMESPACE]['userOrgCode'] = $cwOrgCode;
        }
    }
    
}

?>