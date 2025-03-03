<?php

namespace App\Services;

use App\Mail\CustomEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class EmailService
{

    protected $apiUrl;
    protected $authToken;
    protected $fromEmail;

    public function __construct()
    {
        $this->apiUrl = env('SMTP_LW_API_URL', '');
        $this->authToken = env('SMTP_LW_AUTH_TOKEN', '');
        $this->fromEmail = env('SMTP_LW_FROM_EMAIL', '6bddbb7b7e76169ac852aa369dc13d31@mail.soaresinformatica.dev.br');
    }

    public function formatEmailContent(string $content): string
    {
        // Converte caracteres especiais em entidades HTML
        $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

        // Adiciona barras invertidas para escapar as aspas duplas e simples
        $content = addslashes($content);

        return $content;
    }

    public function sendEmailApi($to, $subject, $params, $view)
    {
        try {
            // Renderiza a view Blade em HTML
            $body = View::make($view, ['params' => $params])->render();

            // Disparo da requisição HTTP para a API externa
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-auth-token' => $this->authToken,
            ])->post($this->apiUrl, [
                'subject' => $subject,
                'body' => $body,
                'to' => $to,
                'from' => $this->fromEmail,
                'headers' => [
                    'Content-Type' => 'text/plain; charset=us-ascii'
                ],
            ]);

            // Retorno dos dados da API
            return $response->json();
        } catch (\Exception $e) {
            return ['error' => 'Erro ao enviar email: ' . $e->getMessage()];
        }
    }

    public function sendEmail($to, $subject, $params, $view)
    {
        try {
            Mail::to($to)->send(new CustomEmail($subject, $params, $view));
            return ['success' => true, 'message' => 'E-mail enviado com sucesso.'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Erro ao enviar e-mail: ' . $e->getMessage()];
        }
    }
}
