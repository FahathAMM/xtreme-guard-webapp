<?php

namespace App\Http\Controllers\Pages\Administration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    protected $modelName = 'Whatsapp';

    public function index(Request $request)
    {
        return $this->toSendWhatsapp('971502848071');
        // return $this->toSendWhatsapp('971554501483');
    }

    public static function toSendWhatsapp($recipientMobile, $message = '')
    {
        Log::channel('WhatsappForContact')
            ->info(json_encode(['recipientMobile' => $recipientMobile, 'message' => $message], JSON_PRETTY_PRINT));

        if (!$recipientMobile) {
            return 'Rrecipient Mobile number not found';
        }

        $url = 'https://wa.mytime2cloud.com/send-message';

        $data = [
            'clientId' => 'c1b53d88-b98f-4a0b-9417-0108acd36a57', //"web_site" . Str::uuid(),
            'recipient' =>  $recipientMobile,
            'text' => 'test',
        ];

        return  Http::withoutVerifying()->timeout(30)->post($url, $data);
    }
}
