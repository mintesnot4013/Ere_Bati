<?php
include "views/partials/header.php";
include "views/partials/nav.php";
if (isset($_POST['logout'])) {
    $_SESSION =  [];
    session_destroy();
    header("location:/");
}
?>


<main id="main">
    <header>
        <div class="input">
            <input class="inp" type="search" placeholder="Search">
        </div>
        <div onclick="document.querySelector('.user_menu').style.display = 'flex'" class="user">
            <?php
            if (isset($_SESSION['email'])) :
            ?>
            <img src="assets/avatars/<?= $myProfile['image'] ?>" alt="user_avatar">
            <h3> <?= $myProfile['name'] ?></h3>

            <div onmouseleave="this.style.display = 'none'" class="user_menu">
                <button onclick="openProfile()"> <img src="assets/ControlersIcon/user-regular.svg"
                        alt="">profile</button>
                <button> <img src="assets/ControlersIcon/arrow-up.svg" alt=""> upload</button>
                <button> <img src="assets/ControlersIcon/circle-right.svg" alt=""> setting</button>
                <form method="post">
                    <button type="submit" name="logout"> <img src="assets/ControlersIcon/arrow-right-from-bracket.svg"
                            alt="">logout</button>

                </form>
            </div>

            <?php else : ?>
            <a href="views/login.php">
                <button class="login_button"> LOGIN</button>
            </a>
            <?php endif ?>

        </div>
    </header>
    <hr>



    <div style="animation: play_list_intro .5s;" class="home_view">
        <div style="display: none;" class="albem_art">
            <img src="" id="song_image">
            <div class="songs_property">
                <div class="details">
                    <span>Title:</span>
                    <h1 id="song_title"> title</h1>
                </div>
                <div class="details">
                    <span>Artist:</span>
                    <h1 id="song_artist">Imagen Dragon </h1>
                </div>
                <div class="details">
                    <span>Date Added:</span>
                    <h1>2020:23:23</h1>
                </div>
                <div class="btns">
                    <button onclick="document.querySelector('.playlists').style.scale = '1'"> Add to playlist</button>
                    <div class="playlists">
                        <?php
                        $query = "select * from `playlist_name` where `user_id` = '$my_id'";
                        $play_lists = $conn->query($query);
                        foreach ($play_lists as $play_list) :

                        ?>
                        <form method="post">
                            <input type="hidden" name="playlist_id" value="<?= $play_list['id'] ?>">
                            <input type="hidden" class="music_id" name="music_id" value="">
                            <button name="add_playlist" type="submit"> <?= $play_list['playlist_name'] ?></button>
                        </form>

                        <?php endforeach; ?>


                    </div>

                    <button> more detail</button>
                </div>



            </div>
        </div>

        <?php
        if (isset($_GET['id'])) {
            include "views/user_page.php";
        }       ?>

        <?php
        if (isset($_GET['id'])) {
            $musicDisplay = "none";
        } else {
            $musicDisplay = "flex";
        }

        ?>




        <!--    user_avator         -->

        <div style="display: <?= $musicDisplay ?>;" class="overflow_container">

            <?php
            $query = "select * from user where active = 1";
            $artists = $conn->query($query);

            foreach ($artists as $artist) :
            ?>
            <a href="views/user_page.php?id=<?= $artist['id'] ?>"">


                    <div onclick=" artistPage(<?= $artist['id'] ?>)" class="user_artist_container">
                <span>
                    <img src='assets/avatars/<?= $artist['image'] ?>'>
                </span>
                <span>
                    <?= $artist['name'] ?>
                </span>
        </div>
        </a>
        <?php
            endforeach;
    ?>
    </div>

    <!--   user      -->

    <div style="display: <?= $musicDisplay ?>;" class="filterable_cards">

        <span style="position: absolute;margin: -30px 0 0 0;font-size: 20px;"> Artist</span>
        <?php
        foreach ($artists as $artist) :
        ?>
        <a href="views/user_page.php?id=<?= $artist['id'] ?>"">

            <div class='card'>
                <img src='assets/avatars/<?= $artist['image'] ?>'>
                <p>
                    <?= $artist['name'] ?>
                    

                </p>

    </div>
    </a>
<?php
        endforeach;
?>



</div>



<!--        -->

