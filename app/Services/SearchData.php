<?php
namespace App\Services;

class SearchData {
    
    /**
     * getDataFromApiGithub
     *
     * @param  mixed $subject
     * @return void
     */
    public function getDataFromApiGithub(string $subject)
    {
        $apiGithub = "https://api.github.com/search/repositories?q=" . $subject;
        return $data = self::getDataFromApi($apiGithub);
    }
    
    /**
     * getDataFromApi
     *
     * @param  mixed $url
     * @return void
     */
    public static function getDataFromApi(string $url)
    {
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        $data = curl_exec($ch);
        curl_close($ch);
        $info = curl_getinfo($ch);
        if ($curl_errno > 0 || $info['http_code'] !== 200) { // если есть ошибки или код не 200, то пишем в лог
            $error = (!empty($curl_errno)) ? " cURL Error ($curl_errno): $curl_error\n"
            : "http_code: " . $info['http_code'] . "\n";
            $txt= "[" . date("Y-m-d H:i:s") . "]: "
            . __METHOD__ . ":" . $error;
            self::setErrorToLog($txt);
            return false;
        } else {
            return $data;
        }
    }

     /**
     * setErrorToLog
     *
     * @param  mixed $string
     * @return void
     */
    public static function setErrorToLog(string $string): void
    {
        $myfile = fopen(__DIR__ ."/var/log/api.log", "a+") or die("Unable to open file!");
        fwrite($myfile, $string);
        fclose($myfile);
    }
}