<?php

namespace Src\Api\Shared\Domain\Helpers\Messages;

class DevMessageTeam
{

    //Team
    const TEAM_URL = 'https://globaltanksl.webhook.office.com/webhookb2/0430c25b-45ad-4fab-9f19-d22b402ac254@283b81af-158d-4ded-ae3f-ed69854d0e32/IncomingWebhook/ec28a374fd3843949e85470f84d0b124/e811e0be-fa78-4127-a727-020a841004ce';




    /**
     * @param $text
     * @param string $title
     * @param false $isError
     */
    public static function send($text, $title='Message: ', $isError = false)
    {

        //TODO
        //$text = print_r($text, TRUE);

        $title .= ' '. env('APP_NAME') . ' '. env('APP_ENV');

        if($isError){
            //Error
            $themeColor = "FF0400";
        }else{
            $themeColor = "0078D7";
        }



        if(is_array($text)){
            $str = '';

            foreach ($text as $val){

                $str .= $val;
            }

            $data =[
                "@type" => "MessageCard",
                "themeColor"=> $themeColor,
                //"title" => $title,
                "summary" => $title,
                //"text" => $str,
                "body"=>[
                    "text" => $str,
                ],
            ];

        }else{

            $error = trim(substr($text,0,2000));

            $data =[
                "@type" => "MessageCard",
                "themeColor"=> $themeColor,
                "title" => $title,
                "text" => $error,
            ];
        }




        $string = json_encode($data);
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_VERBOSE,false);
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_URL,self::TEAM_URL);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,60);
        curl_setopt($ch,CURLOPT_TIMEOUT,60);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);


        if (isset($error_msg)) {
            // TODO - Handle cURL error accordingly
            //pendiente por revisar
        }

    }




    /**
     * @param $text
     * @param string $title
     * @param false $isError
     */
    /*
    public static function send($text, $title='Message: ', $isError = false)
    {

        //TODO
        //$text = print_r($text, TRUE);


        if($isError){
            //Error
            $themeColor = "FF0400";
        }else{
            $themeColor = "0078D7";
        }



        if(is_array($text)){
            $str = '';

            foreach ($text as $val){

                $str .= $val;
            }

            $data =[
                "@type" => "MessageCard",
                "themeColor"=> $themeColor,
                "title" => $title,
                //"text" => $str,
                "body"=>[
                    "text" => $str,
                ],

            ];

        }else{

            $error = trim(substr($text,0,2000));

            $data =[
                "@type" => "MessageCard",
                "themeColor"=> $themeColor,
                "title" => $title,
                "text" => $error,
            ];
        }




        $string = json_encode($data);
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_VERBOSE,false);
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_URL,self::TEAM_URL);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,60);
        curl_setopt($ch,CURLOPT_TIMEOUT,60);
        curl_exec($ch);
        curl_close($ch);

    }
    */



}
