<?php


namespace App\Http\Controllers\Acquiring;


interface PaymentInterface
{
    /**
     * Регистрируем заказ на шлюзе
     * @param $orderId int
     * @param $description string
     * @param $amount int
     *
     * @return mixed
     */
    public function registerOrder(int $orderId, string $description, int $amount);

    /**
     * Получаем информацию о заказе
     * @param $orderId string
     *
     * @return mixed
     */
    public function getStatusOrder(string $orderId);
}

