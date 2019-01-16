/*
	Author: John Stewart
	Version: 0.1
	Name: ImagePile
*/
(function ($){
    $.fn.ImagePile = function (options) {
        //setup a default option
        var settings = $.extend({
            pileType: "messy"
        }, options);
        
        //get selector prefix
        var tempArray = this.selector.split("");
        var selPreFix = tempArray[0];
        /*
            If its a class then we run through all the images
            that are return in the selector and wrap them giving
            each image a different pileType.
            
            If it's an ID then we just wrap it and assign it the
            ID that is passed in through the object literal, or 
            to the default.
        */
        if(this.length > 1 && selPreFix == '.'){
        	//setup pile types
        	var pileTypes = ["neat","left","right","messy"];
        	
        	//loop through images returned from selector
        	for(var i = 0; i <= this.length-1; i++){
        		//random number for random type
        		var randType = Math.floor((Math.random()*4));
        		
        		$(this[i]).wrap("<div class='stack "+pileTypes[randType]+"'><div class='middle-cnt'></div></div>");
        	}
            
        }else if(this.length == 1 && selPreFix == '#'){
            //get pileType from settings
            var pileType = settings.pileType;
            
            switch(pileType){
                case "neat":
                    return this.wrap("<div class='stack neat'><div class='middle-cnt'></div></div>");
                    break;
                case "left":
                    return this.wrap("<div class='stack left'><div class='middle-cnt'></div></div>");
                    break;
                case "right":
                    return this.wrap("<div class='stack right'><div class='middle-cnt'></div></div>");
                    break
                case "messy":
                    return this.wrap("<div class='stack messy'><div class='middle-cnt'></div></div>");
                    break;
            }
        }else{
        
        }
        
    };
})(jQuery);


