<x-app-layout>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container .mainpage .heading{
            font-size: 35px;
            padding: 20px 0;
            width: 100%;
            border-radius: 8px;
            text-align: center;
            /* border-bottom: 2px solid blue; */
            background: #ffffff;
            box-shadow:  14px 14px 55px #b5b5b5,
                        14px 14px 55px #ffffff;
        }
        .container{
            display: flex;
            width: 100%;
            position: absolute;
            top: 75px;
        }
        .sidebar{
            width: 20%;
            background: rgb(1, 1, 109);
            height: 100vh;
            overflow: hidden;
            position: relative;
        }
        .sidebar *{
            color: white;
        }
        .sidebar h1{
            text-align: center;
            font-size:25px; 
        }
        .mainpage{
            width: 80%;
            position: relative;
        }
        .tabContainer{
            margin-top:6rem;
        }
        .tabContainer ul li a{
            text-decoration: none;
            font-size: 20px;
            width: 100%;
        }
        .tabContainer ul li{
            padding: 7px;
            border-radius: 8px;
        }
        .tabContainer ul li:hover{
            background: grey;
        }
        table{
            width: 100%;
            outline: none;
            border: 2px solid rgb(56, 56, 1);
        }
        td{
            padding: 10px;
            text-align: left;
            font-size: 20px;
        }
        tr{
            text-align: left;
        }
        th{
            margin: 2px;
        padding: 6px 0;
        font-size: 25px;
        }
        .image{
            width: 11%;
            /* display: flex;
            justify-content: center;
            align-items: center; */
        }
        .image img{
            width: 60%;
        height: 90px;
        }
        .add-item {
            width: 8rem;
            height: 3rem;
        }
        .add-item h1 a:hover{
            background: rgb(210, 210, 13);
            /* color: black; */
        }
        .add-item h1 a{
            text-decoration: none;
            padding: 8px;
            transition: all 0.3s ease;
            display: block;
            font-size: 20px;
            color: white;
            border: 2px solid black;
            border-radius: 5px;
            background: rgb(140, 140, 12);
        }
       
        
        
    </style>
    
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1 style="padding-top:20px;">Admin Dashboard</h1>
            <div class="tabContainer">
                <ul>
                    <li><a href="#first">Dashboard</a></li>
                    <li><a href="#sec">Users</a></li>
                    <li><a href="#thd">Books</a></li>
                </ul>
            </div>
        </div>
        <div class="mainpage">
            <h1 class="heading">Admin Panel</h1>
            <div class="tabContent">
                
                <div id="sec">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Country Code</th>
                        </tr>
                        @foreach ($users as $user)
                            
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->countryCode}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div id="thd">
                    <div class="add-item">
                        <h1><a href="{{url('addBook')}}"><i class="fa-solid fa-plus"></i>Add Item</a></h1>
                    </div>
                    <table>
                        <tr>
                            <th>Book Image</th>
                            <th>Book Name</th>
                            <th>Author Name</th>
                            <th>Book Description</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($books as $book)
                            
                        <tr>
                            <td class="image"><img src="{{url('/upload')}}/{{$book->BookImage}}" alt=""></td>
                            <td>{{$book->BookName}}</td>
                            <td>{{$book->AuthorName}}</td>
                            <td>{{$book->BookDescription}}</td>
                            <td>
                                <a href="{{url('editBook')}}/{{$book->id}}" style="color:blue;"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{url('deleteBook')}}/{{$book->id}}"><i class="fa-solid fa-trash" style="color:red;"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        let tabContainer = document.querySelector('.tabContainer');
        let tabContent = document.querySelectorAll('.tabContent > div');

        tabContent.forEach((content,index)=>{
            if(index !== 5){
            content.setAttribute('hidden', 'true');
            }
        });

        tabContainer.addEventListener('click', (e) => {
            const clickedTab = e.target.closest('a');
            if(!clickedTab) return;
            e.preventDefault();

            const clickedLink = clickedTab.getAttribute('href');

            tabContent.forEach((content,index) => {
            content.setAttribute('hidden','true');
        });
        document.querySelector(clickedLink).removeAttribute('hidden');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>