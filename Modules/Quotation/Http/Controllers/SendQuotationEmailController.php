<?php

namespace Modules\Quotation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Quotation\Emails\QuotationMail;
use Modules\Quotation\Entities\Quotation;

class SendQuotationEmailController extends Controller
{
    public function __invoke(Quotation $quotation) {
        try {
            // Validasi customer dan email
            $customer = $quotation->customer;
            if (!$customer) {
                throw new \Exception('Customer tidak ditemukan');
            }

            $email = $customer->customer_email;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Format email customer tidak valid');
            }

            Mail::to($email)->send(new QuotationMail($quotation));

            $quotation->update(['status' => 'Sent']);

            toast('Quotation berhasil dikirim ke ' . $email, 'success');

        } catch (\Exception $exception) {
            Log::error('Gagal mengirim quotation email: ' . $exception->getMessage());
            toast('Gagal mengirim email: ' . $exception->getMessage(), 'error');
        }

        return back();
    }
}
