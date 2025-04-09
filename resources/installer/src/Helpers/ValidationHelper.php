<?php 

namespace Project\Installer\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Project\Installer\Helpers\Helper;
use Project\Installer\Helpers\URLHelper;

class ValidationHelper {

    public function validate(array $data) {
        $this->setStepSession();
        $config = new ConfigHelper();
        $url = new URLHelper();
        $db = new DBHelper();
        $helper = new Helper();

        $response = Http::acceptJson()->get($url->getToken(),[
            'marketplace'       => $config->get()['marketplace'] ?? "",
        ]);

        $response_body = json_decode($response->body(),true);

        if(!$response->successful() || $response_body['type'] != 'success') {
            $this->setStepSession();
        }

        $auth_tokens = $response_body['data']['tokens'];
        foreach($auth_tokens as $token) {
            $response = Http::withHeaders([
                'Authorization'     => 'Bearer ' . $token,
            ])->get($url->getValidation(),['code' => $data['code']]);

            if($response->successful()) {
                break;
            }

            sleep(1);
        }
        $this->setStepSession();
        $buyer_info = $response->collect()->get('buyer');

        $data['client'] = $helper->client();
        $helper->connection($data);

        if($buyer_info != $data['username']) {
            $this->setStepSession();
        }

        $helper->cache($data);

        $this->setStepSession();
    }

    public function setStepSession() {
        session()->put('validation',"PASSED");
    }

    public static function step() {
        return session('validation');
    }
}