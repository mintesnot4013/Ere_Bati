var artist_pro_container = document.querySelector('.artist_pro_container');
var user_profile_container = document.querySelector('.user_profile_container');
var playlist_container = document.querySelector('.playlist_container');
var home_view = document.querySelector('.home_view');





function artistPage(artistId) {
    artist_pro_container.style.display = 'block';
    user_profile_container.style.display = 'none';
    home_view.style.display = 'none';
    playlist_container.style.display = 'none';
}