<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/6/2019 2:07 PM
 * Project: EncounterTheCross
 * File Name: StripeClient.php
 */

namespace App\Model;

use Flosch\Bundle\StripeBundle\Stripe\StripeClient as BaseStripeClient;


class StripeClient extends BaseStripeClient
{
    public function __construct($stripeApiKey = 'sk_test_QxoxhsHWaSdGREk7Myh8CKdz')
    {

        parent::__construct($stripeApiKey);

        return $this;
    }

    public function createChargeUsd(int $chargeAmount, string $token)
    {
        return $this->createCharge($chargeAmount, 'USD',$token);
    }
}
