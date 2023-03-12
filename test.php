<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/api/6',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbl90eXBlIjoiYWNjZXNzIiwiZXhwIjoxNjcyMzMxOTU5LCJpYXQiOjE2NzIzMzAxNTksImp0aSI6ImM2ZjQ1MzExMjFmOTQ1MDQ5NWE5Mzc2MGIxYjg5MzYyIiwidXNlcl9pZCI6MX0.2qEfQABDqwBunas3vdtQzhICm3fmB-RDqRRExzzFBGk'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;