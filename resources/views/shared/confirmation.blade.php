<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDRRMO-Confirmation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * {
            font-family: 'Poppins', 'san-serif';
        }
    </style>
</head>
<body>


    <section class="flex items-center justify-center w-full h-full py-8 ">
        <div class="grid grid-cols-1 md:grid-cols-2 content-center gap-8 max-w-[950px] mt-6 h-[650px] m-auto p-6 pt-28">
            <div class="text-center pt-8">
                <h1 class="text-3xl font-bold mb-4 leading-[2.5rem]">Your Registration as Staff  <br> is waiting for the Admin Approval!</h1>
                <p class="mb-2">We will notify you with your registered email in a minute.</p>
                @if (session()->has('email'))
                <p>Your Email: <span class="font-bold text-md">{{ session('email') }}</span></p>
                @endif
            
                <h4 class="text-right py-4 pr-6 font-bold text-lg">- PDRRMO ZAMBALES</h4>
            </div>
            <div>
                <img src="/images/register-img.png" alt="" class="w-full max-h-[400px]">
            </div>
        </div>
    </section>


</body>
</html>