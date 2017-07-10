
$csv = 'Server/InnomindsUserCreation.csv'
$ou  = 'OU=Users,OU=VizagIncubation,DC=corp,DC=innominds,DC=com'
Add-Type -AssemblyName System.Web
Import-Csv $csv | ForEach-Object {
#write-Output $_.title
   $a = "{0:d}" -f (get-date)
   $managers = $_.manager
    $Manager = Get-ADUser -Filter {Name -eq $managers}
    $user =  $_.firstname
	$emailid = $_.mailid
	$creater = $_.createdby
	$Ticketid = $_.Ticketid
    $userName1 = $_.firstname.Substring(0,1) + $_.lastname
    $upn = "@corp"+"."+"innominds"+"."+"com"
    $CN = $_.firstname +" "+ $_.lastname    
    for($j=0; $j -le 5 ; $j++){
        $cname = Get-ADUser -filter { CN -eq $CN } | measure
        if($cname.Count -gt 0){
            $CN = $_.firstname +" "+ $_.lastname + ($j+1)
        }
       
    }
	
    for($i=1; $i -le $user.length; $i++){
        $userName = $_.firstname.Substring(0,$i) + $_.lastname
        $sann = Get-ADUser -filter { SamAccountName -eq $userName } | measure
        if($sann.Count -gt 0){
            
            $userName1 = $_.firstname.Substring(0,$i+1) + $_.lastname
        }
    }
    $samid = $userName1.tolower()
	
	        write-Output "Full Name    $CN"
			write-Output "UserID       $samid"
			write-Output "EmailID      $emailid"
			write-Output "Manager Name $Managers"
			
			#write-Output $CN
			#write-Output $CN
			#write-Output $CN
			#write-Output $CN
	

}