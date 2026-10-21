<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BusinessRegistryService
{
    private const TYPE_ENDPOINT = 'https://data.gcis.nat.gov.tw/od/data/api/673F0FC0-B3A7-429F-9041-E9866836B66D';
    private const COMPANY_ENDPOINT = 'https://data.gcis.nat.gov.tw/od/data/api/5F64D864-61CB-4D0D-8AD9-492047CC1EA6';

    /** @return array{status:string,type?:string,result?:array,msg?:string} */
    public function lookup(string $taxId): array
    {
        if (! preg_match('/^\d{8}$/', $taxId)) {
            return ['status' => '0', 'type' => '無效', 'msg' => '統一編號必須為 8 位數字。'];
        }

        try {
            $types = $this->get(self::TYPE_ENDPOINT, 'No eq '.$taxId);
            $type = match (true) {
                ($types[0]['exist'] ?? null) === 'Y' => '公司',
                ($types[1]['exist'] ?? null) === 'Y' => '分公司',
                ($types[2]['exist'] ?? null) === 'Y' => '商業',
                default => '無效',
            };

            if ($type === '分公司') return ['status' => '2', 'type' => $type];
            if ($type === '商業') return ['status' => '1', 'type' => $type];
            if ($type === '無效') return ['status' => '0', 'type' => $type];

            return [
                'status' => '3',
                'type' => $type,
                'result' => $this->get(self::COMPANY_ENDPOINT, 'Business_Accounting_NO eq '.$taxId),
            ];
        } catch (ConnectionException|RuntimeException $exception) {
            report($exception);
            return ['status' => '4', 'msg' => '經濟部商工資料服務暫時無法連線，請稍後再試。'];
        }
    }

    private function get(string $url, string $filter): array
    {
        $response = Http::acceptJson()
            ->timeout(3)
            ->retry(2, 250)
            ->get($url, ['$format' => 'json', '$filter' => $filter, '$skip' => 0, '$top' => 50]);

        if (! $response->successful() || ! is_array($response->json())) {
            throw new RuntimeException('Unexpected business registry response.');
        }

        return $response->json();
    }
}
