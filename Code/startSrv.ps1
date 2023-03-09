$ip = (Get-NetIPConfiguration |
    Where-Object {
        $_.IPv4DefaultGateway -ne $null -and
        $_.NetAdapter.Status -ne "Disconnected"
    }).IPv4Address.IPAddress 

$ipSrv = $ip + ":888"

php -S $ipSrv