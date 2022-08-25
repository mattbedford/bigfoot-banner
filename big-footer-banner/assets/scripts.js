window.onload = function(){ 
    //Set our banner div as a var
    let bfbBanner = document.querySelector("#big-footer-banner");
	let closeBfbBanner = document.querySelector("#bfb-closer");
	let closeBfbButton = document.querySelector("#bfb-button");


    //Check to see if we have a cookie timeout var set somewhere. if not, use 3 days as a default
    let timeOutDays = 3;
    if (typeof bfbTimeout !== 'undefined') {
        timeOutDays = Number(bfbTimeout);
    }
    
	
    //Check to see if bfb cookie exists or not at page load. If exists, no need to show banner
    if(!document.cookie.match(/^(.*;)?\s*bfb-dismiss\s*=\s*[^;]+(.*)?$/)) {
        bfbBanner.style.display = "block";
    } 


    //Add a new cookie if user clicks close on cookie banner or close button.
    closeBfbBanner.addEventListener("click", function(){
		closeAndSetCookie();
	});
	closeBfbButton.addEventListener("click", function(){
		closeAndSetCookie();
	});
									
									
	function closeAndSetCookie() {
        const d = new Date();
        d.setTime(d.getTime() + (timeOutDays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = "bfb-dismiss=true;" + expires + "path=/";
        bfbBanner.style.display = "none";
    };
};