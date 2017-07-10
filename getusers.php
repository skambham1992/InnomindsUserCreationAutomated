<?php
/**
 * Created by Joe of ExchangeCore.com
 */
//if(isset($_POST['username']) && isset($_POST['password'])){

    $adServer = "ldap://corp.innominds.com";
	
    $ldap = ldap_connect($adServer);
	
    $username = 'skambham';
    $password = 'Inno123';

    $ldaprdn = 'corp.innomnds.com' . "\\" ;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn);


    if ($bind) {
		//echo $bind;
        $filter="sAMAccountName=$username";
		echo $filter;
        $result = ldap_search($ldap,"ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo '<pre>';
            var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 
        }
        @ldap_close($ldap);
    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }

//}
 ?> 
