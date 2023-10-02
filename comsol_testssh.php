<?php
$connection = ssh2_connect('10.20.2.3', 22);
ssh2_auth_password($connection, 'ccop', 'ccop123');
ssh2_scp_send($connection, '/var/www/html/hpc/CB_purging4.mph', '/home/eig/ccop/comsol_hpcweb/CB_purging4.mph');
sleep(2);
$stream=ssh2_exec($connection,'cd /home/eig/ccop/comsol_hpcweb; sbatch -N 2 -p comp.q slurmcomsol2.sh');
stream_set_blocking($stream, true);
echo stream_get_contents($stream);
sleep(2);
unset($connection);
?>
