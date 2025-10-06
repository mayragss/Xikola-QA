{{-- Componente de formulário de registro para usar na home page --}}
<div class="signup-form-component">
    <!-- Formulário de Registro -->
    <div class="relative overflow-hidden">
        <div class="mx-auto max-w-screen-md py-12 px-4 sm:px-6 md:max-w-screen-xl md:py-20 lg:py-32 md:px-8">
            <div class="md:pr-8 md:w-1/2 xl:pr-0 xl:w-5/12">
                <!-- Title -->
                <h1 class="text-3xl text-gray-800 font-bold md:text-4xl md:leading-tight lg:text-3xl lg:leading-tight">
                    {{__('Create your account')}}
                </h1>

                <p class="mt-3 text-base text-gray-500">
                    {{__('Join thousands of students who are already using StudyBuddy to boost their productivity.')}}
                </p>
                
                <!-- End Title -->
                <div class="mb-3 mt-3 text-gray-500">
                    <label>{{__('Already have an account?')}} <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{url('/app/login')}}">{{__('Sign in')}}</a></label>
                </div>

                <!-- Form -->
                <form method="post" action="{{url('/register')}}" id="signup-form">
                    @if ($errors->any())
                        <div class="mb-4" id="has_signup_errors">
                            @foreach ($errors->all() as $error)
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-2 rounded relative"
                                     role="alert">{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mt-4">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">{{__('First Name')}}</label>
                            <input type="text" name="first_name" id="first_name" class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" value="{{old('first_name')}}" placeholder="{{__('Enter your first name')}}" required="">
                        </div>
                        <div class="mt-4">
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">{{__('Last Name')}}</label>
                            <input type="text" name="last_name" id="last_name" class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" value="{{old('last_name')}}" placeholder="{{__('Enter your last name')}}" required="">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900"> {{__('Email address')}}</label>
                        <input type="email" name="email" id="email" class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" value="{{old('email')}}" placeholder="{{__('Your email address')}}" required="">
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900"> {{__('Password')}}</label>
                        <input type="password" name="password" id="password" class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" placeholder="{{__('Choose a password')}}" required="">
                    </div>
                    <div class="mt-4 mb-5">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900"> {{__('Confirm Password')}}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" placeholder="{{__('Confirm password')}}" required="">
                    </div>
                    @csrf
                    <div class="grid">
                        <button type="submit"
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-primary text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800 sm:p-4">{{__('Sign up')}}</button>
                    </div>
                    <div class="mb-2 mt-2 ">
                        <label class="text-xs sm:text-sm text-gray-600">{{__('By submitting this form I have read and acknowledged the ')}}<a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{url('/privacy-policy')}}">{{__('Privacy Policy')}}</a> & <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{url('/terms-of-service')}}">{{__('Terms of Service')}}</a> </label>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>

<script>
// Script para melhorar a experiência do usuário
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('signup-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Adicionar loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '{{__("Creating account...")}}';
            }
        });
    }
});
</script>
