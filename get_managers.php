<?php
	
	$ldap_dn = "cn=Sandeep Reddy Kambham,ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com";
	$ldap_password = "Inno123$";
	
	$ldap_con = ldap_connect("corp.innominds.com");
	
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	
	if(ldap_bind($ldap_con, $ldap_dn, $ldap_password)) {

		$filter = '(title=*Manager*)';
		$result = ldap_search($ldap_con,"ou=Users,ou=VizagIncubation,dc=corp,dc=innominds,dc=com",$filter) or exit("Unable to search");
		$entries = ldap_get_entries($ldap_con, $result);
		
		print "<pre>";
		//print_r ($entries);
		print "</pre>";
		echo $entries[0]["title"][0];
		//echo $entries.count;
		echo count($entries)-2;
	  
	} else {
		echo "Invalid user/pass or other errors!";
	}
	
	
?>