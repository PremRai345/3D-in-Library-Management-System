<x-app-layout style="position: absolute; top:250px;">
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

     --}}
</x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* .card{
        margin:20px;
        } */
        img{
            height:200px;
            background-size: cover; 
        }
        #anchor{
            position: absolute;
            right : 50px;
            top: 14px;
            text-decoration: none;
            font-size: 20px;
            color: black;
        }
        .srchform{
            display: flex;
            flex-direction: row;
            gap: 14px;
            position: absolute;
            top: 15px;
            right: 300px;
        }
        .srchform input{
            border: 1px solid black;
            border-radius: 8px;
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
        #container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    #normal-content {
      display: none; 
    }
    </style>
</head>
<body>
    <div id="container">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script>
    // Create a scene
    var scene = new THREE.Scene();

    // Create a camera
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    // Create a renderer
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.getElementById("container").appendChild(renderer.domElement);

    // Array of texture file paths for the book cover
    var textureUrls = [
      '{{url('/cube')}}/one.png'
    ];

    // Load textures
    var textureLoader = new THREE.TextureLoader();
    var coverTexture = textureLoader.load(textureUrls[0]);

    // Create material for the cover
    var coverMaterial = new THREE.MeshBasicMaterial({ map: coverTexture });

    // Create a box geometry for the book cover
    var coverGeometry = new THREE.BoxGeometry(2, 0.1, 3); // Adjust dimensions as needed

    // Create a mesh for the book cover
    var cover = new THREE.Mesh(coverGeometry, coverMaterial);
    scene.add(cover);

    // Function to animate the book
    function animate() {
      requestAnimationFrame(animate);

      // Rotate the book
      cover.rotation.y += 0.02;
      cover.rotation.x += 0.01;

      renderer.render(scene, camera);
    }

    animate();

    // Hide the book after 5 seconds
    setTimeout(function() {
      document.getElementById("container").style.display = "none";
      document.getElementById("normal-content").style.display = "block"; // Show the normal content
    }, 5000);
  </script>
      </div>
      <div id="normal-content">
    @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        <div>
            <form action="" class="srchform">
                <input type="text" name="search" placeholder="Search by Book Name" value="{{$search}}">
            </form>
        </div>
        @auth
            {{-- <a
                href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </a> --}}
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
        @endauth
        <div>
            <a href="{{url('avatar')}}" id="anchor">avatar</a>
        </div>
    </nav>
@endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex;
                flex-direction:row;flex-wrap:wrap;gap: 5px;">
                @foreach ($books as $book)
                
                <div class="card" style="width: 18rem;">
                    <img src="{{url('/upload')}}/{{$book->BookImage}}" alt="loading...">
                    <div class="card-body">
                        <p class="card-title">Book Name&nbsp;:&nbsp;{{$book->BookName}}
                            <br>
                        Author Name&nbsp;:&nbsp;{{$book->AuthorName}}</p>
                        <h6 class="card-text">{{$book->BookDescription}}</h6>
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                        <a href="{{url('view')}}/{{$book->id}}" class="btn btn-primary">View</a>
                        <a href="{{url('download')}}/{{$book->BookPdf}}" class="btn btn-primary">Download</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
