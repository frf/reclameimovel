<?php

namespace Condominio\Repository;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\GraphLocation;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookCanvasLoginHelper;

/**
 * User repository
 */
class FacebookRepository
{
    protected $session;
    protected $request;
    protected $token;
    
    public function __construct($app) {
     
        if($app['token']){
            $this->token = $app['token']->getCredentials();
        }else{
            throw new Exception("Erro ao solicitar usuario ao facebook!");
        }

        // If you already have a valid access token:
        $this->session = new FacebookSession($this->key);
        $this->request = new FacebookRequest($this->session, 'GET', '/me');
   
   }
   public function getToken(){
       return $this->token;
   }
   public function checkSession(){
       try {
          $this->session->validate();
        } catch (FacebookRequestException $ex) {
          // Session not valid, Graph API returned an exception with the reason.
          echo $ex->getMessage();
        } catch (\Exception $ex) {
          // Graph API returned info, but it may mismatch the current app or have expired.
          echo $ex->getMessage();
        }
   }
   public function getUser(){
       if($this->session) {
            try {
                $response = $this->request->execute();
                return $response->getGraphObject(GraphUser::className());
            } catch(FacebookRequestException $e) {

              echo "Exception occured, code: " . $e->getCode();
              echo " with message: " . $e->getMessage();

            }
        }
   }
   public function getLoc(){
       if($this->session) {
           try {
                return $this->request->execute()->getGraphObject(GraphLocation::className());
           } catch(FacebookRequestException $e) {

              echo "Exception occured, code: " . $e->getCode();
              echo " with message: " . $e->getMessage();

            }
       }
   }
   
   public function getSession(){
       
       $this->session = new FacebookSession('CAADXo9oqDpgBAFH4Lp4voyizEWTO7mCvYKMz3ZCdxjKTCT5VO0k518eUHMubxzNc3pHadVBgMvLdpBQBQZAf3beFw2SOOKAtuZARi19IqIaxldjPIoMYz6oGaMNx7QVa8Y1GBHXA9dOiiV1dgVieZBpV7mE2fJZA3z5qd6VHih0PcK6ZB9xIPRPFH2FyPuJGAZD');
       $response = $this->request->execute();
       $graphObject = $response->getGraphObject();
       return $graphObject;
   }
   
}
