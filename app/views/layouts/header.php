<header class='bg-cyan-100 flex border-b py-3 px-8 font-[sans-serif] min-h-[65px] relative z-50'>
      <div class='max-w-7xl mx-auto flex flex-wrap items-center gap-4 w-full'>
        <a href="/" class="max-sm:hidden">
          <img src="/images/veille_hub_logo1.svg" alt="logo" class='w-28' />
        </a>
        <a href="/" class="hidden max-sm:block">
          <img src="/images/veille_hub_logo1.svg" alt="logo" class='w-12' />
        </a>

        <div id="collapseMenu"
          class='max-lg:hidden lg:!block max-lg:w-full max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
          <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border'>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
              <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"/>
              <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"/>
            </svg>
          </button>
        </div>

        <div class='ml-auto sm:space-x-6'>
          <?php if (empty($_SESSION["user_id"])) { ?>
            <div class="flex gap-4">
              <a href="/login">
                <button class='max-lg:hidden px-6 py-2.5 text-sm rounded-xl border-2 border-cyan-500 text-cyan-500 hover:bg-cyan-50 transition-all duration-300'>
                  Connexion
                </button>
              </a>
              <a href="/register">
                <button class='max-lg:hidden px-6 py-2.5 text-sm rounded-xl text-white bg-cyan-500 hover:bg-cyan-600 transition-all duration-300'>
                  Inscription
                </button>
              </a>
            </div>
          <?php } else { ?>
            <div class="flex items-center justify-end gap-6 ml-auto">
              <div class="w-1 h-10 border-l border-gray-200"></div>
              <div class="dropdown-menu relative flex shrink-0 group">
                <div class="flex items-center gap-4">
                  <img src="https://readymadeui.com/team-1.webp" alt="profile-pic" class="w-[38px] h-[38px] rounded-full border-2 border-gray-200 cursor-pointer" />
                </div>

                <div class="dropdown-content invisible opacity-0 group-hover:visible group-hover:opacity-100 shadow-lg p-4 bg-white rounded-xl absolute top-[48px] right-0 w-64 transition-all duration-300 ease-in-out transform translate-y-2 group-hover:translate-y-0">
                  <div class="w-full space-y-2">
                    <a href="#" class="text-sm text-gray-700 hover:text-cyan-500 flex items-center p-2 rounded-lg hover:bg-cyan-50 transition duration-300">
                      <i class="fas fa-user mr-3 w-5 text-center"></i>
                      Profil
                    </a>
                    
                    <?php if($_SESSION["user_role"] == 1){ ?>

                      <a href="/dashboard" class="text-sm text-gray-700 hover:text-cyan-500 flex items-center p-2 rounded-lg hover:bg-cyan-50 transition duration-300">
                      <i class="fas fa-book mr-3 w-5 text-center"></i>
                      dashboard
                    </a>

                      <?php } else if($_SESSION["user_role"] == 0){ ?>
                    <a href="/dashboard/etudiant" class="text-sm text-gray-700 hover:text-cyan-500 flex items-center p-2 rounded-lg hover:bg-cyan-50 transition duration-300">
                      <i class="fas fa-book mr-3 w-5 text-center"></i>
                      dashboard
                    </a>
                    <?php } else{ ?>
                      
                      <p></p>

                    <?php } ?>


                    <hr class="my-2">
                    <form action="/logout" method="post">
                      <button type="submit" name="logout" class="w-full text-left text-sm text-red-500 hover:text-red-600 flex items-center p-2 rounded-lg hover:bg-red-50 transition duration-300">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                        Déconnexion
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <button id="toggleOpen" class='lg:hidden'>
            <svg class="w-7 h-7" fill="#333" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>
      </div>
    </header>

    <script>
      var toggleOpen = document.getElementById('toggleOpen');
      var toggleClose = document.getElementById('toggleClose');
      var collapseMenu = document.getElementById('collapseMenu');

      function handleClick() {
        if (collapseMenu.style.display === 'block') {
          collapseMenu.style.display = 'none';
        } else {
          collapseMenu.style.display = 'block';
        }
      }

      toggleOpen.addEventListener('click', handleClick);
      toggleClose.addEventListener('click', handleClick);
    </script>