<?php

use App\Http\Controllers\ChatbotController;
use App\Mail\AdminEnquiryNotification;
use App\Mail\CustomerEnquiryConfirmation;
use App\Models\Enquiry;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $site = config('site');

    return view('home', [
        'pageTitle' => 'Home',
        'site' => $site,
    ]);
})->name('home');

Route::get('/about-us', function () {
    $site = config('site');

    return view('about', [
        'pageTitle' => 'About Us',
        'site' => $site,
    ]);
})->name('about');

Route::get('/products', function () {
    $site = config('site');

    return view('products.index', [
        'pageTitle' => 'Products',
        'site' => $site,
    ]);
})->name('products.index');

Route::get('/products/{slug}', function (string $slug) {
    $site = config('site');
    $category = Arr::get($site, 'product_categories.' . $slug);

    abort_unless($category, 404);

    return view('products.show', [
        'pageTitle' => $category['title'],
        'site' => $site,
        'category' => $category,
    ]);
})->name('products.show');

Route::get('/industries-and-applications', function () {
    $site = config('site');

    return view('industries', [
        'pageTitle' => 'Industries & Applications',
        'site' => $site,
    ]);
})->name('industries');

Route::get('/contact', function () {
    $site = config('site');

    return view('contact', [
        'pageTitle' => 'Contact',
        'site' => $site,
    ]);
})->name('contact');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'company' => ['nullable', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:30'],
        'message' => ['required', 'string', 'max:5000'],
    ]);

    $enquiry = Enquiry::create($validated);

    Mail::to(config('site.admin_notification_email', config('site.email')))->send(
        new AdminEnquiryNotification($enquiry)
    );

    Mail::to($enquiry->email)->send(
        new CustomerEnquiryConfirmation($enquiry)
    );

    return redirect()
        ->route('contact')
        ->with('success', 'Your enquiry has been submitted successfully.');
})->name('contact.submit');

Route::post('/chatbot/message', ChatbotController::class)->name('chatbot.message');
