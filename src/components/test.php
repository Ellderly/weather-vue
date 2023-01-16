<?php

   session_start();

   /*ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);*/

   // Отсеиваем случайные переходы на страницу отправки
   if(empty($_POST)) exit;

   require_once dirname(__FILE__) . '/assets/php/spyc.php'; $dataConfig = spyc_load_file('assets/config.yaml'); // connecting domain configuration
   require_once dirname(__FILE__) . '/assets/php/main.php';

   $thankspage = "../thanks.php?";
   if (isset($_GET['offer'])) { $_SESSION['leadType'] = 'offer'; $_SESSION['successPath'] = "offer/"; unset($_GET['offer']); }
   if (isset($_GET['data'])) { $_SESSION['leadType'] = 'white'; $_SESSION['successPath'] = "data/"; unset($_GET['data']); }

   if (preg_match('/[A-Za-z0-9._-]+[A-Za-z0-9]@[A-Za-z-]+\.[A-Za-z]{2,5}[^.]/', $_POST["email"], $email) == 0)
      $_POST["email"] = preg_replace('/[^A-Za-z0-9]/ui', '', preg_replace("/\@.+/", "", $_POST["email"])) . "@gmail.com";
   else
      $_POST["email"] = $email[0];
   $_POST["phone"] = preg_replace('/[^0-9]/ui', '', $_POST["phone"]);

   //if (!isset($_POST['email']) || trim($_POST['email']) == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
   //   $_POST['email'] = str_replace(array(" ", "'" , "`"), "", strtolower(translateWithGoogle($_POST['forename'], "auto", "en")).strtolower(translateWithGoogle($_POST['surname'], "auto", "en")).rand(10000, 99999)."@gmail.com");

   $requestLog = json_encode(array_merge(array("date" => date('Y-m-d H:i:s')), $_POST));
   logFile($requestLog, dirname(__FILE__) . '/assets/log/beforeSend.log');
   error_log($requestLo, 0);

   if (isset($_SESSION['leadAlreadyCreated']) && !empty($_SESSION['leadAlreadyCreated'])) {

      $response = array(
         "status" => "ok",
         "error" => "",
         "id" => "1111111"
      );

   }
   else {

      if ($dataConfig['testMode']) {

         require_once dirname(__FILE__) . '/assets/php/telegramDevTest.php';

         $response = array(
            "status" => "test"
         );
         $data = array_merge($data, $response);

      }
      else if ($dataConfig['turnOnAlter']) {

         require_once dirname(__FILE__) . '/assets/crm/alter.php';

         $response = array(
            "status"    => $result['status'],
            "error"     => $result['error'],
            "id"        => $result['id'],
            "url"       => $result['url']
         );
         if ($response["status"] == "ok" || $response["status"] == "duplicate") $_SESSION['leadAlreadyCreated'] = true;
         $data = array_merge($data, $response);
         $requestLog = json_encode(array_merge(
            array(
               "date" => date('Y-m-d H:i:s'),
               "leadAlreadyCreated" => $_SESSION['leadAlreadyCreated'],
               "crm" => 'alter'
            ), $data
         ));

      }
      else if ($dataConfig['turnOnTSL']) {

         require_once dirname(__FILE__) . '/assets/crm/tsl.php';

         $response = array(
            "status"    => $result['data']['leadStatus'],
            "error"     => $result['message'],
            "id"        => $result['data']['leadId']
         );
         if ($result['data']['leadStatus'] == 'ТРЕШ') $result['data']['leadStatus'] = 'TRASH';
         if ($result['data']['leadStatus'] == 'НЕ ВАЛИДНЫЙ') $result['data']['leadStatus'] = 'NOT_VALID';
         if (!empty($response['id'])) $_SESSION['leadAlreadyCreated'] = true;
         $data = array_merge($data, $response);
         $requestLog = json_encode(array_merge(
            array(
               "date" => date('Y-m-d H:i:s'),
               "leadAlreadyCreated" => $_SESSION['leadAlreadyCreated'],
               "crm" => 'tsl'
            ), $data
         ));

      }
      else if ($dataConfig['turnOnOctopeak']) {

         require_once dirname(__FILE__) . '/assets/crm/octopeak.php';

         $response = array(
            "status"    => $result['connectionStatus'],
            "error"     => $result['is_lead'],
            "id"        => $result['lead_id'],
            "url"       => $result['autologin_url']
         );
         $data = array_merge($data, $response);
         $requestLog = json_encode(array_merge(
            array(
               "date" => date('Y-m-d H:i:s'),
               "leadAlreadyCreated" => $_SESSION['leadAlreadyCreated'],
               "crm" => 'octopeak'
            ), $data
         ));
         if (!empty($response['id'])) $_SESSION['leadAlreadyCreated'] = true;

      }
      else if ($dataConfig['turnOnCryptolemonad']) {

         require_once dirname(__FILE__) . '/assets/crm/cryptolemonad.php';

         $response = array(
            "status"    => $result['data']['status'],
            "error"     => $result['message']['message'],
            "id"        => $result['data']['leadId'],
            "url"       => $result['data']['url']
         );
         if ($response["status"] == "PENDED") $_SESSION['leadAlreadyCreated'] = true;
         $data = array_merge($data, $response);
         $requestLog = json_encode(array_merge(
            array(
               "date" => date('Y-m-d H:i:s'),
               "leadAlreadyCreated" => $_SESSION['leadAlreadyCreated'],
               "crm" => 'cryptolemonad'
            ), $data
         ));

      }
      else {

         $response = array(
            "status" => "api-not-selected"
         );
         $data = array_merge($_POST, $response);
         $requestLog = json_encode(array_merge(
            array(
               "date" => date('Y-m-d H:i:s'),
               "leadAlreadyCreated" => $_SESSION['leadAlreadyCreated'],
               "crm" => 'not-selected'
            ), $data
         ));

      }

      if ($dataConfig['sendLeadToTelegram']) require_once dirname(__FILE__) . '/assets/php/telegramLeadInfo.php';

   }

   logFile($requestLog, dirname(__FILE__) . '/assets/log/afterSend.log');
   error_log($requestLo, 0);

   echo $thankspage . http_build_query($response);

?>
