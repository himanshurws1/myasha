<?php

namespace Tests\Feature;

use App\Mail\AdminEnquiryNotification;
use App\Mail\CustomerEnquiryConfirmation;
use App\Models\Enquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactEnquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_enquiry_is_saved_to_database(): void
    {
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'Tripti',
            'company' => 'MYSHA AUTOMATION',
            'email' => 'tripti@example.com',
            'phone' => '838398682',
            'message' => 'I need product details and a quotation.',
        ]);

        $response->assertRedirect('/contact');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('enquiries', [
            'name' => 'Tripti',
            'company' => 'MYSHA AUTOMATION',
            'email' => 'tripti@example.com',
            'phone' => '838398682',
        ]);

        $this->assertSame(1, Enquiry::count());

        Mail::assertSent(AdminEnquiryNotification::class, function (AdminEnquiryNotification $mail) {
            return $mail->hasTo('myshasales2023@gmail.com')
                && $mail->enquiry->email === 'tripti@example.com';
        });

        Mail::assertSent(CustomerEnquiryConfirmation::class, function (CustomerEnquiryConfirmation $mail) {
            return $mail->hasTo('tripti@example.com')
                && $mail->enquiry->name === 'Tripti';
        });
    }
}
