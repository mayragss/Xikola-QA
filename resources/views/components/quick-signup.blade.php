{{-- Componente de registro rápido para usar na home page --}}
<div class="quick-signup-component">
    <!-- Modal ou seção de registro -->
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md mx-auto">
        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{__('Get Started')}}</h3>
        <p class="text-gray-600 mb-6">{{__('Create your account in seconds')}}</p>
        
        <form method="post" action="{{url('/register')}}" id="quick-signup-form">
            @if ($errors->any())
                <div class="mb-4">
                    @foreach ($errors->all() as $error)
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-2 rounded relative" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="quick_first_name" class="block text-sm font-medium text-gray-700 mb-1">{{__('First Name')}}</label>
                    <input type="text" name="first_name" id="quick_first_name" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="{{__('First name')}}" required>
                </div>
                <div>
                    <label for="quick_last_name" class="block text-sm font-medium text-gray-700 mb-1">{{__('Last Name')}}</label>
                    <input type="text" name="last_name" id="quick_last_name" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="{{__('Last name')}}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="quick_email" class="block text-sm font-medium text-gray-700 mb-1">{{__('Email')}}</label>
                <input type="email" name="email" id="quick_email" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="{{__('your@email.com')}}" required>
            </div>

            <div class="mb-4">
                <label for="quick_password" class="block text-sm font-medium text-gray-700 mb-1">{{__('Password')}}</label>
                <input type="password" name="password" id="quick_password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="{{__('Password')}}" required>
            </div>

            <div class="mb-6">
                <label for="quick_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">{{__('Confirm Password')}}</label>
                <input type="password" name="password_confirmation" id="quick_password_confirmation" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       placeholder="{{__('Confirm password')}}" required>
            </div>

            @csrf
            
            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                {{__('Create Account')}}
            </button>
            
            <p class="text-center text-sm text-gray-600 mt-4">
                {{__('Already have an account?')}} 
                <a href="{{url('/app/login')}}" class="text-blue-600 hover:underline">{{__('Sign in')}}</a>
            </p>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('quick-signup-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = '{{__("Creating account...")}}';
            }
        });
    }
});
</script>
