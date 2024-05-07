<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('github.logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                @else
                    <a href="{{ route('github.login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                            
                    <svg width="290px" height="37px" viewBox="0 0 247.968 37" version="1.1" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0.230184988,0.739641429 C0.300073946,0.628855357 0.382145431,0.527674895 0.477681728,0.438021393 C0.573218026,0.34772755 0.678372116,0.270881692 0.793143999,0.207483818 C0.907915883,0.144085944 1.02909952,0.096057405 1.15605377,0.0640382154 C1.28364932,0.0313786846 1.41252716,0.0147287977 1.54396989,0.0153691717 L17.8486245,0.0153691717 C17.9948143,0.0153691717 18.1371571,0.0358614006 18.2769351,0.0768458585 C18.4173543,0.117189975 18.5487969,0.176745474 18.6719041,0.254231674 C18.7943702,0.331718038 18.9046537,0.42521375 19.0008312,0.534078634 C19.0976499,0.642303341 19.1771567,0.762695186 19.2399927,0.893333146 L26.0089667,14.9484407 L32.761911,0.878604315 C32.8247469,0.747326014 32.9042537,0.62693417 33.0010724,0.518069121 C33.0978912,0.409204237 33.2075336,0.316348866 33.331282,0.238222161 C33.4543892,0.160735962 33.5858318,0.101820803 33.726251,0.0608363456 C33.8660289,0.0204922289 34.0090129,0 34.1545616,0 L50.4579339,0 C50.5226934,0 50.5874529,0.00448268327 50.6515712,0.0128076431 C50.7163307,0.0211325701 50.7798079,0.033299872 50.842644,0.0493093849 C50.9054799,0.0653190617 50.9670335,0.0858112906 51.0273048,0.109505389 C51.087576,0.133839829 51.1459237,0.161376303 51.202989,0.192754987 C51.2594131,0.224133836 51.3139137,0.25871439 51.3664908,0.297137319 C51.4190678,0.334919907 51.4690802,0.376544706 51.5158865,0.420731034 C51.563334,0.465557867 51.6075758,0.512946064 51.6486116,0.562895954 C51.6896473,0.61284568 51.727477,0.664716758 51.762101,0.719789541 C51.796725,0.774862324 51.8275018,0.831215954 51.8550726,0.890131276 C51.8826435,0.948405929 51.9063672,1.00860193 51.926244,1.07007862 C51.9461207,1.13219565 51.9615091,1.19431268 51.9736915,1.25835089 C51.985874,1.32174877 51.9935682,1.38578698 51.9974154,1.45046554 C52.0012624,1.51514426 52.0006212,1.57982281 51.9967742,1.64450137 C51.9922859,1.70853959 51.9839504,1.7725778 51.9711269,1.83661602 C51.9589444,1.90001389 51.9422735,1.96213092 51.9223968,2.02360761 C51.9018789,2.08508429 51.877514,2.1452803 51.8499431,2.20355495 L35.5446473,36.1213958 C35.4824524,36.2526741 35.4023045,36.3724257 35.3061271,36.4812905 C35.2093083,36.5901554 35.0996659,36.683011 34.9765587,36.7611375 C34.8534515,36.8386239 34.7220089,36.8975389 34.582231,36.9385233 C34.4424529,36.9788674 34.2994689,36.9993597 34.1539202,37 L17.8486245,37 C17.7030758,37 17.5600919,36.9795078 17.4203139,36.9385233 C17.280536,36.8981794 17.1490933,36.8392642 17.0259861,36.7611375 C16.9028788,36.6836513 16.7925953,36.5901554 16.6957767,36.4812905 C16.5995991,36.373066 16.5194512,36.2526741 16.4572563,36.1213958 L0.153884113,2.21892412 C0.0974599674,2.10237465 0.0564242248,1.98070196 0.0307768857,1.85390638 C0.00512954661,1.72711063 -0.00448824659,1.5990342 0.00192350611,1.46967708 C0.0089765654,1.34031981 0.0314180281,1.21352422 0.0698890368,1.08993051 C0.109001188,0.966977134 0.162219458,0.849787159 0.230184988,0.739641429 Z M34.5003083,5 L40,17 L29,17 L34.468857,5 L34.5003083,5 Z M4.02960139,3 L9.50030841,15 L15,3 L4,3 L4.0308347,3 L4.02960139,3 Z M17.4925893,5 L23,17 L12,17 L17.4771503,5 L17.4925893,5 Z M37.030218,3 L42.4996917,15 L48,3 L37,3 L37.030218,3 Z M34.4928784,32 L29,20 L40,20 L34.478016,32 L34.4928784,32 Z M31,34 L25.4848501,22 L20,34 L31,34 Z M17.5145314,32 L12,20 L23,20 L17.4842318,32 L17.5145314,32 Z" fill="#25C4F2" /><path d="M66.4,22.7 L74.5,22.7 L74.5,26.6 L62.2,26.6 L62.2,5.9 L66.4,5.9 L66.4,22.7 L66.4,22.7 Z M88,11.8 L91.9,11.8 L91.9,26.6 L88,26.6 L88,24.9 C86.9,26.2 85.3,27.1 83,27.1 C78.9,27.1 75.6,23.7 75.6,19.3 C75.6,14.9 79,11.5 83,11.5 C85.2,11.5 86.9,12.3 88,13.7 L88,11.8 L88,11.8 Z M88,19.2 C88,16.7 86.2,15 83.8,15 C81.4,15 79.6,16.7 79.6,19.2 C79.6,21.7 81.4,23.4 83.8,23.4 C86.2,23.4 88,21.7 88,19.2 Z M99.4,14.3 L99.4,11.8 L95.5,11.8 L95.5,26.6 L99.4,26.6 L99.4,19.5 C99.4,16.4 102,15.5 104,15.7 L104,11.4 C102.2,11.5 100.2,12.3 99.4,14.3 L99.4,14.3 Z M117.4,11.8 L121.3,11.8 L121.3,26.6 L117.4,26.6 L117.4,24.9 C116.3,26.2 114.7,27.1 112.4,27.1 C108.3,27.1 105,23.7 105,19.3 C105,14.9 108.4,11.5 112.4,11.5 C114.6,11.5 116.3,12.3 117.4,13.7 L117.4,11.8 L117.4,11.8 Z M117.4,19.2 C117.4,16.7 115.6,15 113.2,15 C110.8,15 109,16.7 109,19.2 C109,21.7 110.8,23.4 113.2,23.4 C115.6,23.4 117.4,21.7 117.4,19.2 Z M131.2,22.2 L127.5,11.9 L123.2,11.9 L129,26.7 L133.5,26.7 L139.3,11.9 L135,11.9 L131.2,22.2 Z M155.5,19.2 C155.5,19.8 155.4,20.3 155.3,20.8 L143.8,20.8 C144.3,22.8 146,23.6 148.1,23.6 C149.6,23.6 150.8,23 151.5,22.1 L154.7,23.9 C153.3,25.9 151,27.1 148.1,27.1 C143,27.1 139.7,23.7 139.7,19.3 C139.7,14.9 143,11.5 147.7,11.5 C152.3,11.4 155.5,14.8 155.5,19.2 L155.5,19.2 Z M151.6,17.8 C151.1,15.7 149.5,14.8 147.8,14.8 C145.7,14.8 144.3,15.9 143.8,17.8 L151.6,17.8 Z M158.2,26.6 L162.1,26.6 L162.1,5 L158.2,5 L158.2,26.6 Z M189.112,6.064 L190.904,6.064 L182.28,26 L180.684,26 L172.06,6.064 L173.88,6.064 L181.496,23.76 L189.112,6.064 Z M203.756,11.972 L203.756,26 L202.048,26 L202.048,23.312 C201.637333,24.2453333 201.016667,24.9593333 200.186,25.454 C199.355333,25.9486667 198.361333,26.196 197.204,26.196 C195.953333,26.196 194.856667,25.902 193.914,25.314 C192.971333,24.726 192.243333,23.886 191.73,22.794 C191.216667,21.702 190.96,20.428 190.96,18.972 C190.96,17.516 191.221333,16.2326667 191.744,15.122 C192.266667,14.0113333 192.999333,13.1526667 193.942,12.546 C194.884667,11.9393333 195.972,11.636 197.204,11.636 C198.342667,11.636 199.327333,11.8786667 200.158,12.364 C200.988667,12.8493333 201.618667,13.5586667 202.048,14.492 L202.048,11.972 L203.756,11.972 Z M197.456,24.684 C198.912,24.684 200.041333,24.18 200.844,23.172 C201.646667,22.164 202.048,20.7453333 202.048,18.916 C202.048,17.068 201.646667,15.64 200.844,14.632 C200.041333,13.624 198.902667,13.12 197.428,13.12 C195.953333,13.12 194.805333,13.638 193.984,14.674 C193.162667,15.71 192.752,17.1426667 192.752,18.972 C192.752,20.7826667 193.162667,22.1873333 193.984,23.186 C194.805333,24.1846667 195.962667,24.684 197.456,24.684 Z M214.956,11.636 C216.188,11.636 217.275333,11.9393333 218.218,12.546 C219.160667,13.1526667 219.893333,14.0113333 220.416,15.122 C220.938667,16.2326667 221.2,17.516 221.2,18.972 C221.2,20.428 220.943333,21.6973333 220.43,22.78 C219.916667,23.8626667 219.184,24.7026667 218.232,25.3 C217.28,25.8973333 216.188,26.196 214.956,26.196 C213.78,26.196 212.776667,25.9393333 211.946,25.426 C211.115333,24.9126667 210.494667,24.1706667 210.084,23.2 L210.084,32.048 L208.404,32.048 L208.404,15.864 C208.404,14.408 208.329333,13.1106667 208.18,11.972 L209.804,11.972 L210.028,14.716 C210.438667,13.7266667 211.068667,12.966 211.918,12.434 C212.767333,11.902 213.78,11.636 214.956,11.636 Z M214.732,24.684 C216.206667,24.684 217.354667,24.1846667 218.176,23.186 C218.997333,22.1873333 219.408,20.7826667 219.408,18.972 C219.408,17.1426667 218.997333,15.71 218.176,14.674 C217.354667,13.638 216.216,13.12 214.76,13.12 C213.266667,13.12 212.118667,13.624 211.316,14.632 C210.513333,15.64 210.112,17.068 210.112,18.916 C210.112,20.7453333 210.513333,22.164 211.316,23.172 C212.118667,24.18 213.257333,24.684 214.732,24.684 Z M230.524,26.196 C229.236,26.196 228.102,25.8973333 227.122,25.3 C226.142,24.7026667 225.386,23.8533333 224.854,22.752 C224.322,21.6506667 224.056,20.372 224.056,18.916 C224.056,17.46 224.322,16.1813333 224.854,15.08 C225.386,13.9786667 226.142,13.1293333 227.122,12.532 C228.102,11.9346667 229.236,11.636 230.524,11.636 C231.793333,11.636 232.913333,11.9346667 233.884,12.532 C234.854667,13.1293333 235.606,13.9786667 236.138,15.08 C236.67,16.1813333 236.936,17.46 236.936,18.916 C236.936,20.372 236.67,21.6506667 236.138,22.752 C235.606,23.8533333 234.854667,24.7026667 233.884,25.3 C232.913333,25.8973333 231.793333,26.196 230.524,26.196 Z M230.496,24.684 C231.989333,24.684 233.142,24.1846667 233.954,23.186 C234.766,22.1873333 235.172,20.764 235.172,18.916 C235.172,17.0866667 234.761333,15.6633333 233.94,14.646 C233.118667,13.6286667 231.98,13.12 230.524,13.12 C229.049333,13.12 227.901333,13.6286667 227.08,14.646 C226.258667,15.6633333 225.848,17.0866667 225.848,18.916 C225.848,20.7826667 226.249333,22.2106667 227.052,23.2 C227.854667,24.1893333 229.002667,24.684 230.496,24.684 Z M246.736,11.636 C247.202667,11.636 247.613333,11.6733333 247.968,11.748 L247.884,13.288 C247.529333,13.2133333 247.1,13.176 246.596,13.176 C245.177333,13.176 244.118,13.6286667 243.418,14.534 C242.718,15.4393333 242.368,16.5173333 242.368,17.768 L242.368,26 L240.688,26 L240.688,15.864 C240.688,14.408 240.613333,13.1106667 240.464,11.972 L242.088,11.972 L242.312,14.576 C242.666667,13.624 243.240667,12.896 244.034,12.392 C244.827333,11.888 245.728,11.636 246.736,11.636 Z" fill="#ffffff" fill-rule="nonzero" /></g></svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    {{-- Adicionar header --}}
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-2 text-2xl">
                            @auth
                                Olá, {{auth()->user()->name}}!!
                                <br>
                            @endauth
                            Bem vindo ao Laravel VaporUi
                        </div>
                        @auth
                            <div class="mt-4 text-gray-500">
                                Volte ao painel do Laravel VaporUI.
                            </div>
                        @else
                            <div class="mt-8 text-gray-500">
                                Este é um caminho para acessar o painel do Laravel VaporUI.
                            </div>
                            <div class="mt-6 text-gray-500">
                                Você precisa estar autenticado no GitHub para acessar o painel.
                            </div>
                            <div class="mt-6 text-gray-500">
                                E ter permissão de colaborador no projeto.
                            </div>
                        @endauth
                        {{-- TODO - Falta apenas mostrar a mensagem de erro caso o usuário não tenha permissão para fazer login --}}
                        @auth
                            <div class="mt-4">
                                <a href="{{ route('vapor-ui') }}" class="mt-8 text-sm text-gray-700 dark:text-gray-500 underline">Painel</a>
                            </div>
                        @else
                            <div class="mt-4">
                                <a href="{{ route('github.login') }}" class="mt-8 text-sm text-gray-700 dark:text-gray-500 underline">Login</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg class="w-5 h-8 text-gray-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>

                            <a href="https://github.com/Zoren-Software" class="ml-1 underline">
                                Zoren Software
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>