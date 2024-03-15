<?php

include "partials/header.php";
$artistId = $_GET['id'];
$query = "SELECT * FROM `user` WHERE id = '$artistId'";
$users = $conn->query($query);

foreach ($users as $user) {
}

if (isset($_POST['follow'])) {
    $inser = "INSERT INTO `follow` (`id`, `follower`, `following`) VALUES (NULL, '$artistId', '$my_id')";
    $followind = $conn->query($inser);

    header("location:/");
}

if (isset($_POST['unfollow'])) {

    $delete = "DELETE FROM `follow` WHERE follower = '$artistId' AND following = '$my_id'";
    $followind = $conn->query($delete);
    header("location:/");
}
?>


<div class="artist_pro_container"">

    <div id=" artist" class="artist_profile_container" style="background-image:linear-gradient(to right,var(--backgroundColor),transparent,#00000000), url('assets/avatars/<?= $user["image"] ?>')" ;>
    <div class="card_text">
        <h1>
            <?= $user['name'] ?>
        </h1>

        <p>
            <?= $user['description'] ?>
        </p>


    </div>

    <?php

    $query = "select * from follow where follower = '$artistId'";
    $selected = $conn->query($query);
    foreach ($selected as $select) {
    }
    if ($select['following'] == $my_id) :
    ?>
        <form method="post">
            <button type="submit" name="unfollow" title=" follow <?= $user['name'] ?> "> Unfollow </button>
        </form>
    <?php else : ?>

        <form method="post">
            <button type="submit" name="follow" title=" follow <?= $user['name'] ?> "> Follow </button>
        </form>
    <?php endif; ?>

</div>

<div class="artist_playlist_container">
    <p>
        <?php
        $query = "select count(music) from music where user_id = '$artistId'";
        $music_counter = $conn->query($query);
        foreach ($music_counter as $counter) {
            echo $counter['count(music)'];
        }

        ?> songs</p>


    <?php

    $query = "select * from music where user_id = $artistId";
    $user_musics = $conn->query($query);
    foreach ($user_musics as $user_music) :
    ?>
        <li class="play_list" onclick="play_up(this)" title="click to open " data-music_sours="<?= $user_music['music'] ?>" data-image="<?= $user_music['image'] ?>" data-artist="<?= $user_music['artist'] ?>" data-title="<?= $user_music['title'] ?>">
            <div class="song_contain">
                <img src='assets/<?= $user_music['image'] ?>'>
                <div class="song_detail">
                    <span class="artist_name"> <?= $user_music['artist'] ?> </span>
                    <span class="song_name"><?= $user_music['title'] ?></span>
                </div>
            </div>
            <div class="options">
                <span>3:00</span>

            </div>
            <a href="assets/<?= $user_music['music'] ?>" download> <button> download </button>

        </li>
    <?php endforeach ?>

</div>
</div>

<?php

if (isset($_GET['id'])) {
    header('location:/?id=' . $artistId . '#artist');
}

?>