<?php



namespace Dacast;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class Rest
{
    private $apiKey;
    private $client;

    public function __construct($apiKey)
    {
        $this->apiConfig = [
            'base' => 'https://api.dacast.com/v2/',
            'upload_path' => 'http://upload.dacast.com',
            'pollingInterval' => 3000,
            'maxRetry' => 20
          ];
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => $this->apiConfig['base'],
            'query'   => ['apikey' => $this->apiKey]
        ]);
    }

    public function get($url)
    {
        try {
            $response = $this->client->request('GET', $url);
            $json = json_decode($response->getBody(),true);
            $status = $response->getStatusCode();
            return $this->responseSuccess($status, $json, 0);
        } catch(ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $json = [
                'errors' => $e->getResponse()->getReasonPhrase()
            ];
            return $this->responseError($status, $json);
        }
    }

    public function put($url, $data)
    {
        try {
            $response = $this->client->request('PUT',$url,[
                'json' => $data
            ]);
            $json = json_decode($response->getBody(),true);
            $status = $response->getStatusCode();
            return $this->responseSuccess($status, $json, 0);
        } catch(ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $json = [
                'errors' => $e->getResponse()->getReasonPhrase()
            ];
            return $this->responseError($status, $json);
        }
    }

    public function post($url,$data)
    {
        try {
            $response = $this->client->request('POST', $url, [
                'json' => $data
            ]);
            $json = json_decode($response->getBody(),true);
            $status = $response->getStatusCode();
            return $this->responseSuccess($status, $json, 0);
        } catch(ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $json = [
                'errors' => $e->getResponse()->getReasonPhrase()
            ];
            return $this->responseError($status, $json);
        }
    }

    public function upload($url, $data, $callbackProgress, $callbackSuccess)
    {
        try {
            if(!array_key_exists('auto_encoding', $data)){
                $data['auto_encoding'] = 0;
            };

            if(!array_key_exists('originalFilename', $data)){
                $data['originalFilename'] = "video ".rand(0, 15);
            };

            $gzl = new Client([]);
            $handle = fopen($data['file'], "r");

            $fields = [
                "source" => $data['originalFilename'],
                "callback_url" => 'http://dacast.com',
                "token_js" => true,
                "upload_type" => 'ajax_queue',
                "auto_encoding" => $data['auto_encoding']
            ];

            $uploadParams = $this->getToken($url,$fields);

            $params = [
                "key" => $uploadParams['data']['key'],
                "acl" => "private",
                "success_action_status" => "201",
                "policy" => $uploadParams['data']['policy'],
                "X-amz-algorithm" => $uploadParams['data']['X-amz-algorithm'],
                "X-amz-credential" => $uploadParams['data']["X-amz-credential"],
                "x-amz-date" => $uploadParams['data']['x-amz-date'],
                "x-amz-expires" => $uploadParams['data']['x-amz-expires'],
                "X-amz-signature" => $uploadParams['data']['X-amz-signature']
            ];

            foreach($params as $key => $value) {
                $file[] = [
                    'name'      => $key,
                    'contents'  => $value
                ];
            }

            $file[] = [
                'name' => 'file',
                'filename' => $data['originalFilename'],
                'contents' => $handle
            ];

            $gzl->request('POST', $this->apiConfig['upload_path'], [
                'multipart' => $file,
                'progress' => function ($dl_total_size, $dl_size_so_far, $ul_total_size, $ul_size_so_far) use ($callbackProgress) {
                    /*
                     * Your can track the upload progress here
                     */
                    //size total of your file $ul_total_size;
                    //size of a file $ul_size_so_far;
                    if($ul_total_size > 0 && $ul_size_so_far > 0){
                        $callbackProgress([
                            'status' => 200,
                            'message' => "File is still uploading",
                            'progress' => ($ul_size_so_far/$ul_total_size)*100
                        ]);
                    }
                }
            ]);

            $json = $uploadParams;
            return $this->responseSuccess($uploadParams['status'], $json, 0, $callbackProgress, $callbackSuccess, 'upload');

        } catch (ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $json = [
                'errors' => $e->getResponse()->getReasonPhrase()
            ];

            return $this->responseError($status, $json);
        }
    }

    public function delete($url, $data)
    {
        try {
            $response = $this->client->request('DELETE', $url, [
                'json' => $data
            ]);
            $status = $response->getStatusCode();
            $msg = [
                'message' => 'Content deleted'
            ];

            $json = ($response) ? $response : $msg;

            return $this->responseSuccess($status, $json, 0);
        } catch (ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $json = [
                'errors' => $e->getResponse()->getReasonPhrase()
            ];
            return $this->responseError($status, $json);
        }

    }

    private function longPolling($status, $url, $iter, $callbackProgress, $callbackSuccess, $type)
    {
        if ($iter <= $this->apiConfig['maxRetry']) {
            try {
                $response = $this->client->request('GET', $url);
                $json = json_decode($response->getBody(),true);
                $status = $response->getStatusCode();
                if($type){
                    $callbackProgress($json);
                };
                return $this->responseSuccess($status, $json, 0, $callbackProgress, $callbackSuccess, $type);
            } catch(ClientException $e) {
                $status = $e->getResponse()->getStatusCode();
                $json = [
                    'errors' => $e->getResponse()->getReasonPhrase()
                ];
                return $this->responseError($status, $json);
            }
        } else {
            return $this->responseError($status, []);
        }
    }

    private function responseSuccess($status, $response, $iteration, $callbackProgress = null, $callbackSuccess = null, $type = null)
    {
        if ($status == 202) {
            sleep(3);
            $iteration += 1;
            $url = (array_key_exists('data',$response) && !$type) ? $response['data']['url'] : $response['url'];

           return $this->longPolling($status, $url, $iteration, $callbackProgress, $callbackSuccess,  $type);
        } else if($status != (202 && 204)) {
            if ($response['data'] && $response['paging']) {
                if ($response['paging']['next']) {
                    $response['paging']['next'] = str_replace('/v2', '', $response['paging']['next']);
                }
                if ($response['paging']['previous']) {
                    $response['paging']['previous'] = str_replace('/v2', '', $response['paging']['previous']);
                }
                if ($response['paging']['last']) {
                    $response['paging']['last'] = str_replace('/v2', '', $response['paging']['last']);
                }
                if ($response['paging']['self']) {
                    $response['paging']['self'] = str_replace('/v2', '', $response['paging']['self']);
                }
                return $response;
            }
        } else {
            if($callbackSuccess) return $callbackSuccess($response);
            var_dump('la response');
            var_dump($response);
            return $response; //success
        }
    }


    private function rightErrorFormat($error)
    {
        if ($error) {
            $msg = array();
            forEach($error as $key => $value) {
                if (gettype($value) == 'array') {
                    forEach($error[$value] as $key => $errdetail) {
                        array_push($msg, [
                            'property' => $errdetail['property'],
                            'message' => $errdetail['message'],
                            'value' => $errdetail['value']
                        ]);
                    };
                } else {
                    array_push($msg, [
                        'message' => $value
                    ]);
                }
            };
            return $msg;
        } else {
            return [
                'message' => "We've got an issue, please try again"
            ];
        }
    }

    private function responseError($status, $response)
    {
        if ($status == 403) {
            return "You're not authorized to do that";
        } else {
            return $this->rightErrorFormat($response);
        }
    }

    private function getToken($url,$data)
    {
        try {
            $response = $this->client->request('POST',$url,[
                'json' => $data
            ]);
            $json = json_decode($response->getBody(),true);
            $status = $response->getStatusCode();
            return $this->responseSuccess($status, $json, 0);
        } catch(ClientException $e) {
            $status = $e->getResponse()->getStatusCode();
            $json = [
                'errors' => $e->getResponse()->getReasonPhrase()
            ];
            return $this->responseError($status, $json);
        }
    }
}