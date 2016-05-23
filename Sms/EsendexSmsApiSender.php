<?php

namespace OCSoftwarePL\EsendexSmsApiBundle\Sms;

use Esendex\Authentication\LoginAuthentication;
use Esendex\DispatchService;
use Esendex\Model\DispatchMessage;
use Esendex\Model\Message;
use Esendex\Model\ResultItem;
use OCSoftwarePL\EsendexSmsApiBundle\Sms\DTO\Sms;

class EsendexSmsApiSender
{
    private $config = [];
    private $senderName;
    private $api = null;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->senderName = $config['premium_sender_name'];
    }

    protected function getApi()
    {
        if (null === $this->api) {

            $authentication = new LoginAuthentication(
                $this->config['account_reference'],
                $this->config['username'],
                $this->config['password']
            );

            $this->api = new DispatchService($authentication);
        }
        return $this->api;
    }

    /**
     * @param Sms $sms
     * @return ResultItem
     * @throws \Exception
     */
    public function sendSms(Sms $sms)
    {
        try {
            $esendexSms = new DispatchMessage(
                $sms->sender ?: $this->senderName,
                $sms->phone,
                $sms->msg,
                Message::SmsType
            );

            return $this->getApi()->send($esendexSms);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}