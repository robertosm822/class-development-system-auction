<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailService;

class EmailController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function send(Request $request)
    {
        try {
            $body = $request->all();
            // Teste: renderizar a view e exibir na resposta
            //$html = view($request->view, ['params' => $request->params])->render();
            //return response()->json(['success' => true, 'html' => $html]);
            $request->validate([
                'to' => 'required|email',
                'subject' => 'required|string',
                'params' => 'required|array',
                'view' => 'required|string'
            ]);

            // Chama o serviço de e-mails
            $result = $this->emailService->sendEmailApi(
                $body['to'],
                $body['subject'],
                $body['params'],
                $body['view']
            );

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao renderizar a view: ' . $e->getMessage()
            ]);
        }
    }
}