<div style=" display: <?= $musicDisplay ?>;" class="filterable_cards">
            <span style="position: absolute;margin: -30px 0 0 0;font-size: 20px;"> Songs</span>

            <?php
                foreach ($musics as $music) :
                ?>
            <div onclick="play_up(this)" title="click to open " data-music_sours="<?= $music['music'] ?>"
                data-image="<?= $music['image'] ?>" data-artist="<?= $music['artist'] ?>"
                data-title="<?= $music['title'] ?>" data-id="<?= $music['id'] ?>" class='card'>
                <img src='assets/<?= $music['image'] ?>'>
                <p>
                    <?= $music['artist'] ?>
                    <br>
                    <span> <?= $music['title'] ?></span>
                </p>

            </div>
            <?php
                endforeach;
                ?>

                <button type="submit" name="showMore" onclick="nextSlide()">
                    <img src="assets/ControlersIcon/caret-right.svg" alt="">
                </button>



    </div>

    </div>


    <!--  all songs    -->

    <div style="display: none;" class="playlist_container">
        <p>

            <?php
            $query = "select count(music) from music";
            $music_counter = $conn->query($query);
            foreach ($music_counter as $counter) {
                echo $counter['count(music)'];
            }

            ?> songs</p>


        <?php
        foreach ($musics as $music) :
        ?>
        <div class="play_list" onclick="play_up(this)" title="click to open " data-music_sours="<?= $music['music'] ?>"
            data-image="<?= $music['image'] ?>" data-artist="<?= $music['artist'] ?>"
            data-title="<?= $music['title'] ?>">
            <div class="song_contain">
                <img src='assets/<?= $music['image'] ?>'>
                <div class="song_detail">
                    <span class="artist_name"> <?= $music['artist'] ?> </span>
                    <span class="song_name"><?= $music['title'] ?></span>
                </div>
            </div>
            <div class="options">
                <span>3:00</span>

            </div>

        </div>
        <?php endforeach ?>

    </div>



    <div class="user_profile_container">

        <div id="artist" class="artist_profile_container"
            style="background-image:linear-gradient(to right,var(--backgroundColor),transparent,#00000000), url('assets/avatars/<?= $myProfile["image"] ?>')"
            ;>
            <div class="card_text">
                <h1>
                    <?= $myProfile['name'] ?>
                </h1>
                <p>
                    <?= $myProfile['description'] ?>
                </p>
            </div>
        </div>


        <div class="over_view">
            <div class="public_playlist">
                <p> Public Playlists</p>
            </div>
            <hr>

            <div class="playlist_container">

                <?php
                $my_id = $myProfile['id'];
                $query = "select * from music where user_id = '$my_id'";
                $musics = $conn->query($query);

                foreach ($musics as $music) :
                    $id = $music['id'];
                ?>

                <div class="play_con">

                    <div oncontextmenu="alert('<?= $id ?>')" class="play_list" onclick="play_up(this)"
                        title="click to open " data-music_sours="<?= $music['music'] ?>"
                        data-image="<?= $music['image'] ?>" data-artist="<?= $music['artist'] ?>"
                        data-title="<?= $music['title'] ?>">
                        <div class="song_contain">
                            <img src='assets/<?= $music['image'] ?>'>
                            <div class="song_detail">
                                <span class="artist_name"> <?= $music['artist'] ?> </span>
                                <span class="song_name"> <?= $music['title'] ?></span>
                            </div>
                        </div>
                        <div class="options">
                            <span>3:00</span>

                        </div>

                    </div>

                </div>

                <?php endforeach ?>
            </div>



        </div>


    </div>


</main>

<button onclick="darker()" class="darkMod"> </button>
<button onclick="lighter()" class="lightMod"> </button>

<footer class="footer">

    <div style="display: none;" class="fixed_albem_detail">
        <span><img id="fixedMusicImage" src="" alt=""></span>
        <div class="details">
            <span id="fixedMusicTitle">Music title</span>
            <span id="fixedMusicArtist">Artist</span>
        </div>
    </div>



    <div class="music_controlls">
        <div onclick="openFullScreen()" class="left_albem">
            <img src="" class="footer_img">

            <div class="audio_details">
                <ul>
                    <li id="music_title"> Music Name </li>
                    <li id="artist_min"> Imagen Dragon </li>
                </ul>

                <audio id="audio">
                </audio>
            </div>

        </div>


        <div class="controler">
            <img class="cont_img" title="random" onclick="random()" src="assets/ControlersIcon/random-svgrepo-com.svg">
            <img class="cont_img" title="previeus" onclick="previeus()" id="pre"
                src="assets/ControlersIcon/left-arrow-svgrepo-com.svg">
            <img class="cont_img" title="pause" onclick="pauseAudio()" style=" display:none;" id="stop"
                src="assets/ControlersIcon/pause-svgrepo-com.svg">
            <img class="cont_img" title="play" onclick="playAudio()" id="play"
                src="assets/ControlersIcon/play-svgrepo-com.svg">
            <img class="cont_img" title="next" onclick="nextAudio()" id="next"
                src="assets/ControlersIcon/right-arrow-svgrepo-com.svg">
            <img class="cont_img" title="loop " onclick="returnAudio()" id="return_audio"
                src="assets/ControlersIcon/repeat-svgrepo-com.svg">
        </div>

        <div class="time">
            <input onload="changeDuration()" oninput="changeDuration()" type="range" min="0" max="100" value="0"
                id="times">
        </div>

        <div class="volume">
            <img class="cont_img" title="mute" onclick="muteVolume()"
                src="assets/ControlersIcon/volume-max-svgrepo-com.svg" id="muted">
            <input class="cont_img" type="range" oninput="volumeChange()" id="volume">
            <br>
            <p id="isVolume"> 30% </p>
            <img class="cont_img" style="display: none;" title="exit full screen" onclick="exit_full_screen()"
                id="exitFullScreen" src="assets/ControlersIcon/arrows-to-circle.svg" alt="">
            <img class="cont_img" style="margin: 8px 0 0 40px;" title="full screen" id="fullScreen"
                onclick="full_screen()" src="assets/ControlersIcon/arrow-up-right-from-square.svg" alt="">
        </div>

    </div>
</footer>

</div>

</body>

<?php


$musics = $conn->query($quary);


?>

<?php
include "views/partials/footer.php";
?>