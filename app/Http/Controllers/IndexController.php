<?php

namespace App\Http\Controllers;

use App\Http\Client as HttpClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class IndexController extends Controller
{
    /** @var HttpClient */
    protected $httpClient;

    /**
     * Create a new controller instance.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Login action
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $data = [
            'clientId'    => env('GITHUB_CLIENT_ID'),
            'redirectUri' => urlencode(url('auth-callback')),
        ];
        return response(view('login', $data));
    }

    /**
     * Index action
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $token = $request->get('access_token');
        $token = $token ?: env('GITHUB_TEST_ACCESS_TOKEN');
        if (empty($token)) {
            return redirect('login');
        }

        $data = [ 'accessToken' => $token ];

        return response(view('index', $data ));
    }

    /**
     * Callback action
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function callbackAction(Request $request)
    {
        $code = $request->get('code');
        if (empty($code)) {
            return redirect('login');
        }

        $url = 'https://github.com/login/oauth/access_token';
        $params = [
            'client_id'     => env('GITHUB_CLIENT_ID'),
            'client_secret' => env('GITHUB_CLIENT_SECRET'),
            'code'          => $code,
        ];

        $res = $this->httpClient->request('POST', $url, [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => $params,
        ]);

        try {
            $decoded = $this->httpClient->decodeJsonResponse($res);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response('An error occured during access token retrieval', 500);
        }

        return redirect('/?access_token='.$decoded['access_token'] ?? '');
    }
}