<?php


namespace App\Http\Controllers\Acquiring;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Payment implements PaymentInterface
{
    const TEST_URL = 'https://test.bank.ru';
    const PROD_URL = 'https:/prod.bank.ru';

    /**
     * Логин в системе платежного шлюза
     * @var string
     */
    protected $login = '{login}';

    /**
     * Пароль в системе платежного шлюза
     * @var string
     */
    protected $password = '{password}';

    protected $http_client;
    protected $host = self::PROD_URL;

    public function __construct($login, $password, $acquiring_checking)
    {
        $this->http_client = new Client();

        if (!is_null($login)) {
            $this->login = $login;
        }

        if (!is_null($password)) {
            $this->password = $password;
        }

        if ($acquiring_checking == 1) {
            $this->host = self::TEST_URL;
        }
    }

    /**
     * @param int $orderId
     * @param string $description
     * @param int $amount
     * @return bool|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registerOrder(int $orderId, string $description, int $amount)
    {
        $requestUrl = $this->host . '/payment/rest/register.do';
        $response = $this->http_client->request('GET', $requestUrl, [
            'stream' => true,
            'connect_timeout' => 10,
            'read_timeout' => 10,
            'query' => [
                'userName' => $this->login,
                'password' => $this->password,
                'amount' => $amount,
                'orderNumber' => $orderId,
                'returnUrl' => 'https://test/payment-done',
                'failUrl' => 'https://test/payment-false',
            ]
        ]);
        $result = json_decode($response->getBody()->getContents());

        if (isset($result->errorCode)) {
            Log::error('Ошибка эквайринга', [
                $result->errorCode,
                $result->errorMessage,
                'user' => Auth::user(),
            ]);
            return false;
        }

        return $result;
    }

    /**
     * @param string $orderId
     * @return bool|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatusOrder(string $orderId)
    {
        $requestUrl = $this->host . '/payment/rest/getOrderStatus.do';

        $response = $this->http_client->request('GET', $requestUrl, [
            'stream' => true,
            'connect_timeout' => 10,
            'read_timeout' => 10,
            'query' => [
                'userName' => $this->login,
                'password' => $this->password,
                'orderId' => $orderId,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE);
    }
}
