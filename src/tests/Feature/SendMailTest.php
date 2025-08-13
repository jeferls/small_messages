<?php

use App\Mail\HtmlMail;
use Illuminate\Support\Facades\Mail;

it('sends an email using provided html', function () {
    Mail::fake();

    $payload = [
        'to' => 'test@example.com',
        'subject' => 'Test Subject',
        'html' => '<p>Hello World</p>',
    ];

    $response = $this->postJson('/api/send', $payload);

    $response->assertOk()->assertJson(['message' => 'Email sent successfully']);

    Mail::assertSent(HtmlMail::class, function (HtmlMail $mail) use ($payload) {
        return $mail->hasTo($payload['to']) && $mail->html === $payload['html'];
    });
});