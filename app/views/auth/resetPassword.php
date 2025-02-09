<!doctype html>
<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-[url('https://megabit-mich.ru/wp-content/uploads/2023/07/what_we_do_banner-scaled-1.jpg')] bg-cover bg-no-repeat  h-screen">


<div class="font-[sans-serif] bg-cyan-800 bg-opacity-60">
      <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
         
          <div class="p-8 rounded-2xl bg-white shadow">
            <a href="/">
              <img src="/images/veille_hub_logo.svg" alt="logo" class='w-32 m-auto pb-6' />
            </a>
            <form action="/reset-password" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        id="email" 
                        type="email" 
                        name="email" 
                        required 
                        placeholder="votre@email.com">
                </div>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Réinitialiser le mot de passe
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>



    

</body>

</html>