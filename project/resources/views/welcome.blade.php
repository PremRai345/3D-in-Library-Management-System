<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* body{
                display: flex;
                flex-direction: column;
                height: 100vh;
                width: 100%;
                justify-content: center;
                align-items: center;
            } */
            .card{
        margin:20px;
        }
        img{
            height:200px;
            background-size: cover; 
        }
        /* #anchor{
            position: absolute;
            right : 50px;
            top: 20px;
        } */
            nav{
                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                padding: 20px;
            }
            a{
                color: black;
                text-decoration: none;
                font-size: 20px;
            }
            .search{
                padding: 5px;
                border: 2px solid black;
                border-radius: 8px;
            }
            form{
                display: flex;
                flex-direction: row;
                gap: 14px;
            }
            
            button[type="reset"]{
                background:white;
                border:none;
                font-size:20px;
                position:relative;
            }
            button[type="reset"]:hover{
                color: blue;
            }
            .actions{
                position: relative;
                bottom: 0;
            }
            /* .card{
                border: 1px solid black;
                overflow: hidden;
                border-radius: 8px;
                flex-grow: 1;
            } */
            .maind{
                position: relative;
                top: 100px;
            }
            *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
       }
       /* body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
       } */
       section{
        position: absolute;
        top: 20px;
        left: 45%;
        display: flex;
        justify-content: center;
        align-items: center;
        transform-style: preserve-3d;
        perspective: 1000px;
       }
       section .book{
        position: relative;
        width: 100px;
        height: 150px;
        box-shadow: 20px 20px 20px rgba(0,0,0,0.2);
        transform-style: preserve-3d;
        transition: 1s;
       }
       section .book:hover{
        transform: rotateY(35deg);
       }
       section .book:active{
        transform: rotateY(180deg);
        box-shadow: 0px 20px 20px rgba(0,0,0,0.5);
       }
       section .book:before{
        content: '';
        position: absolute;
        width: 30px;
        height: 100%;
        transform-origin: left;
        background-image: url('http://127.0.0.1:8000/upload/mid.png');
       background-position: center;
       transform: rotateY(90deg);
       background-size: 100% 100%;
    }
    section .book:after{
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        transform-origin: center;
        background-image: url('http://127.0.0.1:8000/upload/back.png');
       background-position: center;
       transform: rotateY(180deg) translateZ(30px);
       background-size: 100% 100%;
    }
       section .book img{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;;
        height: 100%;
        object-fit: cover;
       }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        
                   
                        
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                <div>
                                    <form action="">                                        
                                        <div>
                                            <input type="text" name="search" class="search" placeholder="Search by Book Name" value="{{$search}}">
                                        </div>
                                        {{-- <div>
                                           
                                            <button type="reset">reset</button></a>
                                        </div> --}}
                                    </form>
                                </div>
                                
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                <div>
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>
                                </div>
                                <div>
                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    </div>
                                    @endif
                                    <div>
                                        <a href="{{url('avatar')}}" id="anchor">avatar</a>
                                    </div>
                                @endauth
                            </nav>
                        @endif
                        <section>
                            <div class="book">
                                <img src="{{url('/upload')}}/front.png" alt="">
                            </div>
                        </section>
    <div class="py-12 maind">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex;
                flex-direction:row;flex-wrap:wrap;margin: 20px 103px;">
                @foreach ($books as $book)
                
                <div class="card" style="width: 18rem;">
                    <img src="{{url('/upload')}}/{{$book->BookImage}}" alt="loading...">
                    <div class="card-body">
                        <p class="card-title">Book Name&nbsp;:&nbsp;{{$book->BookName}}
                            <br>
                        Author Name&nbsp;:&nbsp;{{$book->AuthorName}}</p>
                        <h6 class="card-text">{{$book->BookDescription}}</h6>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        <div class="actions">
                            <a href="{{url('view')}}/{{$book->id}}" class="btn btn-primary">View</a>
                        <a href="{{url('download')}}/{{$book->BookPdf}}" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
                            
 <script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script></script>
    </body>
</html>
