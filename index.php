<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['user'])){
 header('location:index.php');
}
//Restrict User or Moderator to Access Admin.php page
if($_SESSION['user']['role']=='user'){
 header('location:user.php');
}
if($_SESSION['user']['role']=='moderator'){
 header('location:moderator.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/lunatici.png">
    <script src="https://kit.fontawesome.com/7817064cff.js" crossorigin="anonymous"></script><script src="https://kit.fontawesome.com/7817064cff.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <script src="player.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href=”//vjs.zencdn.net/7.0/video-js.min.css” rel=”stylesheet”> 
    <script src=”//vjs.zencdn.net/7.0/video.min.js” ></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunatici - Home</title>
</head>
<style>
input[type="submit"][name="submit"]{border:none; background:#000; color:#fff}
</style>
<body>
    <div class="nav_bar">
    <div class="nav">
    <h3>
    <a href="">I Lunatici</a>
    <a id="yt" href="https://www.youtube.com/user/soundfloyd" target="_blank" style="float: right; color: red;"><i class="fab fa-youtube fa-2x"></i></a>
    <a id="fb" style="float: right; color: #385898;" href="https://www.facebook.com/blackmoon1973" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>    
</h3>
    </div>
    <nav>
            <ul>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="">Video</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="contact.php">Contatti</a></li>
            </ul>
        </nav>
    </div>
    <br>
    <h1 style="text-align: center;">CHI SIAMO</h1>
    <div class="presentazione">
        <img style="float: left;" src="img/lunatici.png" alt="">
        <p style="text-align: left; font-family: sans-serif;">I Lunatici nascono nel 2012, ed il loro nucleo musicale è sempre stato fortemente guidato dal sound dei Pink Floyd, protagonisti assoluti delle atmosfere
         innovative del rock psichedelico degli anni 60/70. Questa è l’essenza dei Lunatici : una attenta ricerca delle radici e dei brani mitici che hanno caratterizzato l’evoluzione del gruppo britannico sin dagli esordi con Syd Barrett. Lo show proposto da I Lunatici ripercorre le tappe principali di questa evoluzione e sperimentazione, attraverso una selezione accurata delle tecniche sonore uniche ed inconfondibili dei Pink Floyd, da Echoes e Astronomy Domine, fino al raffinatissimo sound di The Dark Side of The Moon. Il percorso continua con i più famosi brani di Wish You Were Here, veri capolavori del Rock, con le atmosfere psicologiche create dal genio di Roger Waters con The Wall , fino a concludersi con la maturazione e l’eccellenza orchestrale di David Gilmour con brani che raramente si ha l’opportunità di ascoltare in versione live, come Marooned o Green is the Colour. Un vasto e completo repertorio, pazientemente assemblato da I Lunatici effettuando una ricerca che è in continua evoluzione, sempre con nuove proposte ed integrazioni, perche la musica dei Pink Floyd è qualcosa di straordinariamente attuale e ne siamo certi resterà eterna.</p>
    </div>
    <h1 style="text-align: center;">VIDEO / FOTO</h1>
    <div class="center">
    <div class="video">
    <img width="31%" src="img/1.png" alt="">
            <div id="wrapper">
        <div id='player_wrapper'>
        <video id='video_player'>
        <source src='img/video.mp4' type='video/mp4'>
        </video>
        </div>
        </div>
        <img width="31%" src="img/2.png" alt="">
    </div>
    </div>
    <h1 style="text-align: center;">Prossimi Concerti</h1>
    <?php 
        $conn = mysqli_connect("localhost","root","","lunatici");
        $sql = "SELECT *, DATE_FORMAT(data, '%d-%m-%Y') AS data FROM tours";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="next_concerts">
            <img src="img/concert1.png" alt="">
            <p><?php echo $row['nome']; ?></p>
            <p><?php echo $row['data']; ?></p>
            <p style="font-weight: 600px;"><?php echo $row['descrizione']; ?></p>
            <form action="" method="POST">
                    <!-- Modal HTML embedded directly into document -->
                    <div id="ex1" class="modal">
                    <?php 
                    error_reporting(0);
                    if(isset($_POST['submit'])){
                        if($_SESSION['user']['username']){
                            echo "sei loggato!";
                         }else{
                            echo "non sei loggato!";
                         }
                    }
                    ?>
                    </div>

                    <!-- Link to open the modal -->
                    <a style="text-decoration: none;" name="submit" href="#ex1" class="concert_prenot" rel="modal:open">Partecipa</a>
            </form>
        </div>
        <?php } ?>
    <h2 style="text-align: center;">Iscriviti, per rimanere aggiornado sui nuovi eventi!</h2>
    <div class="center">
    <div class="news_letter">
        <form action="" method="POST">
        <input style="font-family: sans-serif;" type="text" name="" class="inputs" placeholder="Nome" required>
        <br>
        <br>
        <input style="font-family: sans-serif;" type="email" name="" class="inputs" placeholder="Indirizzo Email" required>
        <br>
        <br>
        <input style class="subscribe" type="submit" value="Iscriviti ora">
        </form>
    </div>
    </div>
    <footer>
        <div class="copyright">
            <p style="text-align: center;">Copyright &copy; 2020 - 2021 | Lunatici</p>
        </div>
    </footer>
</body>
</html>