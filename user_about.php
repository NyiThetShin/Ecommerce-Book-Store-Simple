<?php 

include "ecommerce_db.php";
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:ecommerce_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="user_style.css">
    <style>
    .about_info {
                background: url(home-bg.jpg);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width:100%;
                height:50vh;
                }
            .about_info h1{
                font-size: 100px;

            }
.reason{
    width: 100%;
    display: flex;
    padding: 30px;
    margin-top: 20px;
}
.reason_one{
    width: 50%;
    border-radius: 5px;
}
.reason_one img{
    width: 100%;
    overflow: hidden;
}
.reason_two{
    width: 50%;
    background: linear-gradient(to left,black,rgb(69, 44, 44));
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
}
.reason_two h1{
    font-size: 25px;
    color: white;
}
.reason_two p {
    font-size: 20px;
    color: white;
}
.reason_two a{
    border: 1px solid black;
    padding:5px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
} 
.review{
    width: 80%;
    margin: 0 auto;
    padding:20px;

}
.review h1{
    width: 100%;
    text-align: center;
}
.author{
    width: 100%;
    padding:20px;

}
.author h1{
    width:100%;
    text-align:center;
}
.box-container{
    width: 100%;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.box{
    width: 200px;
    padding:5px;
    text-align: center;
    mari
}
.box img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
}
.box .text{
    font-size: 15px ;
    margin-bottom: 10px;
}
.box p {
    font-size: 20px;
    font-weight: 500;
}
.box-container_two{
    width: 100%;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding:20px;
}
.box_two{
    width: 300px;
    text-align: center;
    border:1px solid black;
    box-shadow: 2px 2px 2px black;
    padding:5px;
     position: relative;
     overflow:hidden;
}
.box_two img {
    width: 80%;
    height: 200px;
    margin-bottom: 10px;
}
.share{
    width:50px;
    height: 50%;
    position: absolute;
    top: 1rem;
    left: -4rem;
    transition:all 1s ease;
}
.box_two:hover .share{
    left:0.5rem;
    top:1rem;
}
.share p{
    width:100%;
    padding: 10px 0;
    border-radius: 50%;
    border:1px solid black;
    margin-bottom:5px;
    transition:all 1s ease;
}
.share p:hover{
    background-color:purple;
    color:white;
}

    </style>
</head>
<body>
    <?php include "user_header.php" ?>
    <section class="about_info">
        <h1>About Us</h1>
    </section>
    <section class="reason">
        <div class="reason_one">
            <img src="about-us-career-hero-1.webp" alt="">
        </div>
        <div class="reason_two">
            <h1>Why Choose Us?</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi exercitationem error placeat ad libero ipsam!</p>
            <a href="user_contact">Contact Us</a>
        </div>
    </section>
    <section class="review">
        <h1>CLIENT'S VIEW</h1>
        <div class="box-container">
            <div class="box">
                <img src="pic-1.png" alt="">
                <p class="text">Lorem ipsum dolor sit amet.</p>
                <p>Alume</p>
            </div>
             <div class="box">
                <img src="pic-2.png" alt="">
                <p class="text">Lorem ipsum dolor sit amet.</p>
                <p>Alex</p>
            </div>
             <div class="box">
                <img src="pic-3.png" alt="">
                <p class="text">Lorem ipsum dolor sit amet.</p>
                <p>Bruno</p>
            </div>
             <div class="box">
                <img src="pic-4.png" alt="">
                <p class="text">Lorem ipsum dolor sit amet.</p>
                <p>Cike</p>
            </div>
             <div class="box">
                <img src="pic-5.png" alt="">
                <p class="text">Lorem ipsum dolor sit amet.</p>
                <p>Mile</p>
            </div>
            
        </div>
    </section>
    <section class="author">
        <h1>GREATE AUTHORS</h1>
        <div class="box-container_two">
            <div class="box_two">
                <img src="author-1.jpg" alt="">
                <p>Authors Aple</p>
                <div class="share">
                    <p>FB</p>
                    <p>IG</p>
                    <p>TW</p>
                </div>
            </div>
            <div class="box_two">
                <img src="author-2.jpg" alt="">
                <p>Alex</p>
                <div class="share">
                    <p>FB</p>
                    <p>IG</p>
                    <p>TW</p>
                </div>
            </div>
            <div class="box_two">
                <img src="author-3.jpg" alt="">
                <p>Luke</p>
                <div class="share">
                    <p>FB</p>
                    <p>IG</p>
                    <p>TW</p>
                </div>
            </div>
            <div class="box_two">
                <img src="author-4.jpg" alt="">
                <p>Desi</p>
                <div class="share">
                    <p>FB</p>
                    <p>IG</p>
                    <p>TW</p>
                </div>
            </div>
            
        </div>
        
    </section>
</body>
</html>