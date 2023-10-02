<?php
$connection = ssh2_connect('10.20.2.3', 22);
ssh2_auth_password($connection, 'jaideep', 'jaideep123');
ssh2_scp_send($connection, '/var/www/html/hpc/testscp1.txt', '/home/eig/jaideep/testscp3.txt');
sleep(2);
$stream=ssh2_exec($connection,'sbatch testjobsub.sh');
stream_set_blocking($stream, true);
echo stream_get_contents($stream);
sleep(2);
unset($connection);
?>
