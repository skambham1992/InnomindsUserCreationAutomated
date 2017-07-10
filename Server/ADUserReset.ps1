$csv = 'Server/ADUserReset.csv'
Add-Type -AssemblyName System.Web
Import-Csv $csv	| ForEach-Object {
		
$pwd = [System.Web.Security.Membership]::GeneratePassword(10,2)
$pw   = ConvertTo-SecureString $pwd -AsPlainText -Force
$user = $_.username
$EID=$_.employeeid
$emailIdCc=$user+'@innominds.com'
$email = $_.emailId
$users = Get-ADUser -filter { SamAccountName -eq $user }


$uid = Get-ADUser  -SearchBase 'DC=corp,DC=innominds,DC=com' -Filter {sAMAccountName -eq $user } -Properties Name,SamAccountName,EmployeeID,GivenName
$username = $uid.GivenName
   if ($uid.employeeID -eq $EID ){
 

$Requiredname = $user
$DisableUser = Get-ADUser  -SearchBase 'OU=Disabled Users,OU=VizagIncubation,DC=corp,DC=innominds,DC=com' -Filter {sAMAccountName -eq $Requiredname }

If ($DisableUser -eq $Null) { 

Set-ADAccountPassword -Reset -NewPassword $pw –Identity $users

Enable-ADAccount -Identity $users

Set-ADUser –Identity $users –ChangePasswordAtLogon $true

Write-Output "$user's password changed succesfully"


Get-ADUser $user | Move-ADObject -TargetPath 'OU=Admin_Reset_Users,OU=VizagIncubation,DC=corp,DC=innominds,DC=com'
}
}
#}
$SmtpServer = 'smtp.gmail.com'
				$SmtpUser = 'InnomindsUserCreation@gmail.com'
				$smtpPassword = 'Innominds123$'
				$MailtTo = $email
				$MailFrom = 'InnomindsUserCreation@gmail.com'
				$MailSubject = "INNOMINDS USER CREATION" 
				$MailMessage =  "Hello "+$username+",`n`nPlease find Your Innominds Email and Myspace Portal account details.`n`nPlease login to the Webmail at URL http://outlook.innominds.com to access the email with below credentials.
`n  username :"+$user+ " `n  password : "+$pwd+ "`n`nLogin credentials for System and Myspace (URL: https://myspace.innominds.com ) are:
`n  username :"+$user+ " `n  password : "+$pwd+"`n`nNote : Myspace portal activation may take up to 24 Hrs. Later if you need further assistance on Myspace, please write to HR(mparise@innominds.com).
`nNote : Please enroll/register at https://ssp.innominds.com and reset the password.
`n`Need Help on how to Enroll or Use SSP ?? Visit https://ssp.innominds.com/ssp.pdf `n`n`nRegards,`nIT Team,`nInnominds."
				$Credentials = New-Object System.Management.Automation.PSCredential -ArgumentList $SmtpUser, $($smtpPassword | ConvertTo-SecureString -AsPlainText -Force) 
				Send-MailMessage -To "$MailtTo" -from "$MailFrom" -Bcc "skambham@innominds.com" -Subject $MailSubject -Body $MailMessage -SmtpServer $SmtpServer -Credential $Credentials -UseSsl -Port 587 
 

  
else {

Write-Output "Invalid credentials"
 
} 

}