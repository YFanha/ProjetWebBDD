/**
 * Function to get a random number in imgTab Length
 * @param imgTab
 * @returns {number}
 */
function getRandomNumber(imgTab){
    return Math.floor(Math.random() * imgTab.length);
}

/*
    Function to get a random img for the banner
 */
document.addEventListener('DOMContentLoaded',() => {

    var images = ['Banner1.png', 'Banner2.jpg', 'Banner3.png' , 'Banner4.png'];

    var index = getRandomNumber(images);

    const BANNER = document.getElementById('mainBanner');

    BANNER.src = "view/content/images/Banner/" + images[index];
});


/**
 * Card Flip when click on it
 */
$(".flip").click(function(){
    $(this).parents(".card").toggleClass("flipped");
});
$(".clickcard").click(function(){
    $(this).toggleClass("flipped");
});