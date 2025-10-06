@extends('website.layout')
@section('content')


    <!-- Spacer -->
    <div style="height: 100px;"></div>

    <!-- Signup Section -->
    <div class="relative overflow-hidden">
        <div class="mx-auto max-w-screen-md py-12 px-4 sm:px-6 md:max-w-screen-xl md:py-20 lg:py-32 md:px-8">
            <div class="md:pr-8 md:w-1/2 xl:pr-0 xl:w-5/12">
                <!-- Title -->
                <h1 class="text-3xl text-gray-800 font-bold md:text-4xl md:leading-tight lg:text-3xl lg:leading-tight">
                    {{$post->settings['signup_subtitle'] ?? __('Create your account')}}
                </h1>

                <p class="mt-3 text-base text-gray-500">
                    {{$post->settings['signup_title'] ?? __('Join thousands of students who are already using StudyBuddy to boost their productivity.')}}
                </p>
                <!-- End Title -->
                <div class="mb-3 mt-3 text-gray-500">
                    <label>{{__('Already have an account?')}} <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{$base_url}}/app/login">{{__('Sign in')}}</a></label>
                </div>

                <!-- Form -->
                <form method="post" action="{{$base_url}}/signup">
                    @if ($errors->any())
                        <div class="mb-4" id="has_signup_errors">
                            @foreach ($errors->all() as $error)
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-2 rounded relative"
                                     role="alert">{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-2 rounded relative"
                                 role="alert">{{ session('error') }}</div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mt-4">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">{{__('First Name')}}</label>
                            <input type="text" name="first_name" id="first_name"class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" value="{{old('first_name')}}" placeholder="{{__('Enter your first name')}}" required="">
                        </div>
                        <div class="mt-4">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">{{__('Last Name')}}</label>
                            <input type="text"  name="last_name" id="last_name" class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" value="{{old('last_name')}}" placeholder="{{__('Enter your last name')}}" required="">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900"> {{__('Email address')}}</label>
                        <input type="email" name="email" id="email" class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" value="{{old('email')}}" placeholder="{{__('Your email address')}}" required="">
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900"> {{__('Password')}}</label>
                        <input type="password" name="password" id="password" class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" placeholder="{{__('Choose a password')}}" required="" minlength="6">
                        <div id="password-errors" class="text-red-600 text-sm mt-1" style="display: none;"></div>
                    </div>
                    <div class="mt-4 mb-5">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900"> {{__('Confirm Password')}}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class=" border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3" placeholder="{{__('Confirm password')}}" required="">
                        <div id="password-confirmation-errors" class="text-red-600 text-sm mt-1" style="display: none;"></div>
                    </div>
                    @csrf
                    <div class="grid">
                        <button type="submit"
                                class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-primary text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800 sm:p-4">{{__('Sign up')}}</button>
                    </div>
                    <div class="mb-2 mt-2 ">
                        <label class="text-xs sm:text-sm text-gray-600">{{__('By submitting this form I have read and acknowledged the ')}}<a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{$base_url}}/privacy-policy">{{__('Privacy Policy')}}</a> & <a class="text-blue-600 decoration-2 hover:underline font-medium" href="{{$base_url}}/terms-of-service">{{__('Terms of Service')}}</a> </label>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
        @if(!empty($post->settings['signup_image']))
            <div class="hidden md:block md:absolute md:top-0 md:left-1/2 md:right-0 h-full bg-no-repeat bg-center bg-cover"
                 style="background-image: url('{{getUploadsUrl()}}/{{$post->settings['signup_image']}}')"></div>
        @endif
    </div>


@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const passwordErrors = document.getElementById('password-errors');
    const passwordConfirmationErrors = document.getElementById('password-confirmation-errors');

    // Validação do formulário quando clicar no botão
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = passwordInput.value;
        const confirmation = passwordConfirmationInput.value;
        
        // Limpar erros anteriores
        passwordErrors.style.display = 'none';
        passwordConfirmationErrors.style.display = 'none';
        passwordErrors.textContent = '';
        passwordConfirmationErrors.textContent = '';
        
        let hasErrors = false;
        
        // Validar comprimento da senha
        if (password.length < 6) {
            passwordErrors.textContent = 'A senha deve ter pelo menos 6 caracteres';
            passwordErrors.style.display = 'block';
            hasErrors = true;
        }
        
        // Validar confirmação de senha
        if (password !== confirmation) {
            passwordConfirmationErrors.textContent = 'As senhas não coincidem';
            passwordConfirmationErrors.style.display = 'block';
            hasErrors = true;
        }
        
        if (hasErrors) {
            e.preventDefault();
        }
    });
});
</script>
