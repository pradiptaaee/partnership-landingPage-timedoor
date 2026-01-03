@php
    // Mapping Bahasa & Bendera
    $languages = [
        'id' => ['flag' => '🇮🇩', 'name' => 'ID'],
        'en' => ['flag' => '🇬🇧', 'name' => 'EN'],
        'bn' => ['flag' => '🇧🇩', 'name' => 'BD'],
        'ar' => ['flag' => '🇪🇬', 'name' => 'AR'],
        'ms' => ['flag' => '🇲🇾', 'name' => 'MY'],
        'fil'=> ['flag' => '🇵🇭', 'name' => 'PH'],
        'ja' => ['flag' => '🇯🇵', 'name' => 'JP'],
    ];

    // Ambil bahasa aktif saat ini
    $currentLocale = app()->getLocale();
    $currentLang = $languages[$currentLocale] ?? $languages['en'];
@endphp

@extends('landing_page.layouts.app')

@section('content')
    <!-- SECTION 1 -->
    @include('landing_page.sections.hero')
    
    <!-- SECTION 2: PROOF  -->
    @include('landing_page.sections.proof')

    <!-- Section 3.1 : PRODUCT KNOWLEDGE & USP       -->
    @include('landing_page.sections.product_knowledge')

    <!-- PAGE 3.2 : OUTPUT & PROOF        -->
    @include('landing_page.sections.output_proof')

    <!-- Section 4: CTA & Promo            -->
    @include('landing_page.sections.cta_promo')

    <!-- FOOTER           -->
    @include('landing_page.sections.footer')

@endsection

