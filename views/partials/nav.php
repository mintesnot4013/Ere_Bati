   <nav>
       <header>
           <div class="img">&#9835</div>
           <h1>Ere Bati</h1>
       </header>

       <p>Recommended</p>
       <ul>

           <a href="/">
               <li title=" Home"><span>&#9835</span><span>Home</span></li>
           </a>
           <li title=" My Music" class="active"><a>&#9835</a><span> My Music</span></li>
           <li title="All song" class="all_music"><a>&#9835</a><span> All songs</span></li>
           <li title="Most Play" class="mostplayed"><a>&#9835</a> <span>Most played</span></li>
       </ul>

       <p>My Music</p>
       <ul>
           <li title="Albem"><a>&#9737 </a><span>Albums</span></li>
           <li title="Artist"><a> &#9737 </a><span>Artist</span></li>
       </ul>
       <p>following</p>

       <ul>
           <?php foreach ($followings as $following) : ?>

               <?php
                $followId =  $following['follower'];
                $follweUser = "select * from user where id = '$followId'";
                $followUsers = $conn->query($follweUser);
                ?>

               <?php foreach ($followUsers as $followUser) : ?>

                   <a href="/views/user_page.php?id= <?= $followUser['id'] ?>">
                       <li title="<?= $followUser['name'] ?>">
                           <img src="assets/avatars/<?= $followUser['image'] ?>">
                           <span><?= $followUser['name'] ?></span>
                       </li>
                   </a>

               <?php endforeach; ?>

           <?php endforeach; ?>
       </ul>


       <p>play list</p>
       <ul>
           <form method="post">
               <div class="playlist_input">
                   <li> <input type="text" name="playlist_name" placeholder="playlist"></li>
               </div>

               <li> <button type="button" name="playlist_btn" class="add_playlist_btn"> Add playlist</button>
               </li>
           </form>
           <?php

            $query = "select * from playlist_name where user_id = $my_id";
            $playlists = $conn->query($query);
            foreach ($playlists as $playlist) :
            ?>
               <li> <a>&#9779</a> <span><?= $playlist['playlist_name'] ?> </span></li>

           <?php endforeach; ?>

       </ul>

   </nav>