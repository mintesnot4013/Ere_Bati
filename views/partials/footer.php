<script>
    var home_view = document.querySelector('.home_view');
    var music_id = document.querySelectorAll('.music_id');
    var artist_pro_container = document.querySelector('.artist_pro_container');
    var user_profile_container = document.querySelector('.user_profile_container');
    var playlist_container = document.querySelector('.playlist_container');

    var add_playlist_btn = document.querySelector('.add_playlist_btn');
    var playlist_input = document.querySelector('.playlist_input');
    var player_controll_container = document.querySelector('.player_controll_container');

    var darkBtn = document.querySelector('.darkMod');
    var closeDarkBtn = document.querySelector('.lightMod');
    var loading = document.querySelector('.loading');
    var music_controlls = document.querySelector('.music_controlls');
    var body = document.body;

    var fixed_albem_detail = document.querySelector('.fixed_albem_detail');
    var fixedMusicArtist = document.getElementById('fixedMusicArtist');
    var fixedMusicTitle = document.getElementById('fixedMusicTitle');
    var fixedMusicImage = document.getElementById('fixedMusicImage');

    var time_slider = document.getElementById('times');
    var timeCorsor = document.getElementById('timeCursor');
    var music_title = document.getElementById('music_title');
    var mutedImg = document.getElementById('muted');
    var song_artist = document.getElementById('song_artist');
    var artist_min = document.getElementById('artist_min');
    var carousel_inner = document.getElementById('carousel-inner');
    var audio = document.getElementById('audio');
    var next = document.getElementById('next');
    var pre = document.getElementById('pre');
    var stop = document.getElementById('stop');
    var play = document.getElementById('play');
    var main = document.getElementById('main');
    var song_image = document.getElementById('song_image');
    var song_title = document.getElementById('song_title');

    var footer = document.querySelector('.footer');
    var musicLister = document.querySelector('.musicLister');
    var card = document.querySelector('card');
    var controler = document.querySelector('.controler');
    var footerImg = document.querySelector('.footer_img');
    var MusicAlbum = document.querySelector('.MusicAlbum');
    var priPlay = document.getElementById('.priPlay');
    var input = document.querySelector('.inp');
    var all_music = document.querySelector('.all_music');
    var mostplayed = document.querySelector('.mostplayed');
    var active = document.querySelector('.active');
    var filterableCards = document.querySelector('.filterable_cards');
    var root = document.documentElement;
    let showVolume = document.getElementById('isVolume');
    var return_audio = document.getElementById('return_audio');
    let text_color = "#272727";

    let volume = document.getElementById('volume');
    let currentTrack = 0;
    var loop = false;
    let currentSlide = 0;
    let audioPlayed = false;

    const slides = document.querySelectorAll('.card');
    var exitFullScreen = document.getElementById('exitFullScreen');
    var fullScreen = document.getElementById('fullScreen');
    const totalSlides = slides.length;

    let count_imgs = document.querySelectorAll('.cont_img');
    let details = document.querySelectorAll('.details');

    function showSlide(index) {
        slides.forEach((slide) => {
            slide.style.transform = `translateX(-${index * 100}%)`;
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }


    //        from php -------------------------

    var musics = [<?php foreach ($musics as $music) {
                        echo  "'{$music['music']}',";
                    } ?>];
    var Image = [<?php foreach ($musics as $music) {
                        echo  "'{$music['image']}',";
                    } ?>];
    var artist = [<?php foreach ($musics as $music) {
                        echo  "'{$music['artist']}',";
                    } ?>];
    var title = [<?php foreach ($musics as $music) {
                        echo  "'{$music['title']}',";
                    } ?>];
    var id = [<?php foreach ($musics as $music) {
                    echo  "'{$music['id']}',";
                } ?>];


    audio.src = 'assets/' + musics[0];
    footerImg.src = 'assets/' + Image[0];
    song_title.innerHTML = title[0];

    song_image.src = 'assets/' + Image[0];

    music_title.innerHTML = title[0];

    song_artist.innerHTML = artist[0];

    artist_min.innerHTML = artist[0];

    fixedMusicArtist.innerHTML = artist[0];
    fixedMusicTitle.innerHTML = title[0];
    fixedMusicImage.src = 'assets/' + Image[0];

    //--------------------------------------------------------------------------


    document.addEventListener("keydown", e => {

        if (e.key.toLocaleLowerCase() == " ") {

            if (audioPlayed == false) {
                return playAudio();
            }
            if (audioPlayed == true) {
                return pauseAudio();
            }
        }

        if (e.key == "ArrowRight") {
            return nextAudio();
        }
        if (e.key == "ArrowLeft") {
            return previeus();
        }
        if (e.key == "ArrowUp") {
            return full_screen();
        }
        if (e.key == "ArrowDown") {
            return exit_full_screen();
        }



    })


    function play_up(card) {

        var music_sours = card.getAttribute("data-music_sours");
        var image_sours = card.getAttribute("data-image");
        var image_artist = card.getAttribute("data-artist");
        var image_title = card.getAttribute("data-title");
        var data_musice_id = card.getAttribute("data-id");


        audio.src = 'assets/' + music_sours;
        footerImg.src = 'assets/' + image_sours;
        song_image.src = 'assets/' + image_sours;



        for (var i = 0; i < music_id.length; i++) {
            var music_ids = document.querySelectorAll('.music_id')[i];
            music_ids.value = data_musice_id;

        }
        music_title.innerHTML = image_title;
        song_title.innerHTML = image_title;
        song_artist.innerHTML = image_artist;
        artist_min.innerHTML = image_artist;

        fixedMusicArtist.innerHTML = image_artist;
        fixedMusicTitle.innerHTML = image_title;
        fixedMusicImage.src = 'assets/' + image_sours;

        return playAudio();

    }


    function changeDuration() {

        let slider_position = audio.duration * (time_slider.value / 100);
        audio.currentTime = slider_position;

    }





    setInterval(
        function changePosition() {
            let position = 0;

            if (!isNaN(audio.duration)) {
                position = audio.currentTime * (100 / audio.duration);
                time_slider.value = position;
                time_slider.style.transition = '1s'

            }
        }, 10);




    for (var i = 0; i < music_id.length; i++) {
        var musics_id = document.querySelectorAll('.music_id')[i];
        musics_id.value = id[0];

    }


    function playAudio() {
        audio.play();
        stop.style.display = 'block';
        play.style.display = 'none';
        audioPlayed = true;



    }


    function pauseAudio() {
        audio.pause();
        stop.style.display = 'none';
        play.style.display = 'block';
        audioPlayed = false;



    }



    return_audio.addEventListener('click', function() {
        if (loop == false) {
            return_audio.style.transform = "rotate(180deg)";
            return_audio.style.scale = "0.7";
            return_audio.title = "no loop";
            loop = true;
            return_audio.style.transition = "1s";
        } else {
            return_audio.style.transform = "rotate(0)";
            return_audio.style.scale = "1";
            return_audio.title = "loop";
            loop = false;
            return_audio.style.transition = "1s";
        }



    });

    audio.addEventListener('ended', function() {

        if (loop == true) {
            playAudio();
        } else {
            return nextAudio();
        }

    })





    function previeus() {

        currentTrack--;

        var played = audio.src = 'assets/' + musics[currentTrack];
        music_title.innerHTML = title[currentTrack];
        song_title.innerHTML = title[currentTrack];

        footerImg.src = 'assets/' + Image[currentTrack];
        song_image.src = 'assets/' + Image[currentTrack];

        song_artist.innerHTML = artist[currentTrack];
        artist_min.innerHTML = artist[currentTrack];

        fixedMusicArtist.innerHTML = artist[currentTrack];
        fixedMusicTitle.innerHTML = title[currentTrack];
        fixedMusicImage.src = 'assets/' + Image[currentTrack];


        console.log(currentTrack);

        if (currentTrack < 1) {
            currentTrack = 2;
        }
        if (currentTrack == -1) {
            currentTrack = 2;
        }
        return playAudio();


    }

    function nextAudio() {
        currentTrack++;
        var played = audio.src = 'assets/' + musics[currentTrack];
        music_title.innerHTML = title[currentTrack];
        song_title.innerHTML = title[currentTrack];
        footerImg.src = 'assets/' + Image[currentTrack];
        song_image.src = 'assets/' + Image[currentTrack];
        song_artist.innerHTML = artist[currentTrack];
        artist_min.innerHTML = artist[currentTrack];

        fixedMusicArtist.innerHTML = artist[currentTrack];
        fixedMusicTitle.innerHTML = title[currentTrack];
        fixedMusicImage.src = 'assets/' + Image[currentTrack];

        if (musics.length <= currentTrack + 1) {
            currentTrack = -1;
            audio.play();

        }
        return playAudio();

    }

    function volumeChange() {

        showVolume.innerHTML = volume.value + '%';
        audio.volume = volume.value / 100;
        mutedImg.src = 'assets/ControlersIcon/volume.svg';

        if (audio.volume === 0) {
            return muteVolume();
        }

    }

    function muteVolume() {
        if (volume.value > 0) {
            volume.value = 0;
            showVolume.innerHTML = 0;
            mutedImg.src = 'assets/ControlersIcon/volume-xmark.svg';
            audio.volume = 0;
            return pauseAudio();
        } else {
            audio.volume = 30 / 100;
            showVolume.innerHTML = "30%";
            mutedImg.src = 'assets/ControlersIcon/volume-max-svgrepo-com.svg';

        }


    }


    function darker() {
        sessionStorage.setItem('dark', 1);
        darkMode()
    }

    function lighter() {
        sessionStorage.setItem('dark', 0);
        enableDarkMod();
    }

    var darkerclick = sessionStorage.getItem('dark');

    if (darkerclick == 1) {
        darkMode();
    }
    if (darkerclick == 0) {
        enableDarkMod();
    }

    function darkMode() {

        darkBtn.style.display = 'none'
        closeDarkBtn.style.display = 'block';
        music_title.style.color = 'white';
        artist_min.style.color = 'white';
        showVolume.style.color = 'white';
        body.style.color = 'white';
        footer.style.color = 'white';
        main.style.backgroundColor = '#ffffff18';
        music_controlls.style.backgroundColor = '#4a4a4a';
        input.style.backgroundColor = '#ffffff18';
        input.style.color = '#fff';
        root.style.setProperty('--audio-controls', '#838383');
        root.style.setProperty('--backgroundColor', ' #0b0b0b');
        root.style.setProperty('--hover-backgrounColor', '#9b9b9b');
        root.style.setProperty('--hover-color', text_color);
        root.style.setProperty('--text-color', '#dddddd');

        for (let i = 0; i < count_imgs.length; i++) {
            count_img = document.querySelectorAll('.cont_img')[i];
            count_img.style.filter = "invert(10)";
            count_img.style.opacity = "1";
        }

        for (var k = 0; k < details.length; k++) {

            detail = document.querySelectorAll('.details')[k];

            detail.style.color = "silver";
        }

    }



    function enableDarkMod() {
        darkBtn.style.display = 'block'
        closeDarkBtn.style.display = 'none';
        music_title.style.color = text_color;
        artist_min.style.color = text_color;
        showVolume.style.color = text_color;
        body.style.color = text_color;
        footer.style.color = text_color;
        music_controlls.style.backgroundColor = '#ebe8e8';
        music_controlls.style.color = '#fff';
        root.style.setProperty('--audio-controls', '#ebe8e8');
        root.style.setProperty('--backgroundColor', '#d0d0d0');
        root.style.setProperty('--text-color', '#272727');

        root.style.setProperty('--hover-backgrounColor', '#fff');
        for (let i = 0; i < count_imgs.length; i++) {
            count_img = document.querySelectorAll('.cont_img')[i];
            count_img.style.filter = "";
        }
        for (var k = 0; k < details.length; k++) {

            detail = document.querySelectorAll('.details')[k];

            detail.style.color = "#383838fd";
        }
    }


    add_playlist_btn.addEventListener('mousemove', function() {
        playlist_input.style.display = 'block';
        add_playlist_btn.innerHTML = "+";
        add_playlist_btn.type = 'submit';
    });

    all_music.addEventListener('click', function() {
        active.className = 'not_active';
        all_music.classList = 'active';
        home_view.style.display = 'none';
        playlist_container.style.display = 'block';
        user_profile_container.style.display = 'none';
        artist_pro_container.style.display = 'none';
    });

    active.addEventListener('click', function() {
        active.className = 'active';
        all_music.classList = 'not_active';
        home_view.style.display = 'block';
        home_view.style.animation = '.5s play_list_intro';
        playlist_container.style.display = 'none';
        user_profile_container.style.display = 'none';
        artist_pro_container.style.display = 'block';
    });


    function openProfile() {
        user_profile_container.style.display = 'block';
        home_view.style.display = 'none';
        playlist_container.style.display = 'none';
        artist_pro_container.style.display = 'none';
    }

    function artistPage() {
        user_profile_container.style.display = 'none';
        home_view.style.display = 'none';
        playlist_container.style.display = 'none';
        artist_pro_container.style.display = 'block';
    }


    function full_screen() {
        footerImg.style.position = "fixed";
        footerImg.style.width = "100%";
        footerImg.style.height = "100vh";
        footerImg.style.top = "0";
        footerImg.style.left = "0";
        footerImg.style.objectFit = "cover";
        footerImg.style.transition = ".1s";
        footerImg.style.filter = "brightness(.5) contrast(1.1) blur(2px)";
        controler.style.position = "fixed";
        exitFullScreen.style.display = "block";
        fullScreen.style.display = "none";
        exitFullScreen.style.margin = "8px 0 0 40px";
        fixed_albem_detail.style.display = "flex";

        darkMode();

    }

    function exit_full_screen() {
        footerImg.style.width = "50px";
        footerImg.style.height = "50px";
        footerImg.style.position = "relative";
        footerImg.style.objectFit = "cover";
        footerImg.style.transition = ".1s";
        footerImg.style.filter = "brightness(1)";
        controler.style.position = "relative";
        exitFullScreen.style.display = "none";
        fullScreen.style.display = "block";
        exitFullScreen.style.position = "relative";
        exitFullScreen.style.margin = "0";
        fixed_albem_detail.style.display = "none";

        if (darkerclick == 1) {
            darkMode();
        }
        if (darkerclick == 0) {
            enableDarkMod();
        }


    }
</script>

</html>