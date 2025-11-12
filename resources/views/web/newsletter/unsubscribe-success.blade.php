@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="mx-auto w-24 h-24 bg-[#92c24f] rounded-full flex items-center justify-center mb-8 shadow-lg">
                        <i class="fas fa-check text-white text-4xl"></i>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Je bent succesvol uitgeschreven!
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Je ontvangt geen nieuwsbrieven meer van ons.
                    </p>
                </div>
            </div>
        </section>
        <!-- Optional: Additional helpful sections or links can go here -->
    </div>
@endsection
