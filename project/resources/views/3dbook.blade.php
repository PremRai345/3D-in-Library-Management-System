<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
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
        box-shadow: 20px 20px 20px rgba(0,0,0,0.5);
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
<body>
    <section>
        <div class="book">
            <img src="{{url('/upload')}}/front.png" alt="">

        </div>
    </section>
</body>
</html>